@extends ('backend.layouts.master')
@section ('title', trans('add Faqs') . ' | ' . trans('add Faqs'))
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="hpanel">
            <div class="panel-heading">
                <div class="panel-tools">
                </div>
                {{ trans('Add Faqs') }}
            </div>
            <div class="panel-body">
				{!! Form::open(['url' =>'admin/faqs/store', 'files'=>true,'class' => 'form-horizontal','id'=>'myform' , 'role' => 'form','files'=>true, 'method' => 'post']) !!}

				  	<div class="form-group">
						{!! Form::label('Question', trans('Question'), ['class' => 'col-lg-2 control-label']) !!}
						<div class="col-lg-10">
							{!! Form::text('question', null, ['class' => 'validate[required] form-control', 'placeholder' => trans('Enter Your question')]) !!}
						</div>
					</div><!--form control-->

					<div class="form-group">
						{!! Form::label('Answer', trans('Answer'), ['class' => 'col-lg-2 control-label']) !!}
						<div class="col-lg-10">
					
							{!! Form::textarea('answer', null, ['class' => 'form-control validate[required]',  'placeholder' => trans('Enter Your Answer')]) !!}
						</div>
					</div>
					

					<div class="form-group">
						{!! Form::label('Active', trans('Active'), ['class' => 'col-lg-2 control-label']) !!}
						<div class="col-lg-10">
							<input type="checkbox" value="1" name="confirmed" checked="checked" />
						</div>
					</div><!--form control-->		 
			</div>
		</div>
		<div class="well">
			<div class="pull-left">
				<a href="{{ url('admin/faqs') }}"
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
@stop