@extends('frontend.layouts.master')

@section('content')

<!-- <div class="back-link">
    {{ link_to('', 'Back to Dashboard',array('class'=>'btn btn-primary')) }}
</div> -->

<div class="login-container">
    <div class="row">
        <div class="col-md-12">
            <div class="login_head">
                   <h3>{{ trans('Contact Us') }}</h3>
            </div>
            <div class="hpanel">
                <div class="panel-body">
                        <div class="row">
                            
                        </div>
                        {{ Form::open(['route' => 'postContactUs','id'=>'loginForm']) }}
                            <div class="form-group">
                                {{ Form::label('name', trans('Name'), ['class' => 'control-label']) }}
                                {{ Form::input('name', 'name', null, ['class' => 'form-control validate[required]', 'placeholder' => trans('Enter your Name')]) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('email', trans('Email'), ['class' => 'control-label']) }}
                                {{ Form::input('text', 'email', null, ['class' => 'form-control validate[required,custom[email]]', 'placeholder' => trans('Enter your Email')]) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('phone', trans('Contact Number'), ['class' => 'control-label']) }}
                                {{ Form::input('phone', 'phone', null, ['class' => 'form-control validate[required,custom[phone]]', 'placeholder' => trans('Contact Number')]) }}
                            </div> 
                            <div class="form-group">
                                {{ Form::label('subject', trans('Subject'), ['class' => 'control-label']) }}
                                {{ Form::input('subject', 'subject', null, ['class' => 'form-control validate[required]', 'placeholder' => trans('Subject')]) }}
                            </div> 
                            <div class="form-group">
                                {{ Form::label('message', trans('Message'), ['class' => 'control-label']) }}
                                {{ Form::textarea('message',  null, ['class' => 'form-control validate[required]', 'placeholder' => trans('Message')]) }}
                            </div>                            
                            {{ Form::submit(trans('Send Command'), ['class' => 'btn save_btn', 'style' => 'margin-right:15px']) }}
                           
                       {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>  
	$(document).ready(function(){
                
		$("#loginForm").validationEngine();
	});
</script>
@endsection