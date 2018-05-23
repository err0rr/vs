@extends('frontend.layouts.master')
@section('content')
<div class="msg_create col-md-12 col-sm-12 pad-0">
<h1>Create your Booking	</h1>
  {!! Form::open(array('url' => 'bookingPost', 'id'=> 'form_validation')) !!}
	<div class="create_events">
		<div class="col-lg-6 col-md-6 col-sm-6">
			{!! Form::hidden('profile_id', $id, ['class' => 'form-control']) !!}
			<div class="form-group">
				{!! Form::label('subject', 'Date Time', ['class' => 'control-label']) !!}
				{!! Form::text('subject', null, ['class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
				{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
			</div>       
			<div class="form-group">
				{!! Form::label('datetime', 'Date Time', ['class' => 'control-label']) !!}
				{!! Form::input('text', 'datetime', null, ['class' => 'form-control box-shadow push-right datepicker push-bottom','id'=> 'datepicker2']) !!}
			</div>
			<div class="form-group submit_button">
				{!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
			</div>
        </div>
	</div>
</div>
{!! Form::close() !!}
@stop