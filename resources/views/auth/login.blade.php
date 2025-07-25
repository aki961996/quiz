@extends('layouts.app')
@section('title', 'Log in')
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
                               <a href="{{ route('login') }}" class="logo d-flex align-items-center w-auto" style="text-decoration: none;">
    <span class="d-none d-lg-block" style="color: black; font-size: 32px;">Online Quiz - Login</span>
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
                                    <form action="{{ route('auth_login') }}" method="POST"
                                        class="row g-3 needs-validation">
                                        @csrf
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" id="email">
                                            <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                                        </div>


                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="password">
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>



                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 fw-bold" type="submit">Log in</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0 text-center">Not a member? <a class="fw-bold"
                                                    href="{{ route('register') }}">Sign Up</a></p>

                                            <p class="small mb-0">Forget Your Password ? <a
                                                    href="{{ route('forgot-password') }}">Then click here
                                                </a></p>
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
