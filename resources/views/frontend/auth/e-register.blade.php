@extends('frontend.layouts.master')

@section('content')
	<div class="">
		<div class="login_block">
			<div class="panel panel-default">
				<div class="panel-heading register_heading">{{ trans('labels.frontend.auth.register_box_title') }}</div>
				<div class="panel-body">
					{{ Form::open(['route' => 'auth.register', 'class' => 'form-horizontal','id'=>'register_form11', 'file'=>true,'enctype'=>'multipart/form-data']) }}
						<div id="step_1">
							<ul id="signup-step">
								<li id="personal" class="active">Personal Detail</li>
								<li id="general">General</li>
								<li id="password">Password</li>
							</ul>
								<div class="reg_form_box">
									<div class="form-group">
										{{ Form::label('name', trans('validation.attributes.frontend.name'), ['class' => 'col-md-3 control-label']) }}
										<div class="col-md-8">
											{{ Form::input('name', 'name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.name')]) }}
										</div><!--col-md-8-->
									</div><!--form-group-->
									<div class="form-group">
										{{ Form::label('name', trans('common.phone'), ['class' => 'col-md-3 control-label']) }}
										<div class="col-md-8">
											{{ Form::input('phone', 'phone', null, ['class' => 'form-control', 'placeholder' => trans('common.phone')]) }}
										</div><!--col-md-8-->
									</div><!--form-group-->
									<div class="form-group">
										{{ Form::label('email', trans('Email'), ['class' => 'col-md-3 control-label']) }}
										<div class="col-md-8">
											{{ Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
										</div><!--col-md-8-->
									</div><!--form-group-->
									<div class="form-group">
									<div class="col-md-3">&nbsp;</div>
									<div class="col-md-8">
									<button id="continue_btn1" class="btn btn-primary next_btn" type="button" >Next</button>
									</div>
								</div>
								</div>
						</div>
						<div id="step_2">
							<ul id="signup-step">
								<li id="personal">Personal Detail</li>
								<li id="general" class="active">General</li>
								<li id="password">Password</li>
							</ul>
								<div class="reg_form_box">
									<div class="form-group">
										{{ Form::label('email', trans('common.canton'), ['class' => 'col-md-3 control-label']) }}
										<div class="col-md-8">
											<select name="canton" class="form-control">
											<option value="0">canton</option>
												@foreach($canton as $v)
													<option value="{{$v->name}}">{{$v->name}}</option>
												@endforeach
											</select>
										</div><!--col-md-8-->
									</div><!--form-group-->
									<div class="form-group">
										{{ Form::label('email', trans('sexuality'), ['class' => 'col-md-3 control-label']) }}
										<div class="col-md-8">
											<select name="sexuality" class="form-control">			<option value="0">Sexuality</option>		
												<option>Gay</option>
												<option>Straight</option>
												<option>Trans</option>
												<option>Other</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('email', trans('common.image'), ['class' => 'col-md-3 control-label']) }}
										<div class="col-md-8">
											<input type="file" name="pic" class="form-control">
										</div><!--col-md-8-->
									</div><!--form-group-->
									<div class="form-group">
										{{ Form::label('email', trans('common.message'), ['class' => 'col-md-3 control-label']) }}
										<div class="col-md-8">
											<textarea name="message" style="height:100px;" class="form-control" placeholder="{{trans('validation.attributes.frontend.messagep')}}"></textarea>
										</div><!--col-md-8-->
									</div><!--form-group-->
									<div class="form-group">
									<div class="col-md-3">&nbsp;</div>
									<div class="col-md-8">
									<button id="previous_btn1" class="btn btn-primary" type="button" >Previous</button>
									<button id="continue_btn2" class="btn btn-primary" type="button" >Next</button>
								 </div>
								</div>
							 </div>
						</div>
						<div id="step_3">
							<ul id="signup-step">
								<li id="personal">Personal Detail</li>
								<li id="general">General</li>
								<li id="password"  class="active">Password</li>
							</ul>
							<div class="reg_form_box">
									<div class="form-group">
										{{ Form::label('password', trans('validation.attributes.frontend.password'), ['class' => 'col-md-3 control-label']) }}
										<div class="col-md-8">
											{{ Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.password')]) }}
										</div><!--col-md-8-->
									</div><!--form-group-->
									<div class="form-group">
										{{ Form::label('password_confirmation', trans('validation.attributes.frontend.password_confirmation'), ['class' => 'col-md-3 control-label']) }}
										<div class="col-md-8">
											{{ Form::input('password', 'password_confirmation', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.password_confirmation')]) }}
										</div><!--col-md-8-->
									</div><!--form-group-->
									@if (config('access.captcha.registration'))
										<div class="form-group">
											<div class="col-md-8 col-md-offset-4">
												{!! Form::captcha() !!}
												{{ Form::hidden('captcha_status', 'true') }}
											</div><!--col-md-8-->
										</div><!--form-group-->
									@endif
							     <div class="form-group">
								   <div class="col-md-3">&nbsp;</div>
									<div class="col-md-8">
									 <input id="name" class="form-control" placeholder="Name" name="user_type" type="hidden" value="Escort">
									<button id="previous_btn2" class="btn btn-primary" type="button" >Previous</button></a>
									<button id="continue_btn3" class="btn btn-primary" type="submit">Submit</button>
							   </div>
							  </div>
							</div>
						</div>
					{{ Form::close() }}
				</div><!-- panel body -->
			</div><!-- panel -->
		</div><!-- col-md-8 -->
	</div><!-- row -->
	{!! Html::script('js/jquery.validate.min.js') !!}
	<script type="text/javascript">
		$(document).ready(function () {
			$('#continue_btn1').click(function(){
				$("#register_form11").validate({
					rules: {
						name: "required",
						phone: "required",
						email: "required",
					}
				});
				if($("#register_form11").valid()==true){
					$('#step_1').hide();
					$('#step_3').hide();
					$('#step_2').show();
				}
			});
			$('#previous_btn1').click(function(){
				$('#step_1').show();
				$('#step_3').hide();
				$('#step_2').hide();
			});
			$('#continue_btn2').click(function(){
				$('#register_form11').removeData('validator')
				$("#register_form11").validate({
					rules: {
						canton: "required",
						pic: "required",
						message: "required",
					}
				});
				if($("#register_form11").valid()==true){
					$('#step_1').hide();
					$('#step_2').hide();
					$('#step_3').show();
				}
			});
			$('#previous_btn2').click(function(){
				$('#step_2').show();
				$('#step_3').hide();
				$('#step_1').hide();
			});
			$('#continue_btn3').click(function(){
				$('#register_form11').removeData('validator')
				$("#register_form11").validate({
					rules: {
						password: "required",
						password_confirmation: "required",
					}
				});
				if($("#register_form11").valid()==true){
					form.submit();
				}
			});
		});
	</script>
	<style>
		#step_2{ display:none; }
		#step_3{ display:none; }
	</style>
	<style>
		#signup-step{ float: left;margin-bottom: 0;margin-left:20px;padding: 0 !important;width: 100%;}
		#signup-step li{list-style:none; float:left;padding:5px 10px;border-top:#ff4d55 1px solid;border-left:#ff4d55 1px solid;border-right:#ff4d55 1px solid;border-radius:5px 5px 0 0;font-size: 14px;}
		.active{color:#FFF;}
		#signup-step li.active{background-color:#ff4d55;}
		#signup-form{clear:both;border:1px #ff4d55 solid;padding:20px;width:50%;margin:auto;}
	</style>
@endsection

@section('after-scripts-end')
	@if (config('access.captcha.registration'))
		{!! Captcha::script() !!}
	@endif
@stop