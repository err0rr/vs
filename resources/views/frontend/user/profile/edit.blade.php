@extends('frontend.layouts.master')

@section('content')
   

        <div class="login_block">

            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('labels.frontend.user.profile.update_information') }}</div>

                <div class="panel-body">

                    {{ Form::model($user, ['route' => 'frontend.user.profile.update1', 'class' => 'form-horizontal', 'id' => 'taskForm', 'files'=>true, 'method' => 'PATCH']) }}

                    <div class="form-group">
                        {{ Form::label('name', trans('validation.attributes.frontend.name'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::input('text', 'name', null, ['class' => 'validate[required] form-control', 'placeholder' => trans('validation.attributes.frontend.name')]) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('name', trans('validation.attributes.frontend.phone'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::input('text', 'phone', null, ['class' => 'validate[required] form-control', 'placeholder' => trans('validation.attributes.frontend.phone')]) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('Image', trans('Image'), ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
						  <div class="edit_upload_img">
                             <img src="{!! URL::to('img/users').'/'.$user->photo!!}" class='user-profile-image' style="height:70px;">
							</div>
                            {!! Form::hidden('old_image', (isset($user->photo) ? $user->photo :''), ['class' => '', 'placeholder' => trans('')]) !!}
                            {!! Form::file('photo', null, ['class' => 'form-control validate[required]']) !!}
                        </div>
                    </div>
                    @if ($user->canChangeEmail())
                        <div class="form-group">
                            {{ Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::input('email', 'email', null, ['class' => 'validate[required,custom[email]] form-control', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
                            </div>
                        </div>
                    @endif
                        @if($user->user_type=="Escort")

                        @include('frontend.user.profile.escortprofile') 
                                              
                        @endif
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                        <input type="hidden" value="{{$user->user_type}}" name="user_type">
                        
                            {{ Form::submit(trans('labels.general.buttons.save'), ['class' => 'btn btn-primary']) }}
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