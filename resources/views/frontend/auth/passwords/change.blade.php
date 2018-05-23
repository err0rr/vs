@extends('frontend.layouts.master')

@section('content')
@if(Auth::User()->user_type == 'Escort')
    <style type="text/css">
        .login_slider{ display: none; }
    </style>
    <?php
    $slider='';
    if(!empty(Auth::User()->coverphoto))
    {
        $path = public_path().'/img/users/';
        if(file_exists(rtrim($path,"'").Auth::User()->coverphoto))
        {
            $slider ='true';
        }
    }  ?>
    @if(!empty($slider))
    <div class="imgcrousel" style="background: url(<?php echo URL::to('/img/users/'.Auth::User()->coverphoto);?>); height: 540px; background-size: cover; background-position: center center;">
    @else
    <div class="imgcrousel" style="background: url(<?php echo URL::to('/img/slider_inner.jpg/') ?>); height: 540px; background-size: cover; background-position: center center;">
    @endif
        <div class="overlay_img"></div>
    </div>
@endif
    <div class="login_block">

            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('labels.frontend.user.passwords.change') }}</div>

                <div class="panel-body">

                    {{ Form::open(['route' => ['auth.password.change'], 'class' => 'form-horizontal',  'id' => 'taskForm']) }}

                    <div class="form-group">
                        {{ Form::label('old_password', trans('validation.attributes.frontend.old_password'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::input('password', 'old_password', null, ['class' => 'validate[required] form-control', 'placeholder' => trans('validation.attributes.frontend.old_password')]) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('password', trans('validation.attributes.frontend.new_password'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::input('password', 'password', null, ['class' => 'validate[required] form-control', 'placeholder' => trans('validation.attributes.frontend.new_password')]) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('password_confirmation', trans('validation.attributes.frontend.new_password_confirmation'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::input('password', 'password_confirmation', null, ['class' => 'validate[required,equals[password]] form-control', 'placeholder' => trans('validation.attributes.frontend.new_password_confirmation')]) }}
                        </div>
                    </div>

                    <div class="form-group">
					<div class="col-md-4">&nbsp;</div>
                        <div class="col-md-6">
                            {{ Form::submit(trans('labels.general.buttons.update'), ['class' => 'btn btn-primary ']) }}
                        </div>
                    </div>

                    {{ Form::close() }}

                </div><!--panel body-->

            </div><!-- panel -->

        </div><!-- col-md-10 -->
<script> 
    $("#taskForm").validationEngine();
 </script>        
@endsection