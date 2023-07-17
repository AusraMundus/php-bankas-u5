@extends('layouts.app2')

@section('content')
    <body>
        <div class="container col-6 mt-5">
            <div class="card text-center mb-3">
                <div class="card-img-top">
                    <img src="{{ asset('img/logo.png') }}" class="welcome-img-size" alt="logo">
                </div>
                <div class="card-body">
                    <h1 class="card-title">Easy Way To Manage Bank Accounts</h1>
                    <p class="card-text">No Paperwork, No Hassle - Just a unique app for managing bank accounts</p>
                    @if (Route::has('login'))
                    <div>
                        @auth
                            <a href="{{ url('/home') }}" class="btn btn-primary">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">Go to Login Page</a>
                        @endauth
                    </div>
                    @endif
                </div>        
            </div>
        </div>
    </body>
@endsection