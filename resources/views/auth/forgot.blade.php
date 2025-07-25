@extends('layouts.app')
@section('title', 'Forget Password')
@section('style')
    <style>
        body {
            background: url('{{ asset('/img/detail.jpg') }}') no-repeat center center fixed;
            background-size: cover;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')

    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="{{ route('login') }}" class="logo d-flex align-items-center w-auto"
                                    style="text-decoration: none; width: 100%; justify-content: center;">

                                    <span class="d-none d-lg-block"
                                        style="color: black; font-size: 28px; text-align: center; text-decoration: none; display: block;">
                                        Online Quiz - Forgot password
                                    </span>
                                </a>
                            </div>


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
                                    <form action="{{ route('post-forgot-password') }}" method="post">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="email" name="email" class="form-control" placeholder="Email">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">


                                            <div class="col-4">
                                                <button type="submit" class="btn btn-primary btn-block">Forgot</button>
                                            </div>

                                        </div>
                                    </form>
                                    <p class="mb-1 ">
                                        <br />
                                        <a href="{{ route('login') }}">Login</a>
                                    </p>


                                </div>
                            </div>



                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->
@endsection
