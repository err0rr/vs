@extends('frontend.layouts.master')

@section('content')
    <div class="">

         <div class="login_block">

            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('labels.frontend.auth.register_box_title') }}</div>

                <div class="panel-body">

                    {{ Form::open(['route' => 'auth.register', 'class' => 'form-horizontal', 'id' => 'taskForm']) }}

                    <div class="form-group">
                        {{ Form::label('name', trans('validation.attributes.frontend.name'), ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-8">
                            {{ Form::input('name', 'name', null, ['class' => 'validate[required] form-control', 'placeholder' => trans('validation.attributes.frontend.name')]) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        {{ Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-8">
                            {{ Form::input('email', 'email', null, ['class' => 'validate[required,custom[email]] form-control', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        {{ Form::label('password', trans('validation.attributes.frontend.password'), ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-8">
                            {{ Form::input('password', 'password', null, ['class' => 'validate[required] form-control', 'placeholder' => trans('validation.attributes.frontend.password')]) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        {{ Form::label('password_confirmation', trans('validation.attributes.frontend.password_confirmation'), ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-8">
                            {{ Form::input('password', 'password_confirmation', null, ['class' => 'validate[required,equals[password]] form-control', 'placeholder' => trans('validation.attributes.frontend.password_confirmation')]) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    @if (config('access.captcha.registration'))
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                {!! Form::captcha() !!}
                                {{ Form::hidden('captcha_status', 'true') }}
                            </div><!--col-md-6-->
                        </div><!--form-group-->
                    @endif

                    <div class="form-group">
					<div class="col-md-3">&nbsp;</div>
                        <div class="col-md-8">
                            {{ Form::submit(trans('labels.frontend.auth.register_button'), ['class' => 'btn btn-primary reg_bttn', 'style' => '']) }}
                        <input id="name" class="form-control" placeholder="Name" name="user_type" type="hidden" value="Member">
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    {{ Form::close() }}

                </div><!-- panel body -->

            </div><!-- panel -->

        </div><!-- col-md-8 -->

    </div><!-- row -->
    <script> 

 $("#taskForm").validationEngine();</script>
@endsection

@section('after-scripts-end')
    @if (config('access.captcha.registration'))
        {!! Captcha::script() !!}
    @endif
@stop