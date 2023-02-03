@extends('layouts.app')

@section('content')
    <div class="container service">
        <div class="row justify-content-center">
            <div>
                <h1>{{ $service->name }}</h1>
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            Description: {{ $service->description }}
                        </p>
                        <p>
                            Price: @money($service->price)
                        </p>
                        <p>
                            <a class="btn btn-dark" href="{{ route('show-service', ['service' => $service]) }}">Buy</a>
                            @hasrole('Admin')
                                <a class="btn btn-dark" href="{{ route('show-service', ['service' => $service]) }}">Edit</a>
                                <a class="btn btn-dark" href="{{ route('show-service', ['service' => $service]) }}">Delete</a>
                            @endhasrole
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
