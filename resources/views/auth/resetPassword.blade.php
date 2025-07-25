
@extends('layouts.app')
@section('title', 'Reset Password')
@section('content')

    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="{{ route('login') }}" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ asset('public/img/logo.png') }}" alt="">
                                    <span class="d-none d-lg-block">Online Quiz - Login</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login</h5>

                                    </div>

                                    {{-- message --}}
                                    @session('status')
                                        <div class="alert alert-success" role="alert">
                                            {{ $value }}
                                        </div>
                                    @endsession
                                    {{-- message --}}

                                    {{-- error msg --}}
                                    @session('error')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $value }}
                                        </div>
                                    @endsession
                                    {{-- erromsg end --}}


                                    <form action="{{ route('Post-reset', $resetUserPassword->remember_token) }}"
                                        method="post">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Password">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-lock"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input-group mb-3">
                                            <input type="password" name="cpassword" class="form-control"
                                                placeholder="Confirm Password">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-lock"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">


                                            <div class="col-4">
                                                <button type="submit" class="btn btn-primary btn-block">Reset</button>
                                            </div>

                                        </div>
                                    </form>





                                </div>
                            </div>



                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->
@endsection
