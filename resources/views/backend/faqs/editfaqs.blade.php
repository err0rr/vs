@extends ('backend.layouts.master')
@section ('title', trans('Task Management') . ' | ' . trans('Edit comptition'))
@section ('breadcrumbs')
	<li><a href="{!!route('admin.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
	<li class="active"></li>
@stop 

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="hpanel">
			<div class="panel-heading">
				<div class="panel-tools">
				</div>
				{{ trans('Edit faqs') }}
			</div>
			<div class="panel-body">
				{!! Form::open(['url' => ((isset($faqs_edit->id)) ? ('admin/edit/faqs/store/'.$faqs_edit->id) : route("faqsEditStore")),'files'=>true,'class' => 'form-horizontal','id'=>'myform' ,'role' => 'form', 'method' => 'post']) !!}


					<div class="form-group">
						{!! Form::label('Question', trans('Question'), ['class' => 'col-lg-2 control-label']) !!}
						<div class="col-lg-10">
							{!! Form::text('Question', (isset($faqs_edit->question) ? $faqs_edit->question :''), ['class' => 'form-control validate[required]', 'placeholder' => trans('Enter your Page Question')]) !!}
						</div>
					</div>
					

  

					<div class="form-group">
						{!! Form::label('Answer', trans('Answer'), ['class' => 'col-lg-2 control-label']) !!}
						<div class="col-lg-10">
							{!! Form::textarea('answer', (isset($faqs_edit->answer) ? $faqs_edit->answer :''), ['class' => 'form-control validate[required]', 'placeholder' => trans('Enter your Answer')]) !!}
						</div>
					</div>



					<div class="form-group">
						{!! Form::label('Active', trans('Active'), ['class' => 'col-lg-2 control-label']) !!}
					   
						<div class="col-lg-10">
							<input type="checkbox" value="1" name="confirmed" {{ $faqs_edit->is_active == 'Y' ? 'checked' : ''}} />
						</div>


					</div><!--form control-->
				</div>
			</div>
	
			<div class="well">
				<div class="pull-left">
					<a href=""
					   class="btn btn-danger btn-xs">{{ trans('Back') }}</a>
				</div>

				<div class="pull-right">
					<input type="submit" class="btn btn-success btn-xs" value="{{ trans('Save') }}"/>
				</div>
				<div class="clearfix"></div>
			</div><!--well-->

			{!! Form::close() !!}

	</div>
</div>
 
<script type='text/javascript'>  
	$(document).ready(function(){
		$("#myform").validationEngine();
	});
</script>  
@stop