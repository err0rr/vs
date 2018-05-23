@extends('frontend.layouts.master')
@section('content')
	<?php /* ?>{!! Html::script('js/lightbox-plus-jquery.min.js') !!}
	{!! Html::script('js/1.11.1_jquery.min.js') !!} <?php */ ?>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	{!! Html::style('css/jquery-ui.min.css') !!}
	<?php /* ?>{!! Html::style('css/lightbox.css')!!}
	{!! Html::script('js/jquery-ui.js') !!}
	{!! Html::script('js/jquery-ui.min.js') !!} <?php */ ?>
	<?php $dates=''; foreach ($blockDate as $key => $value) {
		$dates.=trim($value).',';
	} ?>
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
								<div class="col-md-8">
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
								<div class="col-md-4">
									<div class="custom-wrap" >
										<div class="custom-box">
											<div class="booking-date" id="book">Booking Time</div>
											<p>
												<link rel='stylesheet prefetch' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>
												<div id="time-range">
													<p>Booking Date: <span class="" id="book_date1">{!! $sel_date !!}</span></p>
													<?php /*<p>Time <!-- Range -->: <span class="slider-time">9:00 AM</span> - <span class="slider-time2">5:00 PM</span></p>
													<div class="sliders_step1">
														<div id="slider-range"></div>
													</div>*/?>
													<p class="time-span"> Time :

<?php /*?>
<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen"
     href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">  
														<div id="datetimepicker" class="input-append date">
													      <input type="text" value="09:00 AM"></input>
													      <span class="add-on">
													        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
													      </span>
													    </div>
													    <div id="datetimepicker2" class="input-append date">
													      <input type="text" value="05:00 PM"></input>
													      <span class="add-on">
													        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
													      </span>
													    </div>
<script type="text/javascript"
     src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript">
      $('#datetimepicker').datetimepicker({
      	pickDate: false,
        format: 'HH:mm PP',
        pick12HourFormat: true,
        pickSeconds: false,
        language: 'en'
      });

      $('#datetimepicker2').datetimepicker({
      	pickDate: false,
        format: 'HH:mm PP',
        pick12HourFormat: true,
        pickSeconds: false,
        language: 'en'
      });
    </script>
<?php */ ?>
<base href="http://demos.telerik.com/kendo-ui/timepicker/rangeselection">
<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2017.2.621/styles/kendo.common-material.min.css" />
<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2017.2.621/styles/kendo.material.min.css" />
<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2017.2.621/styles/kendo.material.mobile.min.css" />


<script src="https://kendo.cdn.telerik.com/2017.2.621/js/kendo.all.min.js"></script>

<div id="example">
    <div class="demo-section k-content">

        <h4>Start time</h4>
        <input id="start" value="9:00 AM" style="width: 100%;" />

        <h4 style="margin-top: 2em;">End time</h4>
        <input id="end" value="5:00 PM" style="width: 100%;" />

    </div>
    <script>
        $(document).ready(function() {
            function startChange() {
                var startTime = start.value();
                
                if (startTime) {
                    startTime = new Date(startTime);

                    end.max(startTime);

                    startTime.setMinutes(startTime.getMinutes() + this.options.interval);

                    end.min(startTime);
                    end.value(startTime);
                    var time_start = $("#start").val();
				    var time_end = $("#end").val();
				    var book_date = $('#book_date').val();
					var id = "<?php echo $id; ?>";
					$.ajax({
						url: "{!! URL::to('priceCalculate') !!}",
						type: 'get',
						data: {id:id, time_start:time_start, time_end:time_end, book_date:book_date},
						success: function(data){
							$("#pricetolat").html('');
							$("#pricetolat").html(data);
							document.getElementById("time_start").value = time_start;
							document.getElementById("time_end").value = time_end;
							document.getElementById("rate").value = data;
							if(data==0)
							{
								$('.book-me').hide();
							}
							else
							{
								$('.book-me').show();	
							}
						}
					})
                }
            }

            function endChange() {
                var time_start = $("#start").val();
			    var time_end = $("#end").val();
			    //alert(time_start);
			    //alert(time_end);
			    var book_date = $('#book_date').val();
				var id = "<?php echo $id; ?>";
				$.ajax({
					url: "{!! URL::to('priceCalculate') !!}",
					type: 'get',
					data: {id:id, time_start:time_start, time_end:time_end, book_date:book_date},
					success: function(data){
						$("#pricetolat").html('');
						$("#pricetolat").html(data);
						document.getElementById("time_start").value = time_start;
						document.getElementById("time_end").value = time_end;
						document.getElementById("rate").value = data;
						if(data==0)
						{
							$('.book-me').hide();
						}
						else
						{
							$('.book-me').show();	
						}
					}
				})
            }

            //init start timepicker
            var start = $("#start").kendoTimePicker({
                change: startChange
            }).data("kendoTimePicker");

            //init end timepicker
            var end = $("#end").kendoTimePicker({
                change: endChange
            }).data("kendoTimePicker");

            //define min/max range
            start.min("00:00 AM");
            start.max("11:30 PM");

            //define min/max range
            end.min("00:00 AM");
            end.max("11:59 AM");
        });
    </script>

    <style>

    </style>
</div>




													<?php /*?><select id="from_time" name="from_time" onchange="getNewVal(this);" class="getNewVal">
														<option value="00:00 am">00:00 AM</option>
														<option value="00:30 am">00:30 AM</option>
														<option value="01:00 am">01:00 AM</option>
														<option value="01:30 am">01:30 AM</option>
														<option value="02:00 am">02:00 AM</option>
														<option value="02:30 am">02:30 AM</option>
														<option value="03:00 am">03:00 AM</option>
														<option value="03:30 am">03:30 AM</option>
														<option value="04:00 am">04:00 AM</option>
														<option value="04:30 am">04:30 AM</option>
														<option value="05:00 am">05:00 AM</option>
														<option value="05:30 am">05:30 AM</option>
														<option value="06:00 am">06:00 AM</option>
														<option value="06:30 am">06:30 AM</option>
														<option value="07:00 am">07:00 AM</option>
														<option value="07:30 am">07:30 AM</option>
														<option value="08:00 am">08:00 AM</option>
														<option value="08:30 am">08:30 AM</option>
														<option value="09:00 am" selected="selected">09:00 AM</option>
														<option value="09:30 am">09:30 AM</option>
														<option value="10:00 am">10:00 AM</option>
														<option value="10:30 am">10:30 AM</option>
														<option value="11:00 am">11:00 AM</option>
														<option value="11:30 am">11:30 AM</option>
														<option value="12:00 pm">12:00 PM</option>
														<option value="12:30 pm">12:30 PM</option>
														<option value="01:00 pm">01:00 PM</option>
														<option value="01:30 pm">01:30 PM</option>
														<option value="02:00 pm">02:00 PM</option>
														<option value="02:30 pm">02:30 PM</option>
														<option value="03:00 pm">03:00 PM</option>
														<option value="03:30 pm">03:30 PM</option>
														<option value="04:00 pm">04:00 PM</option>
														<option value="04:30 pm">04:30 PM</option>
														<option value="05:00 pm">05:00 PM</option>
														<option value="05:30 pm">05:30 PM</option>
														<option value="06:00 pm">06:00 PM</option>
														<option value="06:30 pm">06:30 PM</option>
														<option value="07:00 pm">07:00 PM</option>
														<option value="07:30 pm">07:30 PM</option>
														<option value="08:00 pm">08:00 PM</option>
														<option value="08:30 pm">08:30 PM</option>
														<option value="09:00 pm">09:00 PM</option>
														<option value="09:30 pm">09:30 PM</option>
														<option value="10:00 pm">10:00 PM</option>
														<option value="10:30 pm">10:30 PM</option>
														<option value="11:00 pm">11:00 PM</option>
														<option value="11:30 pm">11:30 PM</option>
													</select>
													<span> to </span> <select id="to_time" name="to_time" onchange="getNewVal(this);" class="getNewVal">
														<option value="00:00 am">00:00 AM</option>
														<option value="00:30 am">00:30 AM</option>
														<option value="01:00 am">01:00 AM</option>
														<option value="01:30 am">01:30 AM</option>
														<option value="02:00 am">02:00 AM</option>
														<option value="02:30 am">02:30 AM</option>
														<option value="03:00 am">03:00 AM</option>
														<option value="03:30 am">03:30 AM</option>
														<option value="04:00 am">04:00 AM</option>
														<option value="04:30 am">04:30 AM</option>
														<option value="05:00 am">05:00 AM</option>
														<option value="05:30 am">05:30 AM</option>
														<option value="06:00 am">06:00 AM</option>
														<option value="06:30 am">06:30 AM</option>
														<option value="07:00 am">07:00 AM</option>
														<option value="07:30 am">07:30 AM</option>
														<option value="08:00 am">08:00 AM</option>
														<option value="08:30 am">08:30 AM</option>
														<option value="09:00 am">09:00 AM</option>
														<option value="09:30 am">09:30 AM</option>
														<option value="10:00 am">10:00 AM</option>
														<option value="10:30 am">10:30 AM</option>
														<option value="11:00 am">11:00 AM</option>
														<option value="11:30 am">11:30 AM</option>
														<option value="12:00 pm">12:00 PM</option>
														<option value="12:30 pm">12:30 PM</option>
														<option value="01:00 pm">01:00 PM</option>
														<option value="01:30 pm">01:30 PM</option>
														<option value="02:00 pm">02:00 PM</option>
														<option value="02:30 pm">02:30 PM</option>
														<option value="03:00 pm">03:00 PM</option>
														<option value="03:30 pm">03:30 PM</option>
														<option value="04:00 pm">04:00 PM</option>
														<option value="04:30 pm">04:30 PM</option>
														<option value="05:00 pm" selected="selected">05:00 PM</option>
														<option value="05:30 pm">05:30 PM</option>
														<option value="06:00 pm">06:00 PM</option>
														<option value="06:30 pm">06:30 PM</option>
														<option value="07:00 pm">07:00 PM</option>
														<option value="07:30 pm">07:30 PM</option>
														<option value="08:00 pm">08:00 PM</option>
														<option value="08:30 pm">08:30 PM</option>
														<option value="09:00 pm">09:00 PM</option>
														<option value="09:30 pm">09:30 PM</option>
														<option value="10:00 pm">10:00 PM</option>
														<option value="10:30 pm">10:30 PM</option>
														<option value="11:00 pm">11:00 PM</option>
														<option value="11:30 pm">11:30 PM</option>
													</select> <?php */?>
													</p>
													<p class="rate-chf"><b> Rate : $ <span id="pricetolat">{!! number_format($pricetolat,2) !!}</span> CHF<b></p> 
												</div>
												{!! Form::open(array('url' => 'escortBooking', 'files'=> true, 'method'=>'POST', 'id'=> 'form_validation')) !!}
													<input type="hidden" name="user_id" value="{!! Auth::User()->id !!}" >
													<input type="hidden" name="profile_id" value="{!! $id !!}" >
													<input type="hidden" name="book_date" id="book_date" value="{!! $sel_date !!}" >
													<input type="hidden" name="time_start" id="time_start" value="9:00 AM" >
													<input type="hidden" name="time_end" id="time_end" value="5:00 PM" >
													<input type="hidden" name="rate" id="rate" value="{!! $pricetolat !!}" >
													<div class="report-submit manage_model book-me">
														{!! Form::submit(trans('Book Now'), array('class' => 'btn save_btn book-btn')) !!}
													</div>
												{!! Form::close() !!}
												
												<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
												<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
												 <script type="text/javascript">
												 /*$(document).ready(function(){
												 	$('.getNewVal').change(function(){
												 		var time_start = $('#from_time').val();
													    var time_end = $('#to_time').val();
													    //alert(time_start);
													    //alert(time_end);
													    var book_date = $('#book_date').val();
														var id = "<?php echo $id; ?>";
														var time_start = $('#from_time').val();
														var time_end = $('#to_time').val();
														alert(time_start+'-'+time_end)
														$.ajax({
															url: "{!! URL::to('priceCalculate') !!}",
															type: 'get',
															data: {id:id, time_start:time_start, time_end:time_end, book_date:book_date},
															success: function(data){
																$("#pricetolat").html('');
																$("#pricetolat").html(data);
																document.getElementById("time_start").value = time_start;
																document.getElementById("time_end").value = time_end;
																document.getElementById("rate").value = data;
																if(data==0)
																{
																	$('.book-me').hide();
																}
																else
																{
																	$('.book-me').show();	
																}
															}
														})

												 	})
												 });*/
													/*$("#slider-range").slider({
														range: true,
														min: 0,
														max: 1440,
														step: 15,
														values: [540, 1020],
														slide: function (e, ui) {
															var hours1 = Math.floor(ui.values[0] / 60);
															var minutes1 = ui.values[0] - (hours1 * 60);
															if (hours1.length == 1) hours1 = '0' + hours1;
															if (minutes1.length == 1) minutes1 = '0' + minutes1;
															if (minutes1 == 0) minutes1 = '00';
															if (hours1 >= 12) {
																if (hours1 == 12) {
																	hours1 = hours1;
																	minutes1 = minutes1 + " PM";
																} else {
																	hours1 = hours1 - 12;
																	minutes1 = minutes1 + " PM";
																}
															} else {
																hours1 = hours1;
																minutes1 = minutes1 + " AM";
															}
															if (hours1 == 0) {
																hours1 = 12;
																minutes1 = minutes1;
															}
															$('.slider-time').html(hours1 + ':' + minutes1);
															var hours2 = Math.floor(ui.values[1] / 60);
															var minutes2 = ui.values[1] - (hours2 * 60);
															if (hours2.length == 1) hours2 = '0' + hours2;
															if (minutes2.length == 1) minutes2 = '0' + minutes2;
															if (minutes2 == 0) minutes2 = '00';
															if (hours2 >= 12) {
																if (hours2 == 12) {
																	hours2 = hours2;
																	minutes2 = minutes2 + " PM";
																} else if (hours2 == 24) {
																	hours2 = 11;
																	minutes2 = "59 PM";
																} else {
																	hours2 = hours2 - 12;
																	minutes2 = minutes2 + " PM";
																}
															} else {
																hours2 = hours2;
																minutes2 = minutes2 + " AM";
															}
															$('.slider-time2').html(hours2 + ':' + minutes2);
														}
													});
													$(".ui-slider-handle").mouseleave(function(){
														var book_date = $('#book_date').val();
														var id = "<?php echo $id; ?>";
														var time_start = $('.slider-time').text();
														var time_end = $('.slider-time2').text();
														alert(time_start+'-'+time_end)
														$.ajax({
															url: "{!! URL::to('priceCalculate') !!}",
															type: 'get',
															data: {id:id, time_start:time_start, time_end:time_end, book_date:book_date},
															success: function(data){
																$("#pricetolat").html('');
																$("#pricetolat").html(data);
																document.getElementById("time_start").value = time_start;
																document.getElementById("time_end").value = time_end;
																document.getElementById("rate").value = data;
																if(data==0)
																{
																	$('.book-me').hide();
																}
																else
																{
																	$('.book-me').show();	
																}
															}
														})
													});*/
													
												</script>
											</p>
										</div>
									</div>
								</div
							</div><!-- /container -->
							{!! HTML::script('calender/js/jquery.calendario.only.js') !!}
							{!! HTML::script('calender/js/data.js') !!}
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
										var Cmonth = $('.custom-month').text();
										var month = "<?php echo date('F');?>";
										if(Cmonth == month) {
											$('.custom-prev').css({"pointer-events": "none"});
										}else{
											$('.custom-prev').css({"pointer-events": "auto"});
										}
										$.each(date_arr, function( index, value ) {
											if(value) {
												$('span[data-id="'+value+'"]').css('color', '#fffff');
												$('span[data-id="'+value+'"]').parent('div').css({
													"background-color" : "#C0C0C0",
													"pointer-events": "none"
												});
											}
										});
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
									$(".fc-date").click(function(){
										var booking_date=$(this).attr('data-id');
										$('div').removeClass("fc-today");
										$(this).parent('div').addClass("fc-today");
										$('#book_date1').html(booking_date);
										document.getElementById("book_date").value = booking_date;
										var book_date = $('#book_date').val();
										var id = "<?php echo $id; ?>";
										//var time_start = $('.slider-time').text();
										//var time_end = $('.slider-time2').text();
										var time_start = $("#start").val();
									    var time_end = $("#end").val();
										$.ajax({
											url: "{!! URL::to('priceCalculate') !!}",
											type: 'get',
											data: {id:id, time_start:time_start, time_end:time_end, book_date:book_date},
											success: function(data){
												$("#pricetolat").html('');
												$("#pricetolat").html(data);
												document.getElementById("time_start").value = time_start;
												document.getElementById("time_end").value = time_end;
												document.getElementById("rate").value = data;
											}
										})
										console.log($(this).attr('data-id'));
									})
									$(".custom-next, .custom-prev").click(function(){
										$(".fc-date").click(function(){
											$('.custom-wrap').hide(500);
											$('.custom-wrap').show(1000);
											document.getElementById("book_date").value = $(this).attr('data-id');
											$('div').removeClass("fc-today");
											$(this).parent('div').addClass("fc-today");
											var book_date = $('#book_date').val();
											var id = "<?php echo $id; ?>";
											//var time_start = $('.slider-time').text();
											//var time_end = $('.slider-time2').text();
											var time_start = $("#start").val();
											var time_end = $("#end").val();
											$.ajax({
												url: "{!! URL::to('priceCalculate') !!}",
												type: 'get',
												data: {id:id, time_start:time_start, time_end:time_end, book_date:book_date},
												success: function(data){
													$("#pricetolat").html('');
													$("#pricetolat").html(data);
													$('#book_date1').html(book_date);
													document.getElementById("time_start").value = time_start;
													document.getElementById("time_end").value = time_end;
													document.getElementById("rate").value = data;
												}
											})
											console.log($(this).attr('data-id'));
										})
									})
								});
							</script><!-- end -->
							<?php foreach ($blockDate as $key => $value) { ?>
								<script>
									$(document).ready(function(){
										var Cal_Date = "<?php echo $value; ?>";
										if(Cal_Date) {
											$('div span[data-id="'+Cal_Date+'"]').parent('div').css({
												"background-color" : "#C0C0C0",
												"pointer-events": "none"
											});
											$('span[data-id="'+Cal_Date+'"]').css('color', '#fffff');
										}
									});
								</script>
							<?php } ?>
							<script>
								$(document).ready(function(){
									$('.custom-prev').css({"pointer-events": "none"});
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
								})
							</script>
						</div>
					</div><!--tabpanel-->
				</div>
			</div>
		</div>
	</div><!-- panel -->
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
			position: absolute;
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
			/*font-size: 10px;*/
		}
		ul li{
			padding: 5px;
		}
		tr td{
			padding: 5px;
		}
		li:nth-child(3) {
			/*font-size: 11px;*/
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