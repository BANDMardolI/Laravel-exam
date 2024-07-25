@extends('master')
@section('title','Page title')
@section('menu')
    @parent
@endsection
@section('content')
<div class="container">
    <div class="row">
        @foreach($users->all() as $n)
            <div class="row d-flex border-bot">
                <h3 style="color: #337ab7;">{{$n->name}}</h3>
                <h2 style="color: #337ab7;">{{$n->email}}</h2>
                <a class="ml" href="{{url('deleteuser/'.$n->id)}}">
                    <i class="fa fa-times" style="color: #337ab7;"></i>
                </a>
                <a class="ml" href="{{url('ban/'.$n->id)}}">
                    <i class="fa fa-ban" style="color: #337ab7;"></i>
                </a>
            </div>
        @endforeach
        <div class="row mt-40">
            <h3 style="color: #337ab7;">Add User</h3>
            {!!Form::model($users, ['action'=>'App\Http\Controllers\LoginController@register'])!!}
            <div class="row">
                {!! Form::label('login', 'Login')!!}
                {!! Form::text('login','',['class' => 'login'])!!}
            </div>
            <div class="row">
                {!! Form::label('email', 'Email')!!}
                {!! Form::text('email','',['class' => 'email'])!!}
            </div>
            <div class="row">
                {!! Form::label('password', 'Password')!!}
                {!! Form::password('password',['class'=>'password'])!!}
            </div>
            <button class="btn btn-success" type="submit">Add User</button>
        </div>
        <div class="row mt-40">
            <h3 style="color: #337ab7;">Banned Users</h3>
            @foreach($bannedUsers->all() as $n)
            <div class="row d-flex border-bot">
                <h3 style="color: #337ab7;">{{$n->name}}</h3>
                <h2 style="color: #337ab7;">{{$n->email}}</h2>
                <a class="ml" href="{{url('unban/'.$n->id)}}">
                    <i class="fa fa-unlock-alt" style="color: #337ab7;"></i>
                </a>
            </div>
        @endforeach
        </div>
    </div>
</div>
@endsection