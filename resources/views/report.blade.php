@extends('master')
@section('title','Page title')
@section('menu')
    @parent
@endsection
@section('content')
<div class="container">
    @foreach($instructions->all() as $instr)
    <div class="row">
        {!!Form::model($instructions, ['action'=>'App\Http\Controllers\NewController@sendReport'])!!}
        <p class="fs-10 main-color">{{$instr->summary}}</p>
        <div class="d-flex align-items">
            {!!Form::hidden('instrName', $instr->summary)!!}
            {!!Form::label('report', 'Describe the complaint')!!}
            <div class="d-flex">
                {!!Form::textarea('report')!!}
                <button class="btn btn-success" type="submit">Send</button>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
