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
            <div class="row">
                <h3 style="color: #337ab7;">{{$n->summary}}</h3>
                <a href="{{url('download/'.$n->id)}}">
                    <i class='fa fa-download' style='color:#337ab7'></i>
                </a>
                <a href="{{url('show/'.$n->id)}}" class="">
                    <i class='fa fa-eye' style='color:#337ab7'></i>
                </a>
                <a href="{{url('report/'.$n->id)}}">
                    <i class='fa fa-exclamation' style='color: #337ab7'></i>
                </a>
            </div>
        @endforeach
    </div>
</div>

@endsection
