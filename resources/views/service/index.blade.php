@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div>
                <h1 style="text-align: center">Our Services</h1>
                <div>
                    @if (count($services) > 0)
                        <div class="row">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @for ($i = 0; $i < count($services); $i++)
                                        @if ($i === 0)
                                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}" class="active"></li>
                                        @else
                                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}"></li>
                                        @endif
                                    @endfor
                                </ol>
                                <div class="carousel-inner">
                                    @foreach ($services as $service)
                                        @if ($loop->first)
                                            <div class="carousel-item active">
                                                <div style="height: 50vh; width: 80vw; text-align: center;">
                                                    <div class="d-block w-100">{{ $service->name }}</div>
                                                    <div>{{ $service->description }}</div>
                                                    <div>@money($service->price)</div>
                                                </div>
                                                <div class="carousel-caption d-none d-md-block">
                                                    <div>

                                                        <a class="btn btn-dark" href="{{ route('show-service', ['service' => $service]) }}">View</a>
                                                        <a class="btn btn-dark" href="{{ route('show-service', ['service' => $service]) }}">Buy</a>
                                                        @hasrole('Admin')
                                                            <a class="btn btn-dark" href="{{ route('show-service', ['service' => $service]) }}">Edit</a>
                                                        @endhasrole
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="carousel-item">
                                                <div style="height: 50vh; width: 80vw; text-align: center;">
                                                    <div class="d-block w-100">{{ $service->name }}</div>
                                                    <div>{{ $service->description }}</div>
                                                    <div>@money($service->price)</div>
                                                </div>
                                                <div class="carousel-caption d-none d-md-block">
                                                    <div>
                                                        <a class="btn btn-dark" href="{{ route('show-service', ['service' => $service]) }}">View</a>
                                                        <a class="btn btn-dark" href="{{ route('show-service', ['service' => $service]) }}">Buy</a>
                                                        @hasrole('Admin')
                                                            <a class="btn btn-dark" href="{{ route('show-service', ['service' => $service]) }}">Edit</a>
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
                            No services at this time.
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
