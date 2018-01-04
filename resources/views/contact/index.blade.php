@extends('layouts.detail')
@section('content')
<!-- Portfolio Grid Section -->


<section id="portfolio" class="bg-light-gray">
    <div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            @unless($errors->isEmpty())
                <ul style="list-style: none;">
                    @foreach($errors->getMessages() as $error)
                        <li>
                            <p class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert"
                                   aria-label="close">&times;</a>
                                {{ $error[0] }}
                            </p>
                        </li>
                    @endforeach
                </ul>
            @endunless

            @foreach (Alert::getMessages() as $type => $messages)
                @foreach ($messages as $message)
                    <div class="alert alert-{{ ($type == 'error' ? 'danger' : $type) }}">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ $message }}
                    </div>
                @endforeach
            @endforeach

            {!! Form::open(['url'=>route('front.post_contact')]) !!}
            <div class="row control-group">
                <div class="form-group col-xs-12 floating-label-form-group controls">
                    {!! Form::label('name','Name') !!}
                    {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Name']) !!}
                </div>
            </div>
            <div class="row control-group">
                <div class="form-group col-xs-12 floating-label-form-group controls">
                    {!! Form::label('email','Email') !!}
                    {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Email']) !!}
                </div>
            </div>
            <div class="row control-group">
                <div class="form-group col-xs-12 floating-label-form-group controls">
                    {!! Form::label('phone','Phone or Cellular') !!}
                    {!! Form::text('phone',null,['class'=>'form-control','placeholder'=>'Phone']) !!}
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="row control-group">
                <div class="form-group col-xs-12 floating-label-form-group controls">
                    {!! Form::label('message','Messages') !!}
                    {!! Form::textarea('message',null,['class'=>'form-control','placeholder'=>'Please input your messages','rows'=>'5']) !!}
                </div>
            </div>
            <div class="row control-group">
                <div class="form-group col-xs-12 floating-label-form-group controls">
                    <div class="col-sm-10">
                        {!! app('captcha')->display() !!}
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="form-group col-xs-12">
                    {!! Form::submit('Send',['class'=>'btn btn-default']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<hr>
</section>
@stop