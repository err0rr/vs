@extends ('backend.layouts.master')

@section ('title', trans('Add Slider'))

@section('page-header')
	<h1>
		{{ trans('Add Slider') }}  
	</h1>
@endsection

@section('content')
  {!! Form::open(['route' => 'enterSlider', 'class' => 'form-horizontal','id'=>'myform' , 'role' => 'form','files'=>true, 'method' => 'post']) !!}
  
  <div class="form-group">
		{!! Form::label('Title', trans('Title'), ['class' => 'col-lg-2 control-label']) !!}
		<div class="col-lg-10">
			{!! Form::text('title', null, ['class' => 'form-control validate[required]', 'placeholder' => trans('Enter Slider title')]) !!}
		</div>
	</div><!--form control-->

	<div class="form-group">
		{!! Form::label('Description', trans('Description'), ['class' => 'col-lg-2 control-label']) !!}
		<div class="col-lg-10">
			{!! Form::textarea('description', null, ['class' => 'form-control validate[required]', 'placeholder' => trans('Enter your Description')]) !!}
		</div>
	</div><!--form control-->

	<div class="form-group">
		{!! Form::label('Url', trans('Url'), ['class' => 'col-lg-2 control-label']) !!}
		<div class="col-lg-10">
			{!! Form::text('youtube_url', null, ['class' => 'form-control', 'placeholder' => trans('Enter your Youtube Url')]) !!}
		</div>
	</div><!--form control-->

	<div class="form-group">
		{!! Form::label('Image', trans('Image'), ['class' => 'col-lg-2 control-label']) !!}
		<div class="col-lg-10">
			{!! Form::file('image', null, ['class' => 'form-control validate[required]']) !!}
		</div>
	</div><!--form control-->

	<div class="form-group">
		{!! Form::label('Active', trans('Active'), ['class' => 'col-lg-2 control-label']) !!}
		<div class="col-lg-10">
			<input type="checkbox" value="1" name="confirmed" checked="checked" />
		</div>
	</div><!--form control-->
	
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
@stop