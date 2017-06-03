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

            @if(\Illuminate\Support\Facades\Session::has('user_login_failed'))
            <div class="alert alert-danger" role="alert">
                {{\Illuminate\Support\Facades\Session::get('user_login_failed')}}
            </div>
            @endif
            {!! Form::open(['url'=>'/user/sublogin']) !!}
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

            <div class="form-group pull-right">
                {!! Form::submit('登录', ['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}



        </div>
    </div>



</div>



@stop