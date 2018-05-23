@extends ('backend.layouts.master')
@section ('title', trans('Service Management') . ' | ' . trans('Edit Service'))
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
				{{ trans('Edit Service') }}
			</div>
			<div class="panel-body">
				{!! Form::open(['url' => ((isset($service_edit->id)) ? ('admin/services/edit/store/'.$service_edit->id) : route("servicesEditStore")),'files'=>true,'class' => 'form-horizontal','id'=>'myform' ,'role' => 'form', 'method' => 'post']) !!}


					<div class="form-group">
						{!! Form::label('Name', trans('Name'), ['class' => 'col-lg-2 control-label']) !!}
						<div class="col-lg-10">
							{!! Form::text('name', (isset($service_edit->name) ? $service_edit->name :''), ['class' => 'form-control validate[required]', 'placeholder' => trans('Enter your Page Name')]) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('Description', trans('Description'), ['class' => 'col-lg-2 control-label']) !!}
						<div class="col-lg-10">
							{!! Form::textarea('description', (isset($service_edit->description) ? $service_edit->description :''), ['class' => 'form-control validate[required]', 'placeholder' => trans('Enter your Page content')]) !!}
						</div>
					</div><!--form control-->
					<div class="form-group">
						{!! Form::label('Active', trans('Active'), ['class' => 'col-lg-2 control-label']) !!}
					   
						<div class="col-lg-10">
							<input type="checkbox" value="1" name="confirmed" {{ $service_edit->is_active == 'Y' ? 'checked' : ''}} />
						</div>

					</div><!--form control-->
				</div>
			</div>
	
			<div class="well">
				<div class="pull-left">
					<a href="{{ URL::previous() }}"
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