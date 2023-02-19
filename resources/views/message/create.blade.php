@extends('layouts.app')

@section('content')
    <div class="container message">
        <div class="row justify-content-center">
            <div class="jumbotron">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                Send SMS message
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('send-message') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="users[]">Select users to notify
                                            <select name="users[]" multiple class="form-control">
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->phone }}">{{ $user->name }} ({{ $user->phone }}) ({{ $user->email }})</option>
                                                @endforeach
                                            </select>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="subject" class="form-label">Subject</label>
                                        <input type="text" class="form-control" name="subject" id="subject" />
                                    </div>
                                    <div class="form-group">
                                        <label for="body">Notification Message
                                            <textarea name="body" class="form-control" rows="3" cols="50"></textarea>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" name="email" type="checkbox" value="1" id="flexCheckDefault" />
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Send email also
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mx-auto text-center">
                                        <button type="submit" class="btn btn-primary">Send Notification</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
