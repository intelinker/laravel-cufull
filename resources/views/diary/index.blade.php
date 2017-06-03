@extends('app');

@section('content');

<div class="container">

    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <h2>欢迎打开康复笔记
            <a class="btn btn-lg btn-primary pull-right" href="/diaries/create" role="button">写笔记</a>
        </h2>
    </div>

</div> <!-- /container -->

    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main">
                @foreach($diaries as $diary)
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle" width="64" alt="图标" src="{{$diary->user->avatar}}">
{{--                                {!! gettype($diary->user->avatar) !!}--}}
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="/diaries/{{$diary->id}}">{{$diary->title}}</a></h4>
                            {{$diary->description}}
                            回复:{{count($diary->comments)}}
                        </div>

                    </div>

                @endforeach

            </div>
        </div>
    </div>

@stop;


