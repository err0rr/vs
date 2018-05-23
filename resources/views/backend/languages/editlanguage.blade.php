@extends ('backend.layouts.master')
@section ('title', trans('language edit') . ' | ' . trans('Edit language'))
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
				{{ trans('Edit language store') }}
			</div>
			<div class="panel-body">
				{!! Form::open(['url' => ((isset($language_edit->id)) ? ('admin/edit/language/store/'.$language_edit->id) : route("EditStoreLanguage")),'files'=>true,'class' => 'form-horizontal','id'=>'myform' ,'role' => 'form', 'method' => 'post']) !!}
					<div class="form-group">
						{!! Form::label('name', trans('name'), ['class' => 'col-lg-2 control-label']) !!}
						<div class="col-lg-10">
							{!! Form::text('name', (isset($language_edit->name) ? $language_edit->name :''), ['class' => 'form-control validate[required]', 'placeholder' => trans('Enter your language')]) !!}
						</div>
					</div>
					    <div class="form-group">
        					{!! Form::label('Image', trans('Image'), ['class' => 'col-lg-2 control-label']) !!}
        					<div class="col-lg-10">
             				<img src="{!! URL::to('img/lang_flag').'/'.$language_edit->flag!!}" class='user-profile-image' style="height:100px;">
            			{!! Form::hidden('old_image', (isset($language_edit->flag) ? $language_edit->flag :''), ['class' => '', 'placeholder' => trans('')]) !!}
            			{!! Form::file('image', null, ['class' => 'form-control validate[required]']) !!}
        			</div>
   					 </div><!--form control-->
					<div class="form-group">
						{!! Form::label('Active', trans('Active'), ['class' => 'col-lg-2 control-label']) !!}
					   
						<div class="col-lg-10">
							<input type="checkbox" value="1" name="confirmed" {{ $language_edit->is_active == 'Y' ? 'checked' : ''}} />
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