@extends ('backend.layouts.master')

@section ('title', trans('View User'))
@section('meta_description',trans('View User Details'))

@section('content')

	<div class="row">
		<div class="col-md-12">
			<div class="hpanel">
				<div class="panel-heading">
					<div class="panel-tools"></div>
					{{ trans('View User') }}
				</div>
				<div class="panel-body">
					
					@if(!empty($user_view))
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Id</label>
							<div class="col-md-9">
								<label class="col-md-3 control-label" style="font-weight:500;" for="text-input">{{ ucfirst($user_view->id) }}</label>
							</div>
						</div><br>
						@endif
					@if(!empty($user_view))	
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Name</label>
							<div class="col-md-9">
								<label class="col-md-3 control-label" style="font-weight:500;" for="text-input">{{ $user_view->name }}</label>
							</div>
						</div><br>
						@endif
					@if(!empty($user_view))	
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">User Name</label>
							<div class="col-md-9">
								<label class="col-md-3 control-label" style="font-weight:500;" for="text-input">{{ $user_view->username }}</label>
							</div>
						</div><br>
						@endif
					@if(!empty($user_view))	
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Email</label>
							<div class="col-md-9">
								<label class="col-md-3 control-label" style="font-weight:500;" for="text-input">{{ $user_view->email }}</label>
							</div>
						</div><br>
						@endif
					@if(!empty($user_view))	
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Phone</label>
							<div class="col-md-9">
								<label class="col-md-3 control-label" style="font-weight:500;" for="text-input">{{ $user_view->phone }}</label>
							</div>
						</div><br>
						@endif
					@if(!empty($user_view_info))	
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Region</label>
							<div class="col-md-9">
							@if(!empty($user_view_info))
								<label class="col-md-3 control-label" style="font-weight:500;" for="text-input">{{ $user_view_info->region }}</label>
								@endif
							</div>
						</div><br>
						@endif
					@if(!empty($user_view_info))	
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Area</label>
							<div class="col-md-9">
								<label class="col-md-3 control-label" style="font-weight:500;" for="text-input">{{ $user_view_info->area }}</label>
							</div>
						</div><br>
						@endif
					@if(!empty($user_view_info))	
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Min.Rate</label>
							<div class="col-md-9">
								<label class="col-md-3 control-label" style="font-weight:500;" for="text-input">{{ $user_view_info->minimum_rate }}</label>
							</div>
						</div><br>
						@endif
					@if(!empty($user_view_info))	
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Instruction</label>
							<div class="col-md-9">
								<label class="col-md-3 control-label" style="font-weight:500;" for="text-input">{{ $user_view_info->instruction }}</label>
							</div>
						</div><br>
						@endif
					@if(!empty($user_view_info))	
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Message</label>
							<div class="col-md-9">
								<label class="col-md-12 control-label" style="font-weight:500;" for="text-input">{{ $user_view_info->message }}</label>
							</div>
						</div><br>
						@endif
					@if(!empty($user_view_lang))	
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Language</label>
								<div class="col-md-9">
							@foreach($user_view_lang as $lang)			
									<img style='height: 50px;width: 50px;' src="{{ asset('img/lang_flag/'.$lang->flag) }}" onerror="this.src='{{ asset('img/no-image.jpg') }}';">
									{{ $lang->name }}&nbsp;&nbsp;&nbsp;   
							@endforeach
								</div>
						</div><br><br><br>
						@endif
					@if(!empty($user_view_serv))	
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Services</label>
								<div class="col-md-9">
							@foreach($user_view_serv as $serv)			
									{{ $serv->name }},&nbsp;&nbsp;
							@endforeach
								</div>
						</div><br>
						@endif
					@if(!empty($user_view))																	
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Status</label>
							<div class="col-md-9">
								
									@if($user_view->status == 'Y')
										Active
									@else
										Inactive
									@endif
								
							</div>
						</div><br>
						@endif
					@if(!empty($user_view))	
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Create Date</label>
							<div class="col-md-9">
								
								{{ $user_view->created_at }}
							</div>
						</div><br>
						@endif
					@if(!empty($user_view))	
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Update Date</label>
							<div class="col-md-9">
								{{ $user_view->updated_at }}
							</div>
						</div><br>
						@endif
					@if(!empty($user_view_img))	
						<div class="form-group">
							<label class="col-md-3 control-label" for="text-input">Image</label>
							<div class="col-md-9">
								<img style='height: 100px;width: 100px;' src="{{ asset('img/users/'.$user_view->photo) }}" onerror="this.src='{{ asset('img/no-image.jpg') }}';">&nbsp;&nbsp;
								@foreach($user_view_img as $img)
								
								<img style='height: 100px;width: 100px;' src="{{ asset('img/users/'.$img->filename) }}" onerror="this.src='{{ asset('img/no-image.jpg') }}';">&nbsp;&nbsp;
								@endforeach								
							</div>
						</div><br>
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