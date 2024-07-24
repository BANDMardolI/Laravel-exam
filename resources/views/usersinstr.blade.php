@extends('master')
@section('title','Page title')
@section('menu')
    @parent
@endsection
@section('content')
<div class="container">
    <div class="row">
        @foreach($instructions->all() as $n)
                    <div class="row d-flex border-bot">
                        <h3 style="color: #337ab7;">{{$n->summary}}</h3>
                        <a class="ml" href="{{url('apprinstr/'.$n->id)}}">
                            <i class="fa fa-check" style="color: #337ab7;"></i>
                        </a>
                        <a class="ml" href="{{url('cancelinstr/'.$n->id)}}">
                            <i class="fa fa-times" style="color: #337ab7;"></i>
                        </a>

                    </div>
        @endforeach
    </div>
</div>
@endsection