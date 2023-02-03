@extends('layouts.app')

@section('content')
    <div class="container pitbull">
        <div class="row justify-content-center">
            <div>
                <h1>{{ $pitbull->name }}</h1>
                <div class="row">
                    <div class="col-md-6">
                        <img class="d-block w-100" src="{{ asset($pitbull->image_path) }}" alt="{{ $pitbull->name }}">
                    </div>
                    <div class="col-md-6">
                        <p>
                            Breed/Type: {{ $pitbull->type }}
                        </p>
                        <p>
                            Description: {{ $pitbull->description }}
                        </p>
                        <p>
                            Price: @money($pitbull->price)
                        </p>
                        <p>
                            <a class="btn btn-dark" href="{{ route('show-pitbull', ['dog' => $pitbull]) }}">Buy</a>
                            @hasrole('Admin')
                                <a class="btn btn-dark" href="{{ route('show-pitbull', ['dog' => $pitbull]) }}">Edit</a>
                            @endhasrole
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
