@extends('layout')
@section('title', 'Reset Password')
@section('content')
<div class="container">
    <div class="auth-pages">
        <div class="auth-left" style="margin: 10px auto">
            @if (session()->has('status'))
                <div class="alert alert-success">
                    {{ session()->get('status') }}
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
            <h2>Forgot Password?</h2>
            <div class="spacer"></div>
            <form action="{{ route('password.email') }}" method="POST">
                {{ csrf_field() }}
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus style="
    width: 600px;">
                <div class="login-container">
                    <button type="submit" class="auth-button" style="padding: 0px 0px;width: 150px;height: 50px;">Send Reset Link</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
