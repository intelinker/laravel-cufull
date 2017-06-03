@extends('app');

@section('content');

<div class="container" style="margin-top: 50px">
    <div class="row">
        <div class="col-md-11" role="main">

            @if($errors->any())
                <ul class="list-group">
                    @foreach($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{$error}}</li>
                    @endforeach
                </ul>
            @endif

            {!! Form::model($diary, ['method'=>'PATCH', 'url'=>'/diaries/'.$diary->id]) !!}
            @include('diary.editform')

            <div class="form-group">
                {!! Form::submit('发布', ['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}



        </div>
    </div>

@stop