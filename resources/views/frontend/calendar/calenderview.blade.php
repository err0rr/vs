@extends('frontend.layouts.master')
@section('content')
<style type="text/css">
	.login_slider{
		display: none;
	}
</style>
	<?php
	$slider='';
	if(!empty(Auth::User()->coverphoto))
	{
		$path = public_path().'/img/users/';
		if(file_exists(rtrim($path,"'").Auth::User()->coverphoto))
		{
			$slider ='true';
		}
	} ?>
	@if(!empty($slider))
	<div class="imgcrousel" style="background: url(img/users/<?php echo Auth::User()->coverphoto; ?>); height: 540px; background-size: cover; background-position: center center;">
	@else
	<div class="imgcrousel" style="background: url(img/slider_inner.jpg); height: 540px; background-size: cover; background-position: center center;">
	@endif
		<div class="overlay_img"></div>
	</div>
	{!! Html::script('js/lightbox-plus-jquery.min.js') !!}
	{!! Html::script('js/1.11.1_jquery.min.js') !!}
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	{!! Html::style('css/jquery-ui.min.css') !!}
	<!--for lightbox -->
	{!! Html::style('css/lightbox.css')!!}
	{!! Html::script('js/jquery-ui.js') !!}
	{!! Html::script('js/jquery-ui.min.js') !!}
	<?php $dates=''; foreach ($blockDate as $key => $value) {
		$dates.=trim($value).',';
	}  $sel_date = date('m-d-Y'); ?>
	<div id="CalselectDate" style="display: none;">{!! $dates !!}</div>
	<div class="">
		<div class="dashboard_block faq_block">
			<div class="panel panel-default">
				<div class="panel-heading">Booking Calendar</div>
				<div class="panel-body">
					<div role="tabpanelfhfg">
						<div class="tab-content">
							<!-- start -->
							{!! HTML::style('calender/css/calendar.css') !!}
							{!! HTML::style('calender/css/custom_2.css') !!}
							{!! HTML::script('calender/js/modernizr.custom.63321.js') !!}
							<div class="container1">
								<div class="col-md-8 col-sm-6">
									<section class="main1">
										<div class="custom-calendar-wrap">
											<div id="custom-inner" class="custom-inner">
												<div class="custom-header clearfix">
													<nav>
														<span id="custom-prev" class="custom-prev"></span>
														<span id="custom-next" class="custom-next"></span>
													</nav>
													<h2 id="custom-month" class="custom-month"></h2>
													<h3 id="custom-year" class="custom-year"></h3>
												</div>
												<div id="calendar" class="fc-calendar-container"></div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-md-4 col-sm-6">
									<div class="custom-wrap1" >
										<div class="custom-box">
											<div class="booking-date">Booking Rate</div>
											{!! Form::open(array('url' => 'user/escortRateUpdate', 'files'=> true, 'method'=>'POST', 'id'=> 'form_validation')) !!}
												<input type="hidden" name="date" id="date" value="" readonly>
												<div id="changeescortprice">
													<div class="booking-rate">
														<p><span>15 MINS : </span><input class="mins" type="text" name="15m" id="15m" value="{!! $user_info->rate_15m !!}" ></p>
														<p><span>30 MINS :</span><input class="minss" type="text" name="30m" id="30m" value="{!! $user_info->rate_30m !!}" ></p>
														<p><span>1 HR :</span><input class="mins-hr" type="text" name="1hr" id="1hr" value="{!! $user_info->rate_1h !!}" ></p>
														<p><span>24 HR : </span><input class="mins-hrr" type="text" name="1d" id="1d" value="{!! $user_info->rate_1d !!}" ></p> 
													</div>
													<div class="report-submit manage_model">
														{!! Form::button(trans('Save'), array('class' => 'btn save_btn', 'onclick' => 'changePrice();')) !!}
													</div>
														
														<button class="btn save_btn1" id="dateStatus" onclick='chnageBookingStatus("Block");' type="button">Block</button>
													
												</div>
											{!! Form::close() !!}
										</div>
									</div>
								</div>
							</div><!-- /container -->
							{!! HTML::script('calender/js/jquery.calendario.only.js') !!}
							{!! HTML::script('calender/js/data.js') !!}
							<script type="text/javascript">
								function changePrice(text) {
									var m15 = $('#15m').val();
									var m30 = $('#30m').val();
									var hr1 = $('#1hr').val();
									var d1 = $('#1d').val();
									var date = $('#date').val();
									$.ajax({
										type: "get",
										url : "{{ url('user/changePrice')}}",
										data : {m15:m15,m30:m30,hr1:hr1,d1:d1,date:date},
										success : function(response) {
											//alert('Successfully Change Status.')
											swal({
												title: "Successfully Change Status.",
												//text: "Please click on ok button!",
												type: "success",
											});
										}
									});
								}
								function chnageBookingStatus(status) {
									var date = $('#date').val();
									var id = "<?php echo Auth::User()->id;?>";
									$.ajax({
										type: "get",
										url : "{{ url('chnageBookingStatus')}}",
										data : {id:id,date:date,status:status},
										success : function(response) {
											var a = response['date_arr']+',';
											date_arr1 = [];
											date_arr1 = a.split(',');
											$.each(date_arr1, function( index, value ) {
												
												if(response['status'] == 'Block'){
													$('#dateStatus').html('UnBlock');
													$('#dateStatus').attr('onclick','chnageBookingStatus("UnBlock")');
													$('div span[data-id="'+value+'"]').parent('div').css('background-color', '#C0C0C0');
												}
												else
												{
													$('#dateStatus').html('Block');
													$('#dateStatus').attr('onclick','chnageBookingStatus("Block")');
													$('div span[data-id="'+value+'"]').parent('div').removeAttr('style');
												}
											});
											//alert('Successfully Change Status.')
											swal({
												title: "Successfully Change Status.",
												//text: "Please click on ok button!",
												type: "success",
											});
										}
									});
								}
							</script>
							<script type="text/javascript">
								$(function() {
									var transEndEventNames = {
										'WebkitTransition' : 'webkitTransitionEnd',
										'MozTransition' : 'transitionend',
										'OTransition' : 'oTransitionEnd',
										'msTransition' : 'MSTransitionEnd',
										'transition' : 'transitionend'
									},
									transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
									$wrapper = $( '#custom-inner' ),
									$calendar = $( '#calendar' ),
									cal = $calendar.calendario( {
										onDayClick : function( $el, $contentEl, dateProperties ) {
											if( $contentEl.length > 0 ) {
												showEvents( $contentEl, dateProperties );
											}
										},
										caldata : codropsEvents,
										displayWeekAbbr : true
									} ),
									$month = $( '#custom-month' ).html( cal.getMonthName() ),
									$year = $( '#custom-year' ).html( cal.getYear() );
									$( '#custom-next' ).on( 'click', function() {
										cal.gotoNextMonth( updateMonthYear );
									} );
									$( '#custom-prev' ).on( 'click', function() {
										cal.gotoPreviousMonth( updateMonthYear );
									} );
									function updateMonthYear() {
										$month.html( cal.getMonthName() );
										$year.html( cal.getYear() );
										date_arr = [];
										date_arr = $('#CalselectDate').text().split(',');
										$.each(date_arr, function( index, value ) {
											if(value) {
												$('span[data-id="'+value+'"]').parent('div').css('background-color', '#C0C0C0');
											}
										});
										var Cmonth = $('.custom-month').text();
										var month = "<?php echo date('F');?>";
										if(Cmonth == month) {
											$('.custom-prev').css({"pointer-events": "none"});
										} else {
											$('.custom-prev').css({"pointer-events": "auto"});
										}
										var sel_date = "<?php echo $sel_date; ?>";
										date_arr = [];
										date_arr = sel_date.split('-');
										for (var i = 1; i < date_arr[1]; i++) {
											var Cal_Date = date_arr[0]+'-'+i+'-'+date_arr[2];
											if(i<10) {
												var Cal_Date = date_arr[0]+'-0'+i+'-'+date_arr[2];
											}
											$('div span[data-id="'+Cal_Date+'"]').parent('div').css({
												"background-color" : "#fff",
												"pointer-events": "none"
											});
											$('span[data-id="'+Cal_Date+'"]').css('color', '#ccc');
										}
									}
									function showEvents( $contentEl, dateProperties ) {
										hideEvents();
										var $events = $( '<div id="custom-content-reveal" class="custom-content-reveal"><h4>Events for ' + dateProperties.monthname + ' ' + dateProperties.day + ', ' + dateProperties.year + '</h4></div>' ),
										$close = $( '<span class="custom-content-close"></span>' ).on( 'click', hideEvents );
										$events.append( $contentEl.html() , $close ).insertAfter( $wrapper );
										setTimeout( function() {
											$events.css( 'top', '0%' );
										}, 25 );
									}
									function hideEvents() {
										var $events = $( '#custom-content-reveal' );
										if( $events.length > 0 ) {
											$events.css( 'top', '100%' );
											Modernizr.csstransitions ? $events.on( transEndEventName, function() { $( this ).remove(); } ) : $events.remove();
										}
									}
									$(".fc-date").click(function(event){
										var booking_date=$(this).attr('data-id');
										if (event.ctrlKey) 
										{
											var ctrl = "ctrl_true";
										} 
										else 
										{
											var ctrl = "ctrl_false";
											$('div span').parent('div').removeClass('fc-today');
										}
										//$('div').removeClass("fc-today");
										//$(this).parent('div').addClass("fc-today");
										$.ajax({
											url: "{!! URL::to('showescortprice') !!}",
											type: 'get',
											data: {booking_date:booking_date, ctrl:ctrl},
											success: function(data){
												if(data['result'] == 'true')
												{
													//$(this).parent('div').addClass("fc-today");
													$('div span[data-id="'+booking_date+'"]').parent('div').addClass('fc-today');
												}
												else
												{
													$('div span[data-id="'+booking_date+'"]').parent('div').removeClass('fc-today');
												}
												document.getElementById("date").value =data['select_date'];
												$('#changeescortprice').html('');
												$('#changeescortprice').html(data['html']);
											}
										})
										console.log($(this).attr('data-id'));
									})
									$(".custom-next, .custom-prev").click(function(){
										$('div').removeClass("fc-today");
										$(".fc-date").click(function(event){
											$('.custom-wrap').hide(500);
											$('.custom-wrap').show(1000);
											var booking_date=$(this).attr('data-id');
											if (event.ctrlKey) 
											{
												var ctrl = "ctrl_true";
											} 
											else 
											{
												var ctrl = "ctrl_false";
												$('div span').parent('div').removeClass('fc-today');
											}
											//$('div').removeClass("fc-today");
											//$(this).parent('div').addClass("fc-today");
											$.ajax({
												url: "{!! URL::to('showescortprice') !!}",
												type: 'get',
												data: {booking_date:booking_date, ctrl:ctrl},
												success: function(data){
													if(data['result'] == 'true')
												{
													//$(this).parent('div').addClass("fc-today");
													$('div span[data-id="'+booking_date+'"]').parent('div').addClass('fc-today');
												}
												else
												{
													$('div span[data-id="'+booking_date+'"]').parent('div').removeClass('fc-today');
												}
												document.getElementById("date").value =data['select_date'];
												$('#changeescortprice').html('');
												$('#changeescortprice').html(data['html']);
												}
											})
											console.log($(this).attr('data-id'));
										})
									})
								});
							</script>
							<?php foreach ($blockDate as $key => $value) { ?>
								<script>
									$(document).ready(function(){
										var Cal_Date = "<?php echo $value; ?>";
										if(Cal_Date){
											$('div span[data-id="'+Cal_Date+'"]').parent('div').css('background-color', '#C0C0C0');
										}
									});
								</script>
							<?php }  ?>
							<script>
								$(document).ready(function(){
									$("div").removeClass("fc-today");
									var sel_date ='<?php echo $sel_date;?>';
									date_arr = [];
									date_arr = sel_date.split('-');
									for (var i = 1; i < date_arr[1]; i++) {
										var Cal_Date = date_arr[0]+'-'+i+'-'+date_arr[2];
										if(i<10){
											var Cal_Date = date_arr[0]+'-0'+i+'-'+date_arr[2];
										}
										$('div span[data-id="'+Cal_Date+'"]').parent('div').css({
											"background-color" : "#fff",
											"pointer-events": "none"
										});
										$('span[data-id="'+Cal_Date+'"]').css('color', '#ccc');
									}
									$('.custom-prev').css({"pointer-events": "none"});
								})
							</script>
						</div>
					</div><!--tabpanel-->
				</div>
				<?php /*<div class="panel-body1">
					<div role="tabpanelfhfg">
						<div class="custom-box">
							@if(count($booked_data_arr)>0)
							<?php //echo "<pre>"; print_r($booked_data_arr); die;?>
								@foreach($booked_data_arr as $k=>$vals)
									<div class="box-upper right_cale_section">
										<div class="col-md-2 col-sm-2 user-round-image">
											<img src="{!! URL::to('img/users/'.$vals->photo) !!}">
										</div>
										<div class="col-md-4 col-sm-4 user-round-image">
											<ul>
												<li>{{$vals->name}}</li>
												<li> Date : {!! date('D jS M Y',strtotime($vals->book_date)) !!}</li>
											</ul>
										</div>
										<div class="col-md-3 col-sm-3 user-round-image">
											<ul>
												<li>{{$vals->time_start." To " .$vals->time_end}}</li>
												<li>${{$vals->rate}} CNF</li>
											</ul>
										</div>
										<div class="col-md-3 col-sm-3 user-info">
											<ul id="actionlinks{{$vals->id}}">
												@if($vals->invitation_accepted=="P")
													<li>
														<button class="custom-bn btn btn-primary btn-sx" onclick="chnagestatus({{$vals->id}},'Y');">Accept</button>
														<button class="custom-bn btn btn-primary btn-sx" onclick="chnagestatus({{$vals->id}},'R');">Decline</button>
													</li>
												@else
													@if($vals->invitation_accepted=='Y')
														<li class="approve_left">Accepted</li>
													@elseif($vals->invitation_accepted=='R')
														<li class="reject_right">Reject</li>
													@else
														<li class="reject_right">Cancel</li>
													@endif
												@endif
											</ul>
										</div>
									</div>
								@endforeach
							@else
								<p>Information not avaliable.</p>
							@endif
						</div>
					</div>
				</div>*/?>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function chnagestatus(bkid,status) {
			if(confirm("Are You Sure!")) {
				$.ajax({
					url: "{!! URL::to('changebookstatus') !!}",
					type: 'get',
					data: {bkid:bkid,bkstatus:status},
					success: function(data){
						$('#actionlinks'+bkid).html(data['action']);
					}
				})
			}
		}
	</script>
	<style type="text/css">
		.fc-calendar .fc-row > div > span.fc-date{
			top:68% !important;
		}	
		.custom-wrap{
			margin-top: 10px;
			height: 300px; 
		}
		.custom-box{
			display: block;
			box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
		}	
		.user-round-image img{
			border-radius: 50%;
			width: 80px;
			height: 80px;
		}
		ul{
			list-style: none
		}
		li:nth-child(2) {
			font-size: 10px;
		}
		ul li{
			padding: 5px;
		}
		tr td{
			padding: 5px;
		}
		li:nth-child(3) {
			font-size: 11px;
		}
		.td_time {
			font-size: 11px;
		}
		.box-upper {
			border-bottom: 1px dotted #ccc;
			margin-top: 10px;
			position: relative;
			display: inline-table;
		}
		.user-info {
			margin-top: 5px;
		}
		.custom-bn{
			margin: 2px;
			font-size: 10px;
		}
		.user-round-image{
			margin-top: 10px;
		}
		.custom-box > p {
			margin: 22px 9px 18px 22px;
			text-align: center;
			padding: 0px 5px 4px 6px;
		}
	</style>
@endsection