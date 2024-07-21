@extends('master')
@section('title','Page title')
@section('menu')
    @parent
@endsection
@section('content')
<div class="container">
    <div class="row">
    {!! Form::open(['action'=>'App\Http\Controllers\NewController@index', 'method' => 'post']) !!}
        {!! Form::label('search') !!}
        {!! Form::text('search') !!}
        <button class="btn btn-success" type="submit">Search</button>
    {!! Form::close() !!}
        @foreach($instructions->all() as $n)
            <div class="row d-flex border-bot">
                <h3 style="color: #337ab7;">{{$n->summary}}</h3>
                <a class="ml" href="{{url('download/'.$n->id)}}">
                    <i class='fa fa-download fs-10' style='color:#337ab7'></i>
                </a>
                <a href="{{url('show/'.$n->id)}}" class="">
                    <i class='fa fa-eye fs-10' style='color:#337ab7'></i>
                </a>
                <a href="{{url('report/'.$n->id)}}">
                    <i class='fa fa-exclamation fs-10' style='color: #337ab7'></i>
                </a>
            </div>
        @endforeach
    </div>
</div>

@endsection
