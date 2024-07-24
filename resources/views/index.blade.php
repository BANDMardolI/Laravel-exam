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
    @if(Auth::check() && Auth::user()->name == 'admin')
        @foreach($instructions->all() as $n)
            <div class="row d-flex border-bot">
                <h3 style="color: #337ab7;">{{$n->summary}}</h3>
                <a class="ml" href="{{url('delinstr/'.$n->id)}}">
                    <i class="fa fa-times" style="color: #337ab7;"></i>
                </a>
            </div>
        @endforeach
        <div class="container mt-40">
            <h3 class="main-color">Add Instruction:</h3>
            <div class="row">
                {!! Form::model($instructions, ['action'=>'App\Http\Controllers\NewController@adminstore', 'files'=>true])!!}
                <div class="row">
                    {!! Form::label('header','Header')!!}
                    {!! Form::text('header', '',['class' => 'textfield'])!!}
                </div>
                <div class="row">
                    {!! Form::label('pdf', 'PDF file')!!}
                    {!! Form::file('pdf',['class'=>'filefield'])!!} 
                </div>
                <button class="btn btn-success" type="submit">Add</button>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <h3 class="main-color mt-40">Complaints</h3>
                @foreach($reportedInstructions->all() as $n)
                <div class="row d-flex border-bot">
                    <h3 style="color: #337ab7;">{{$n->summary}}</h3>
                    <p style="color: #337ab7; font-size: 18px;">{{$n->description}}</p>
                </div>
                @endforeach
            </div>
        </div>
    @else
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
    @endif
    </div>
</div>

@endsection
