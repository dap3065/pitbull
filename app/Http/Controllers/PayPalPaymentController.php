<?php




namespace App\Http\Controllers;

use App\Dog;
use App\Payment;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PayPalPaymentController extends Controller

{
    public function handlePayment(Request $request)
    {
        $paypalClient = new PayPalClient(config('paypal'));
        $paypalClient->setApiCredentials(config('paypal'));
        $paypalClient->setAccessToken($paypalClient->getAccessToken());
        $category = 'PETS_AND_ANIMALS';
        if ($pitbullId = $request->query('pitbull')) {
            $product = Dog::find($pitbullId);
            $type = 'PHYSICAL';
            $image_url = asset($product->image_path);
            $request_id = 'Pitbull-' . $product->id;
        } else if ($serviceId = $request->query('service')) {
            $product = Service::find($serviceId);
            $type = 'SERVICE';
            $image_url = asset('img/logo.png');
            $request_id = 'Service-' . $product->id;
        } else {
            throw new \Exception('No item selected to purchase');
        }

        $data = json_decode('{
  "name": "' . $product->name . '",
  "description": "' . $product->description . '",
  "type": "'. $type . '",
  "category": "'. $category . '",
  "image_url": "' . $image_url . '",
  "home_url": "http://82.180.162.182/"
}', true);
        Log::error('Product json:' . print_r($data, true));
        $paypalProduct = $paypalClient->createProduct($data, $request_id);
        Log::error('Product:' . print_r($paypalProduct, true));
        if ($paypalProduct && isset($paypalProduct['id'])) {
            $data = json_decode('{
    "intent": "CAPTURE",
    "purchase_units": [
      {
        "amount": {
          "reference_id": "' . $paypalProduct['id'] . '",
          "custom_id": "' . $product->id . '",
          "currency_code": "USD",
          "value": "' . $product->price . '"
        }
      }
    ],
    "payment_source": {
    "paypal": {
      "experience_context": {
        "payment_method_preference": "IMMEDIATE_PAYMENT_REQUIRED",
        "payment_method_selected": "PAYPAL",
        "brand_name": "' . config('app.name') . '",
        "locale": "en-US",
        "landing_page": "LOGIN",
        "shipping_preference": "SET_PROVIDED_ADDRESS",
        "user_action": "PAY_NOW",
        "return_url": "' . route('success.payment') . '",
        "cancel_url": "' . route('cancel.payment') . '"
      }
    }
  }
}', true);
        } else {
            $data = json_decode('{
    "intent": "CAPTURE",
    "purchase_units": [
      {
        "amount": {
          "custom_id": "' . $product->id . '",
          "currency_code": "USD",
          "value": "' . $product->price . '"
        }
      }
    ],
    "payment_source": {
    "paypal": {
      "experience_context": {
        "payment_method_preference": "IMMEDIATE_PAYMENT_REQUIRED",
        "payment_method_selected": "PAYPAL",
        "brand_name": "' . config('app.name') . '",
        "locale": "en-US",
        "landing_page": "LOGIN",
        "shipping_preference": "SET_PROVIDED_ADDRESS",
        "user_action": "PAY_NOW",
        "return_url": "' . route('success.payment') . '",
        "cancel_url": "' . route('cancel.payment') . '"
      }
    }
  }
}', true);
        }

        Log::error('Order json:' . print_r($data, true));
        $order = $paypalClient->createOrder($data);
        Log::error('Order:' . print_r($order, true));

        if (!isset($order['error']) && !empty($order['links'][1])) {
            $user = auth()->user();
            Payment::create([
                'amount' => $product->price,
                'discount' => 0.00,
                'user_id' => $user->id,
                'status' => $order['status'],
                'paypal_id' => $order['id'],
                'order_start' => json_encode($order),
            ]);
            return redirect($order['links'][1]['href']);
        } else if (isset($order['error'])) {
            return back()->with('error', 'There was an error!')
                ->with(['order' => $order]);
        }

        return back()->with('success', 'Order was successful!')
            ->with(['order' => $order]);
    }



    public function paymentCancel(Request $request)
    {
        /** @var Payment $payment */
        $payment = Payment::where('paypal_id', $request->query('token'))->first();
        if ($payment) {
            $payment->update([
                'status' => 'cancelled/declined'
            ]);
        }
        return redirect()->route('welcome')
            ->with('error', 'Your payment has been declined or cancelled.');
    }



    public function paymentSuccess(Request $request)

    {
        $paypalClient = new PayPalClient(config('paypal'));
        $paypalClient->setApiCredentials(config('paypal'));
        $paypalClient->setAccessToken($paypalClient->getAccessToken());
        $orderDetails = $paypalClient->showOrderDetails($request->query('token'));
        $payment = Payment::where('paypal_id', $request->query('token'))->first();
        Log::error('Order details success:' . print_r($orderDetails, true));
        $response = $paypalClient->capturePaymentOrder($request->query('token'));
        if ($payment) {
            $payment->update([
                'status' => $response['status'],
                'order_complete' => json_encode($response),
                'order_details' => json_encode($orderDetails)
            ]);
        }
        Log::error('Capture response:' . print_r($response, true));
        return redirect()->route('welcome')
            ->with('success', 'Your payment was successful!');
    }
}
