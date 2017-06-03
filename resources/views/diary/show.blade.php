@extends('app');

@section('content');

    <div class="container">

        <div class="jumbotron">
            <div class="container">
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object img-circle" width="64" alt="图标" src="{{$diary->user->avatar}}">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="/diaries/{{$diary->id}}">{{$diary->title}}</a></h4>
                                    {{$diary->description}}
                                    {{$diary->user->name}}
                                    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->id == $diary->created_by)
                                        <a class="btn btn-lg btn-primary pull-right" methods="get" href='/diaries/{!! $diary->id !!}/edit' role="button">编辑笔记</a>
                                    @endif
                                    {{$diary->description}}
                                </div>
                            </div>
            </div>
            <h2>
            </h2>
        </div>
    </div>


    <div class="container">
        <div class="col-sm-8 blog-main">

            <div class="blog-post">
                <h2 class="blog-post-title">{{$diary->title}}</h2>
                <p class="blog-post-meta">{{$diary->created_at}} <a href="#">{{$diary->user->name}}</a></p>

                <blockquote>
                    {{$diary->description}}
                </blockquote>
                <h2>Heading</h2>
                <p>{{$diary->content}}</p>
                {{--<h3>Sub-heading</h3>--}}
                {{--<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>--}}
                {{--<pre><code>Example code block</code></pre>--}}
                {{--<p>Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>--}}
                {{--<h3>Sub-heading</h3>--}}
                {{--<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>--}}
                {{--<ul>--}}
                    {{--<li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>--}}
                    {{--<li>Donec id elit non mi porta gravida at eget metus.</li>--}}
                    {{--<li>Nulla vitae elit libero, a pharetra augue.</li>--}}
                {{--</ul>--}}
{{--                {{$diary->comments}}--}}
                <hr>
                @foreach($diary->comments as $comment)
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle" width="64" alt="图标" src="{{$comment->user->avatar}}">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="/diaries/{{$comment->user->name}}">{{$comment->user->name}}</a></h4>
                            {{$comment->content}}
                        </div>
                    </div>
                @endforeach
            </div><!-- /.blog-post -->

            <hr>
            @if(\Illuminate\Support\Facades\Auth::check())

                {!! Form::open(['url'=>'comments']) !!}

                {!! Form::hidden('diary_id', $diary->id) !!}
                <div class="col-md-12">
                    {!! Form::textarea('content', null, ['class'=>'form-control', 'rows'=>'10']) !!}
                </div>

                <div class="form-group pull-right">
                    {!! Form::submit('发表评论', ['class'=>'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}
            @else
                {!! Form::open(['url'=>'/user/login', 'method'=>'get']) !!}

                <div class="form-group">
                    {!! Form::submit('登陆后发表评论', ['class'=>'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}
            @endif



            <div class="clearfix"></div>

            <nav>
                <ul class="pager">
                    <li><a href="#">Previous</a></li>
                    <li><a href="#">Next</a></li>
                </ul>
            </nav>

        </div>
    </div>

@stop