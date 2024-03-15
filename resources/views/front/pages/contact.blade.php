@extends('front.layout.layout')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{route('front.index')}}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Contact</strong></div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="h3 mb-3 text-black">Get In Touch</h2>
                </div>
                <div class="col-md-7">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                        {{session()->get('message')}}
                        </div>
                    @endif

                    @if(count($errors))
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">{{$error}}</div>
                        @endforeach
                    @endif
                    <form action="{{route('front.contact.post')}}" method="post">
                        @csrf
                        <div class="p-3 p-lg-5 border">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_name" class="text-black">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_name" name="c_name">
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_email" class="text-black">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="c_email" name="c_email" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_subject" class="text-black">Subject </label>
                                    <input type="text" class="form-control" id="c_subject" name="c_subject">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_message" class="text-black">Message </label>
                                    <textarea name="c_message" id="c_message" cols="30" rows="7" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Send Message">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-5 ml-auto">
                    <div class="p-4 border mb-3">
                        @foreach($settings as $setting)
                        <span class="d-block text-primary h6 text-uppercase">Address</span>
                        <p class="mb-0">{{$setting->address}}</p>
                    </div>
{{--                    <div class="p-4 border mb-3">--}}
{{--                        <span class="d-block text-primary h6 text-uppercase">London</span>--}}
{{--                        <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>--}}
{{--                    </div>--}}
{{--                    <div class="p-4 border mb-3">--}}
{{--                        <span class="d-block text-primary h6 text-uppercase">Canada</span>--}}
{{--                        <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>--}}
{{--                    </div>--}}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
