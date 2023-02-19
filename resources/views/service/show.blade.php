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
                            <a class="btn btn-dark" href="{{ route('make.payment', ['service' => $service]) }}">Buy</a>
                            @hasrole('Admin')
                                <a class="btn btn-dark" href="{{ route('edit-service', ['service' => $service]) }}">Edit</a>
                                <form action="{{ route('delete-service', ['service' => $service]) }}" method="post">
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
