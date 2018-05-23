@extends ('backend.layouts.master')

@section ('title', trans('View faqs'))
@section('meta_description',trans('View faqs Details'))

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="hpanel">
				<div class="panel-heading">
					<div class="panel-tools"></div>
					{{ trans('View faqs') }}
				</div>
				<div class="panel-body">
					@if(!empty($faqs_view) && $faqs_view != '')
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Id</label>
							<div class="col-md-9">
								<label class="col-md-3 control-label" style="font-weight:500;" for="text-input">{{ ucfirst($faqs_view->id) }}</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Question</label>
							<div class="col-md-9">
								<label class="col-md-3 control-label" style="font-weight:500;" for="text-input">{{ $faqs_view->question }}</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Answer</label>
							<div class="col-md-9">
								<label class="col-md-12 control-label" style="font-weight:500;" for="text-input">{{ $faqs_view->answer }}</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Status</label>
							<div class="col-md-9">
								<label class="col-md-3 control-label" style="font-weight:500;" for="text-input">
									@if($faqs_view->is_active == 'Y')
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
								<label class="col-md-3 control-label" style="font-weight:500;" for="text-input">{{ $faqs_view->created_at }}</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Update Date</label>
							<div class="col-md-9">
								<label class="col-md-3 control-label" style="font-weight:500;" for="text-input">{{ $faqs_view->updated_at }}</label>
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