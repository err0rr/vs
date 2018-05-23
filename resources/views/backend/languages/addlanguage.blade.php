@extends ('backend.layouts.master')

@section ('title', trans('Add language'))

@section('page-header')
	<h1>
		{{ trans('Add language') }}  
	</h1>
@endsection

@section('content')
  {!! Form::open(['route' => 'storeLanguage', 'class' => 'form-horizontal','id'=>'myform' , 'role' => 'form','files'=>true, 'method' => 'post']) !!}
  
  <div class="form-group">
		{!! Form::label('Title', trans('name'), ['class' => 'col-lg-2 control-label']) !!}
		<div class="col-lg-10">
			{!! Form::text('name', null, ['class' => 'form-control validate[required]', 'placeholder' => trans('Enter language')]) !!}
		</div>
	</div><!--form control-->
	<div class="form-group">
		{!! Form::label('Image', trans('flag'), ['class' => 'col-lg-2 control-label']) !!}
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