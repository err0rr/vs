@extends ('backend.layouts.master')

@section ('title', trans('Time slots'))
@section('meta_description',trans('Time slots'))

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
                {{ trans('Time slot Management') }}
                <a href="{{ url('admin/add/timeslot')}}" class="btn btn-xs btn-primary pull-right">Add New Time sloat</a>
                <!-- <button class="btn btn-xs btn-primary pull-right" id="add" value="0">Add New Faqs</button> -->
	        </div>            
	     	<div class="panel-body">
                <div class="table-responsive">
					<table id="example" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>{{ trans('Id') }}</th>
								<th>{{ trans('Start time') }}</th>
								<th>{{ trans('End time')}}</th>
								<th>{{ trans('Created') }}</th>
                                <th>{{ trans('Status') }}</th>
								<th>{{ trans('Action') }}</th>
							</tr>
						</thead>
						<tbody id="serviceData">
							@if(!empty($timeslot))
							@foreach($timeslot as $key=>$vals)
								<tr>
									<td>{!! $key+1 !!}</td>
									<td>{!! $vals->start_time !!}..</td>
									<td>{!! $vals->end_time !!}..</td>
									<td>{{ $vals->created_at }}</td>
									<td>
										@if($vals->is_active == 'N')
											<a class="btn btn-xs btn-danger" href="{!!url('admin/timeslot/change/status/')."/".$vals->id!!}">Inactive</a>
										@else
											<a class="btn btn-xs btn-primary" href="{!!url('admin/timeslot/change/status/')."/".$vals->id!!}">Active</a>
										@endif
									</td>
									<td>
                                        <!-- <a href="{{url('admin/faqs/view')."/".$vals->id}}" class="btn btn-success btn-xs"><i class="fa fa-eye" data-toggle="tooltip" data-palcement="top" title data-original-title="View"></i></a>  -->
                                        <!-- <button class="btn btn-warning btn-xs btn-detail open-modal" id="idsav" value="{{$vals->id}}">Edit</button> -->
                                        <!-- <a href="{{ url('admin/edit/timeslot')."/".$vals->id}}" class="btn btn-warning btn-xs btn-detail open-modal">Edit</a> -->

										<a href="{{ url('admin/delete/timeslot')."/".$vals->id}}" onclick="return confirm('Are you sure you want to delete this Time sloat?')" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-palcement="top" title data-original-title="Delete"></i></a>

									</td>
								</tr>		
							@endforeach
                            @else
                                <center><td> Data not availeble </td></center>
                            @endif                            
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@stop