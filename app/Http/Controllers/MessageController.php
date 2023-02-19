<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::all();
        return view('message.index', compact($messages));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /** @var User $user */
        $user = auth()->user();
        if (!$user->hasRole('Admin')) {
            return redirect()->route('home');
        }
        return view('message.create', ['users' => User::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'users' => 'required|array',
            'body' => 'required',
            'subject' => 'required',
            'email' => 'nullable|boolean'
        ]);
        $recipients = $validatedData["users"];
        // iterate over the array of recipients and send a twilio request for each
        foreach ($recipients as $recipient) {
            $toUser = User::where('phone', $recipient)->first();
            $fromUser = auth()->user();
            $this->sendMessage($validatedData["body"], $recipient);
            Message::create([
                'to' => $toUser->id,
                'from' => $fromUser->id,
                'subject' => $validatedData['subject'],
                'message' => $validatedData['body'],
                'type' => 'text'
            ]);
            if ($toUser && $validatedData['email']) {
                Mail::send('message-user-email', [
                    'name' => $toUser->name,
                    'appName' => config('app.name'),
                    'subject' => $validatedData['subject'],
                    'body' => $validatedData['body'],
                ], function($message) use ($toUser, $validatedData){
                    $message->from(config('app.email'), config('app.name'));
                    $message->to($toUser->email, 'Admin')->subject($validatedData['subject']);
                });
                Message::create([
                    'to' => $toUser->id,
                    'from' => $fromUser->id,
                    'subject' => $validatedData['subject'],
                    'message' => $validatedData['body'],
                    'type' => 'email'
                ]);
            }
        }
        return back()->with(['success' => "Messages on their way!"]);
    }

    /**
     * Sends sms to user using Twilio's programmable sms client
     * @param String $message Body of sms
     * @param Number $recipients Number of recipient
     */
    private function sendMessage($message, $recipients)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
