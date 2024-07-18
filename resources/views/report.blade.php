@extends('master')
@section('title','Page title')
@section('menu')
    @parent
@endsection
@section('content')
<div class="container">
    @foreach($instructions->all() as $instr)
    <div class="row">
        {!!Form::model($instructions, ['action'=>'App\Http\Controllers\NewController@index'])!!}
        <p>{{$instr->summary}}</p>
        {!!Form::label('report', 'Describe the complaint')!!}
        {!!Form::textarea('report')!!}
        <button class="btn btn-success" type="submit">Send</button>
    </div>
    @endforeach
</div>
@endsection
