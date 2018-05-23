@extends ('backend.layouts.master')

@section ('title', trans('View language'))
@section('meta_description',trans('View language Details'))

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="hpanel">
				<div class="panel-heading">
					<div class="panel-tools"></div>
					{{ trans('View Language') }}
				</div>
				<div class="panel-body">
					@if(!empty($language_view) && $language_view != '')
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Id</label>
							<div class="col-md-9">
								<label class="col-md-3 control-label" style="font-weight:500;" for="text-input">{{ ucfirst($language_view->id) }}</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">name</label>
							<div class="col-md-9">
								<label class="col-md-3 control-label" style="font-weight:500;" for="text-input">{{ $language_view->name }}</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Status</label>
							<div class="col-md-9">
								<label class="col-md-3 control-label" style="font-weight:500;" for="text-input">
									@if($language_view->is_active == 'Y')
										Active
									@else
										Inactive
									@endif
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Create Date</label>
							<div class="col-md-9">
								<label class="col-md-3 control-label" style="font-weight:500;" for="text-input">{{ $language_view->created_at }}</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Update Date</label>
							<div class="col-md-9">
								<label class="col-md-3 control-label" style="font-weight:500;" for="text-input">{{ $language_view->updated_at }}</label>
							</div>
						</div>
							<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Image</label>
							<div class="col-md-9">
								<label class="col-md-3 control-label" style="font-weight:500;" for="text-input">
								<img style='height: 100px;width: 100px;' src="{{ asset('img/lang_flag/'.$language_view->flag) }}" onerror="this.src='{{ asset('img/no-image.jpg') }}';"></label>
								</div>
								</div>
					@endif
				</div>
			</div>
		</div>
	</div>
	<div class="well">
		<div class="pull-left">
			<a href="{{ URL::previous() }}" class="btn btn-danger btn-xs">{{ trans('Back') }}</a>
		</div>
		<div class="clearfix"></div>
	</div><!--well-->
@stop