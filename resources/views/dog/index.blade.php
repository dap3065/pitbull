@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div>
                <h1>Our Kennel</h1>
                <div>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ asset('img/pexels-makarand-sawant-2208743.jpg') }}" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Dog 1</h5>
                                    <p>Here is pitpull one, the newest dog in the list.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('img/pexels-matthias-zomer-103536.jpg') }}" alt="Second slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Dog 2</h5>
                                    <p>Here is dog 2, the second newest dog in the list</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('img/pexels-stiv-xyz-137020.jpg') }}" alt="Third slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Dog 3</h5>
                                    <p>Here is dog 3, the last dog in the list.  We saved the best for last</p>
                                </div>
                            </div>
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
            </div>
        </div>
    </div>
@endsection
