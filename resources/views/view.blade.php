@extends('master')
@section('title','Page title')
@section('menu')
    @parent
@endsection
@section('content')
<div class="container">
    <div class="row">
    @foreach($view->all() as $n)
            <div class="row">
                <h3>{{$n->summary}}</h3>
                <img src="{{$n->imagepath}}" alt="{{$n->summary}}"></br>
                <p><em>{{$n->short_description}}</em></p>
                <p>{{$n->full_text}}</p>
            </div>
        @endforeach
    </div>
</div>

@endsection
