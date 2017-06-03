@extends('app');

@section('content')

    <div class="container"  style="margin-top: 55px">
        <div class="row">
            <div class="col-md-9" role="main">
                <div class="col-md-2">
                    <select class="form-control ">
                        <option>疾病</option>
                        <option>症状</option>
                        <option>药品</option>
                        <option>医院</option>
                        <option>药厂</option>
                        <option>药店</option>
                        <option>手术</option>
                        <option>检查</option>
                        <option>食品</option>
                        <option>食谱</option>
                        <option>问答</option>
                        <option>书籍</option>
                        <option>常识</option>

                    </select>
                </div>

                @foreach($data as $date)
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle" width="64" alt="图标" src="{{$date->img}}">
                                {{--                                {!! gettype($diary->user->avatar) !!}--}}
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="/diaries/{{$diary->id}}">{{$date->name}}</a></h4>
                            {{$date->description}}
                        </div>

                    </div>

                @endforeach

            </div>
        </div>
    </div>

@stop