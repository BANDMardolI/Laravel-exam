@extends('master')
@section('title','Page title')
@section('menu')
    @parent
@endsection
@section('content')
<div class="container">
    <div class="row">
        @if($page == 'Login')
            {!! Form::model($user, ['action'=>'App\Http\Controllers\LoginController@authorizate'])!!}
            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
            <script src="https://www.google.com/recaptcha/api.js"></script>
        @elseif($page == 'Registration')
            {!! Form::model($user, ['action'=>'App\Http\Controllers\LoginController@register'])!!}
            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
            <script src="https://www.google.com/recaptcha/api.js"></script>
            <div class="row">
                {!! Form::label('login', 'Login')!!}
                {!! Form::text('login','',['class' => 'login'])!!}
            </div>
        @endif
        <div class="row">
            {!! Form::label('email', 'Email')!!}
            {!! Form::text('email','',['class' => 'email'])!!}
        </div>
        <div class="row">
            {!! Form::label('password', 'Password')!!}
            {!! Form::password('password',['class'=>'password'])!!}
        </div>
        <button class="btn btn-success" type="submit">{{$page == 'Login' ? 'Login' : 'Registration'}}</button>
    </div>
</div>
@endsection
