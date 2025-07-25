@extends('layouts.app')
@section('title', 'Sign Up')
@section('style')
<style>
    body {
        background: url('{{ asset('/img/detail.jpg') }}') no-repeat center center fixed;
        background-size: cover;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
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
                                <a href="{{ route('register') }}" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ asset('public//img/logo.png') }}" alt="">
                                    <span class="d-none d-lg-block">Online Quiz - Signup</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">



                                    <form action="{{ route('create_user') }}" method="POST"
                                        class="row g-3 needs-validation" novalidate>
                                        @csrf
                                        <div class="col-12">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                value="{{ old('name') }}">
                                            <div style="color: red">{{ $errors->first('name') }}</div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label"> Email</label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                value="{{ old('email') }}">
                                            <div style="color: red">{{ $errors->first('email') }}</div>
                                        </div>



                                        <!-- password  -->
                                        <div class="col-12">
                                            <label class="form-label">Password</label>
                                            <div class="input-group">
                                                <input type="password" name="password" class="form-control border-right-0"
                                                    id="password" value="{{ old('password') }}"
                                                    oninput="toggleShowButton()">
                                                <button type="button" id="show-password-btn"
                                                    class="btn btn-outline-secondary btn-show" style="display: none;"
                                                    onclick="togglePasswordVisibility()">
                                                    Show
                                                </button>
                                            </div>
                                            <div style="color: red">{{ $errors->first('password') }}</div>
                                        </div>


                                        <div class="col-12">
                                            <button class="btn btn-success w-100 fw-bold" type="submit">Sign Up</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0 text-center">Already have an account? <a class="fw-bold"
                                                    href="{{ route('login') }}">Log
                                                    in</a></p>
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

@section('script')
    <script>
        function toggleShowButton() {

            const passwordField = document.getElementById('password');
            const showButton = document.getElementById('show-password-btn');

            if (passwordField.value.length > 0) {
                showButton.style.display = 'inline-block'; // Show the button
            } else {
                showButton.style.display = 'none'; // Hide the button
            }
        }


        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const showButton = document.getElementById('show-password-btn');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                showButton.textContent = 'Hide';
            } else {
                passwordField.type = 'password';
                showButton.textContent = 'Show';
            }
        }
    </script>
@endsection
