@php
    $meta = [
        // "meta" => [],
        'seo' => [
            'title' => 'Sign up',
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)
@section('contents')
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
    </style>
    <section class="py-5 my-5">
        <div class="container h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="{{ $website_about->login_image }}" class="img-fluid" alt="Sample image">
                    {{-- <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                    class="img-fluid" alt="Sample image"> --}}
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="POST" action="{{ route('register_sumbit') }}">
                        @csrf

                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                            <h1 class="lead fw-normal mb-0 me-3">Sign UP</h1>
                        </div>

                        {{-- <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0">Or</p>
                        </div> --}}

                        <div class="form-outline my-4">
                            <label class="form-label" for="first_name">
                                First Name
                                <sup class="text-danger">*</sup>
                            </label>
                            <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"
                                class="form-control " placeholder="Enter your First Name" />
                            @error('first_name')
                                <div class="text-danger pt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-outline my-4">
                            <label class="form-label" for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"
                                class="form-control " placeholder="Enter your Last Name" />
                            @error('last_name')
                                <div class="text-danger pt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-outline my-4">
                            <label class="form-label" for="email">
                                Email
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="form-control " placeholder="Enter your email address" />
                            @error('email')
                                <div class="text-danger pt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-outline my-4">
                            <label class="form-label" for="mobile_number">
                                Mobile Number
                                <sup class="text-danger">*</sup>
                            </label>
                            <input type="text" name="mobile_number" id="mobile_number" value="{{ old('mobile_number') }}"
                                class="form-control" placeholder="Enter your mobile number" />
                            @error('mobile_number')
                                <div class="text-danger pt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Enter password" />
                            @error('password')
                                <div class="text-danger pt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn rounded-pill btn-primary px-4">
                                Submit
                            </button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">
                                have an account?
                                <a href="/login" class="link-danger">Login</a>
                            </p>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection
