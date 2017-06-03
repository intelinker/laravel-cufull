@extends('app');

@section('content');
<input type="hidden" name="_token" value="{csrf_token()}"/>
    <div class="container" style="margin-top: 50px">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" role="main">

                @if($errors->any())
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{$error}}</li>
                        @endforeach
                    </ul>
                @endif

                {{--<form class="form-horizontal" role="form" method="post" action="{{url('/user/register')}}" style="margin-top: 50px">--}}

                    {{--<input type="hidden" name="_token" value="{csrf_token()}"/>--}}

                    {{--<div class="form-group">--}}
                        {{--<label class="col-md-4 control-label" for="name">用户名</label>--}}
                        {{--<div class="col-md-6">--}}
                            {{--<input id="name" name="name" type="text" class="form-control">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label class="col-md-4 control-label" for="phone">手机号</label>--}}
                        {{--<div class="col-md-6">--}}
                            {{--<input id="phone" name="phone" type="number" class="form-control">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label class="col-md-4 control-label" for="password">密码</label>--}}
                        {{--<div class="col-md-6">--}}
                            {{--<input id="password" name="password" type="password" class="form-control">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label class="col-md-4 control-label" for="confirmPassword">确认密码</label>--}}
                        {{--<div class="col-md-6">--}}
                            {{--<input id="confirmPassword" name="confirmPassword" type="password" class="form-control">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<div class="col-md-6 col-md-offset-8">--}}
                            {{--<button type="submit" class="btn btn-primary" id="submitbtn">--}}
                                {{--<i class="fa fa-btn fa-user"></i> 注册--}}
                            {{--</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</form>--}}

                {!! Form::open(['url'=>'/user/subregister']) !!}
                <div class="form-group">
                    {!! Form::label('name', '用户名', ['class'=>'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('phone', '手机号', ['class'=>'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                        {!! Form::text('phone', null, ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('password', '密码', ['class'=>'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                        {!! Form::password('password', null, ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', '确认密码', ['class'=>'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                        {!! Form::password('password_confirmation', null, ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group pull-right">
                    {!! Form::submit('注册', ['class'=>'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}



            </div>
        </div>



    </div>

@stop