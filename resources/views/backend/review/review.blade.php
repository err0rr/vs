@extends ('backend.layouts.master')

@section ('title', trans('review'))
@section('meta_description',trans('review'))

@section ('breadcrumbs')
	<li><a href=""><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
	<li class="active"></li>
@stop 

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="hpanel">
            <div class="panel-heading">
	            <div class="panel-tools">
	            </div>
                {{ trans('Review Management') }}
                
	        </div>            
	     	<div class="panel-body">
                <div class="table-responsive">
					<table id="example" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>{{ trans('S.No.') }}</th>
								<th>{{ trans('Name') }}</th>
								<!-- <th>{{ trans('Postdate') }}</th> -->
								<th>{{ trans('Action') }}</th>
							</tr>
						</thead>
						<tbody>
							@if(!empty($reviews))
							@foreach($reviews as $k=>$vals)
							<tr>
								<td>{!! ucfirst($k+1) !!}</td>							
								<td>{!! ucfirst($vals->name) !!}</td>
								<!-- <td>{!! ucfirst($vals->created_at) !!}</td> -->
								<td>
									<a href="{{url('admin/review/view')."/".$vals->profile_id}}" class="btn btn-success btn-xs"><i class="fa fa-eye" data-toggle="tooltip" data-palcement="top" title data-original-title="View"></i></a> 
								</td>
							</tr>
							@endforeach
							@endif
						</tbody>						
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@stop