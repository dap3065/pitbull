@extends('layouts.app')

@section('content')
    <div class="container pitbull">
        <div class="row justify-content-center">
            <div>
                <h1>{{ $pitbull->name }}</h1>
                <div class="row">
                    <div class="col-md-6">
                        <img class="d-block w-100 img-fluid" src="{{ asset($pitbull->image_path) }}" alt="{{ $pitbull->name }}">
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
                            <a class="btn btn-dark" href="{{ route('make.payment', ['pitbull' => $pitbull]) }}">Buy</a>
                            @hasrole('Admin')
                                <a class="btn btn-dark" href="{{ route('edit-pitbull', ['dog' => $pitbull]) }}">Edit</a>
                                <form action="{{ route('delete-pitbull', ['dog' => $pitbull]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-dark" onclick="return confirm('Are you sure?')"
                                        type="submit" name="Delete">Delete</button>
                                </form>
                            @endhasrole
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
