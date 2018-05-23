@extends ('backend.layouts.master')
@section ('title', trans('Time Slot Management') . ' | ' . trans('Edit comptition'))
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
				{{ trans('Edit Time Slot') }}
			</div>
			<div class="panel-body">
				{!! Form::open(['url' => ((isset($timeslot_arr->id)) ? ('admin/enter/timeslot/'.$timeslot_arr->id) : route("Time SlotEditStore")),'files'=>true,'class' => 'form-horizontal','id'=>'myform' ,'role' => 'form', 'method' => 'post']) !!}
					<div class="form-group">
						{!! Form::label('start_time', trans('Start Time'), ['class' => 'col-lg-2 control-label']) !!}
							<div class="col-lg-10">
								<select id='timepicker1' class="form-control validate[required]" name="start_time">
								    @for($i=0; $i<24; $i++)
								    	@for($j=0; $j<60; $j++)
									    	@if($j%15 == 0)

									    		<option <?php if($timeslot_arr->start_time == str_pad($i, 2, "0", STR_PAD_LEFT).':'.str_pad($j, 2, "0", STR_PAD_LEFT).':00'){ echo "selected='selected'"; }?> value="{{str_pad($i, 2, '0', STR_PAD_LEFT).':'.str_pad($j, 2, '0', STR_PAD_LEFT).':00'}}">{{str_pad($i, 2, '0', STR_PAD_LEFT).':'.str_pad($j, 2, '0', STR_PAD_LEFT)}}</option>
								
									    	@endif
								    	@endfor
								    @endfor 
								 </select>
								 <div style="display:none" id="time1"><p class="error_cutm" style="color:red">Please add time less than end time</div>
							</div>
					</div>

					<div class="form-group">
						{!! Form::label('end_time', trans('End Time'), ['class' => 'col-lg-2 control-label']) !!}
							<div class="col-lg-10">
								<select id='timepicker2' class="form-control validate[required]" name="end_time">
								    @for($i=0; $i<24; $i++)
								    	@for($j=0; $j<60; $j++)
									    	@if($j%15 == 0)
									    		<option <?php if($timeslot_arr->end_time == str_pad($i, 2, "0", STR_PAD_LEFT).':'.str_pad($j, 2, "0", STR_PAD_LEFT).':00'){ echo "selected='selected'"; }?> value="{{str_pad($i, 2, '0', STR_PAD_LEFT).':'.str_pad($j, 2, '0', STR_PAD_LEFT).':00'}}">{{str_pad($i, 2, '0', STR_PAD_LEFT).':'.str_pad($j, 2, '0', STR_PAD_LEFT)}}</option>
									    	@endif
								    	@endfor
								    @endfor 
								 </select>
								 <div style="display:none" id="time2"><p style="color:red">Please add time greater than start time</div>
							</div>
					</div>	

					<div class="form-group">
						{!! Form::label('Active', trans('Active'), ['class' => 'col-lg-2 control-label']) !!}
					   
						<div class="col-lg-10">
							<input type="checkbox" value="1" name="confirmed" {{ $timeslot_arr->is_active == 'Y' ? 'checked' : ''}} />
						</div>


					</div><!--form control-->
			
			
	
				<div class="well">
					<div class="pull-left">
						<a href="{{ url('admin/listtimeslot') }}"
				   class="btn btn-danger btn-xs">{{ trans('Back') }}</a>
					</div>

					<div class="save_btn pull-right">
						<input type="submit" class="btn btn-success btn-xs" value="{{ trans('Save') }}"/>
					</div>
					<div class="clearfix"></div>
				</div><!--well-->
			
			{!! Form::close() !!}
			</div>
		</div>	
	</div>
</div>
 

@stop
@section('before-scripts-end')

<script type="text/javascript">
$(document).ready(function(){
	var s_time = [];
	var e_time = [];
	s_time = $('#timepicker1').val().split(':');
	e_time = $('#timepicker2').val().split(':');
	if(s_time[0]+'.'+s_time[1]+'.'+s_time[2] >= e_time[0]+'.'+e_time[1]+'.'+e_time[2]){
			$('#time1').show();
			$('#timepicker1').focus();
			$('.save_btn').hide();
	}else{
			$('#time1').hide();
			$('.save_btn').show();
	}

	$('#timepicker1').change(function(){
		$('#time1').hide();
		$('#time2').hide();
		var s_time = 0;
		var e_time = 0;
		s_time = $('#timepicker1').val().split(':');
		e_time = $('#timepicker2').val().split(':');
		if(s_time[0]+'.'+s_time[1]+'.'+s_time[2] >= e_time[0]+'.'+e_time[1]+'.'+e_time[2]){

			$('#time1').show();
			$('#timepicker1').focus();
			$('.save_btn').hide();
		}else{
			$('#time1').hide();
			$('.save_btn').show();
		}

		// $("#myform").trigger("validate");
	});	
	$('#timepicker2').change(function(){
		$('#time1').hide();
		$('#time2').hide();
		var s_time = 0;
		var e_time = 0;
		s_time = $('#timepicker1').val().split(':');
		e_time = $('#timepicker2').val().split(':');
		if(s_time[0]+'.'+s_time[1]+'.'+s_time[2] >= e_time[0]+'.'+e_time[1]+'.'+e_time[2]){
			$('#time2').show();
			$('#timepicker2').focus();
			$('.save_btn').hide();
		}else{
			$('#time2').hide();
			$('.save_btn').show();
		}

		// $("#myform").trigger("validate");
	});	

	// $( "#myform" ).validate({
	// 	onchage : true,
	// 	rules: {
	// 			start_time: {
	// 				required: true,
	// 				max : e_time[0]+'.'+e_time[1]+'.'+e_time[2],
	// 			},
	// 			end_time: {
	// 				required: true,
	// 				min: s_time[0]+'.'+s_time[1]+'.'+s_time[2],
	// 			},
	// 		}, 
	// 	messages: {
	// 	    start_time: "Please select time less than "+ e_time[0]+':'+e_time[1]+':'+e_time[2],
	// 	    end_time: "Please select time greater than "+ s_time[0]+':'+s_time[1]+':'+s_time[2],
	// 	    },
	// }); 
});
	
</script>
<style type="text/css">
	#timepicker1-error{
		color: red;
	}
	#timepicker2-error{
		color: red;
	}
</style>>
@stop