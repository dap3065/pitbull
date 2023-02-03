@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div>
                <h1 style="text-align: center">Our Kennel</h1>
                <div>
                    @if (count($pitbulls) > 0)
                        <div class="row">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @for ($i = 0; $i < count($pitbulls); $i++)
                                        @if ($i === 0)
                                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}" class="active"></li>
                                        @else
                                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}"></li>
                                        @endif
                                    @endfor
                                </ol>
                                <div class="carousel-inner">
                                    @foreach ($pitbulls as $pitbull)
                                        @if ($loop->first)
                                            <div class="carousel-item active">
                                                <img style="width: 50vw; height: 50vh;" class="d-block w-100" src="{{ asset($pitbull->image_path) }}" alt="First slide">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <div>
                                                        <a class="btn btn-dark" href="{{ route('show-pitbull', ['dog' => $pitbull]) }}">View</a>
                                                        <a class="btn btn-dark" href="{{ route('show-pitbull', ['dog' => $pitbull]) }}">Buy</a>
                                                        @hasrole('Admin')
                                                        <a class="btn btn-dark" href="{{ route('show-pitbull', ['dog' => $pitbull]) }}">Edit</a>
                                                        @endhasrole
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="carousel-item">
                                                <img class="d-block w-100" src="{{ asset($pitbull->image_path) }}" alt="{{ $pitbull->id }} slide">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h5>{{ $pitbull->name }}</h5>
                                                    <div>
                                                        <a class="btn btn-dark" href="{{ route('show-pitbull', ['dog' => $pitbull]) }}">View</a>
                                                        <a class="btn btn-dark" href="{{ route('show-pitbull', ['dog' => $pitbull]) }}">Buy</a>
                                                        @hasrole('Admin')
                                                        <a class="btn btn-dark" href="{{ route('show-pitbull', ['dog' => $pitbull]) }}">Edit</a>
                                                        @endhasrole
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    @else
                        <div>
                            All sold out of dogs
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
