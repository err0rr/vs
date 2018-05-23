<div class="booking_time modal fade in" style="display: block;">
<div class="modal-dialog">
<div class="modal-content search_form_height bio_form">
<div class="modal-header">
	<span class="search_pop_header_title"><i>Select your booking time slot</i></span>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>

@if(!empty($time_slot[0]))
@if(count($disable_bookings) != count($time_slot))
{!! Form::open(array('url' => 'user/setbooking', 'files'=> true, 'method'=>'POST', 'id'=> 'form_validation')) !!}
<div class="content-9">
<div class="table-responsive">
	<table class="time_slot table table-striped table-bordered table-hover set_availity" >
		<thead><th>Select</th><th>Start Time</th><th>End Time</th></thead>
		<tbody>
		<input type="hidden" value="{!! $booking_date !!}" name="booking_date"/>
		<input type="hidden" value="{!! $escort_id !!}" name="escort_id"/>
		@foreach($time_slot as $key=>$val)
			
			@if(in_array($val->id, $disable_bookings))

			

			@else
			<tr>
			<td>
					
				<input id= "{!! $val->id !!}" value="{!! $val->id !!}" name="time_slot" type="radio"/><label for="{!! $val->id !!}"></label></li>
			</td>
			<td>{!! $val->start_time !!}</td>
			<td>{!! $val->end_time !!}</td>
			@endif
				
				
			</tr>

		@endforeach
	</tbody>
	</table>
	</div>
	</div>
    <div class="report-submit manage_model">
    	{!! Form::submit(trans('Book Now'), array('class' => 'btn save_btn')) !!} 
    </div>
    {!! Form::close() !!}
@else
	<p style="color:red;font-size:20px;"><i>Sorry, no availity..</i></p>
@endif  
@else
	<p style="color:red;font-size:20px;"><i>Sorry, no availity..</i></p>
@endif    
</div>
</div>
</div>

<script>
(function($){
	$(window).load(function(){
		 $(".content-9").mCustomScrollbar({
			scrollButtons:{enable:true},
			theme:"3d-thick"
		});
	});
})(jQuery);
</script>
<style type="text/css">
.content-9{
	max-height: 450px;
	display: -moz-stack;
	width: 100%;
}
.text-muted{
	font-style: 
}
</style>