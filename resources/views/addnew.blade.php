@extends('master')
@section('title','Page title')
@section('menu')
    @parent
@endsection
@section('content')
<div class="container">
    <div class="row">
        {!! Form::model($news, ['action'=>'App\Http\Controllers\NewController@store', 'files'=>true])!!}
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

@endsection
