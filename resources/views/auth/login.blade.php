@extends('layout')
@section('title', 'Login')
@section('content')
<div class="container">
    <div class="row">
        <div class="auth-pages">
                @if (session()->has('success_message'))
                    <div class="alert alert-success">
                        {{ session()->get('success_message') }}
                    </div>
                @endif @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="spacer"></div>
                    <form action="{{ route('login') }}" method="POST" style="margin-left: 320px">
                        {{ csrf_field() }}

                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                        <input type="password" id="password" name="password" value="{{ old('password') }}" placeholder="Password" required>

                        <div class="login-container">
                            <button type="submit" class="auth-button">Login</button>
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                        <div class="spacer"></div>

                        <a href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                        <a href="{{route('voyager.login')}}">Login as admin</a>
                        <br>
                        <a href="{{ route('guestCheckout.index') }}">Continue as Guest</a>

                    </form>

        </div>
    </div>
</div>
@endsection
