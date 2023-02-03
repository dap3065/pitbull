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
                                        <label>Select users to notify</label>
                                        <select name="users[]" multiple class="form-control">
                                            @foreach ($users as $user)
                                                <option>{{ $user->phone }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Notification Message</label>
                                        <textarea name="body" class="form-control" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Send Notification</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
