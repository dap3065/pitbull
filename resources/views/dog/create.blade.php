@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <h1>Add Pitbull</h1>
            <div class="container">
                @if ($message = \Illuminate\Support\Facades\Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <strong>{{$message}}</strong>
                    </div>
                    <img width="100" height="100" src="{{ asset('img/'.\Illuminate\Support\Facades\Session::get('image')) }}" alt="pitbull" />
                @endif
                <div class="col-md-9 mb-md-0 mb-5">
                    <form
                        id="create-pitbull-form"
                        name="create-pitbull-form"
                        action="{{ route('save-pitbull') }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        <div class="row">
                            <!--Grid column-->
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label for="name" class="">Dog's name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="name" name="name" class="form-control" />
                                </div>
                                @if ($errors->has('name'))
                                    <div class="error">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <!--Grid column-->
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label for="description" class="">Dog's description</label>
                                </div>
                                <div class="col-md-8">
                                        <textarea type="text" rows="4" id="description" name="description" class="form-control" >
                                        </textarea>
                                </div>
                                @if ($errors->has('description'))
                                    <div class="error">
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <!--Grid column-->
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label for="type" class="">Dog's Breed/Type</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="type" name="type" class="form-control" />
                                </div>
                                @if ($errors->has('type'))
                                    <div class="error">
                                        {{ $errors->first('type') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <!--Grid column-->
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label for="price" class="">Dog's Price</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" id="price" name="price" min="0.00" max="100000.00" step="0.01" class="form-control" />
                                </div>
                                @if ($errors->has('price'))
                                    <div class="error">
                                        {{ $errors->first('price') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <!--Grid column-->
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label for="image" class="">Dog's Picture</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" id="image" name="image" class="form-control" />
                                </div>
                                @if ($errors->has('image'))
                                    <div class="error">
                                        {{ $errors->first('image') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="text-center text-md-left">
                            <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
                        </div>
                        <div class="status"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
