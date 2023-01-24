
@extends('layouts.app')

@section('content')
    <div class="containe contact-us">
        <div class="row justify-content-center">
            <div>
                <h1>Contact Us</h1>
                <section class="mb-4">
                    <!-- Success message -->
                    @if(\Illuminate\Support\Facades\Session::has('success'))
                        <div class="alert alert-success">
                            {{\Illuminate\Support\Facades\Session::get('success')}}
                        </div>
                    @endif
                    <!--Section heading-->
                    <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
                    <!--Section description-->
                    <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
                        a matter of hours to help you.</p>

                    <div class="row">

                        <!--Grid column-->
                        <div class="col-md-9 mb-md-0 mb-5">
                            <form id="contact-form" name="contact-form" action="{{ route('contact-store') }}" method="POST">
                                @csrf
                                <div class="row">

                                    <!--Grid column-->
                                    <div class="col-md-12">
                                        <div class="md-form mb-0">
                                            <input type="text" id="name" name="name" class="form-control">
                                            <label for="name" class="">Your name</label>
                                            <!-- Error -->
                                            @if ($errors->has('name'))
                                                <div class="error">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!--Grid row-->
                                <div class="row">

                                    <!--Grid column-->
                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <input type="tel" id="phone" name="phone" class="form-control">
                                            <label for="phone" class="">Your phone number</label>
                                            @if ($errors->has('phone'))
                                                <div class="error">
                                                    {{ $errors->first('phone') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!--Grid column-->

                                    <!--Grid column-->
                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <input type="email" id="email" name="email" class="form-control">
                                            <label for="email" class="">Your email</label>
                                            @if ($errors->has('email'))
                                                <div class="error">
                                                    {{ $errors->first('email') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!--Grid column-->

                                </div>
                                <!--Grid row-->

                                <!--Grid row-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="md-form mb-0">
                                            <input type="text" id="subject" name="subject" class="form-control">
                                            <label for="subject" class="">Subject</label>
                                            @if ($errors->has('subject'))
                                                <div class="error">
                                                    {{ $errors->first('subject') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!--Grid row-->

                                <!--Grid row-->
                                <div class="row">

                                    <!--Grid column-->
                                    <div class="col-md-12">

                                        <div class="md-form">
                                            <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                                            <label for="message">Your message</label>
                                            @if ($errors->has('message'))
                                                <div class="error">
                                                    {{ $errors->first('message') }}
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                <!--Grid row-->

                            <div class="text-center text-md-left">
                                <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
                            </div>
                            <div class="status"></div>
                            </form>
                        </div>
                        <!--Grid column-->

                        <!--Grid column-->
                        <div class="col-md-3 text-center">
                            <ul class="list-unstyled mb-0">
                                <li><i class="fa fa-map-marker fa-2x"></i>
                                    <p>Fort Worth, TX 76123, USA</p>
                                </li>

                                <li><i class="fa fa-phone mt-4 fa-2x"></i>
                                    <p>+ 01 234 567 89</p>
                                </li>

                                <li><i class="fa fa-envelope mt-4 fa-2x"></i>
                                    <p>contact@paperworkritekennels.com</p>
                                </li>
                            </ul>
                        </div>
                        <!--Grid column-->

                    </div>

                </section>

            </div>
        </div>
    </div>
@endsection
