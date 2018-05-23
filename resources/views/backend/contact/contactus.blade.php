@extends ('backend.layouts.master')

@section ('title', trans('Contact Us Management'))
@section('meta_description',trans('Contact Us Management'))

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
                {{ trans('Contact Us Management') }}
                
	        </div>             
	     	<div class="panel-body">
                <div class="table-responsive">
					<table id="example" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>{{ trans('S.No.') }}</th>
								<th>{{ trans('Name') }}</th>
								<th>{{ trans('Email')}}</th>
								<th>{{ trans('Phone') }}</th>
								<th>{{ trans('Subject') }}</th>
								<th>{{ trans('Message') }}</th>
								<th>{{ trans('Created') }}</th>
								
							</tr>
						</thead>
						<tbody>
							@if(!empty($contact_us))
							@foreach($contact_us as $key=>$vals)
								<tr>
									<td>{!! $key+1 !!}</td>
									<td>{!! ucfirst($vals->name) !!}</td>
									<td>{{ $vals->email}}</td>
									<td>{{ $vals->phone}}</td>
									<td>{{ $vals->subject}}</td>
									<td>{{ $vals->message }}</td>
									<td>{{ $vals->created_at }}</td>
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

<script>
$(document).ready(function() {
	$('input[type = checkbox]').change(function () {
    $('.' + this.value).toggle(self.checked);
});
});
</script>
	
@stop