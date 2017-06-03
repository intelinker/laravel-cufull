<div class="form-group">
    {!! Form::label('title', '标题', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('title', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('content', '内容', ['class'=>'col-md-4 control-label']) !!}
    {{--<div class="col-md-6">--}}
        {{--{!! Form::textarea('content', null, ['class'=>'form-control', 'rows'=>'10']) !!}--}}
    {{--</div>--}}
     {{--编辑器一定要被一个 class 为 editor 的容器包住--}}
    <div class="editor">
         {{--创建一个 textarea 而已，具体的看手册，主要在于它的 id 为 myEditor--}}
        {!! Form::textarea('content', '', ['class' => 'form-control','id'=>'myEditor']) !!}

         {{--上面的 Form::textarea ，在laravel 5 中被提了出去，如果你没安装的话，直接这样用--}}
        {{--<textarea id='myEditor'></textarea>--}}

         {{--主要还是在容器的 ID 为 myEditor 就行--}}

    </div>

</div>