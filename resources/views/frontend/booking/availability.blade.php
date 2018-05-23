@extends('frontend.layouts.master')
@section('content')
	{!! Html::script('js/lightbox-plus-jquery.min.js') !!}
	{!! Html::script('js/1.11.1_jquery.min.js') !!}
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	{!! Html::style('css/jquery-ui.min.css') !!}
	<!--for lightbox -->
	{!! Html::style('css/lightbox.css')!!}
	{!! Html::script('js/jquery-ui.js') !!}
	{!! Html::script('js/jquery-ui.min.js') !!}
	<?php $sel_date = date('m-d-Y'); ?>
	<div class="">
		<div class="dashboard_block faq_block">
			<div class="panel panel-default">
				<div class="panel-heading">Booking</div>
				<div class="panel-body">
					<div role="tabpanel">
						<div class="tab-content">
							<h1>Manage your availability for booking</h1>
							<!-- start -->
							{!! HTML::style('calender/css/calendar.css') !!}
							{!! HTML::style('calender/css/custom_2.css') !!}
							{!! HTML::script('calender/js/modernizr.custom.63321.js') !!}
							<div class="container1">
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
							</div><!-- /container -->
							{!! HTML::script('calender/js/jquery.calendario.js') !!}
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
										var Cmonth = $('.custom-month').text();
										var Cyear = $('.custom-year').text();

										var month = "<?php echo date('F');?>";
										var year = "<?php echo date('Y');?>";
										
										if(Cmonth == month && Cyear == year ){
											$('.custom-prev').css({"pointer-events": "none"});
										}else{
											$('.custom-prev').css({"pointer-events": "auto"});
										}
										var sel_date = "<?php echo $sel_date; ?>";
										date_arr = [];
										date_arr = sel_date.split('-');
										for (var i = 1; i < date_arr[1]; i++) {
											var Cal_Date = date_arr[0]+'-'+i+'-'+date_arr[2];
											if(i<10){
												var Cal_Date = date_arr[0]+'-0'+i+'-'+date_arr[2];
											}
											$('div span[id="'+Cal_Date+'"]').parent('div').css({
												"background-color" : "#fff",
												"pointer-events": "none"
											});
											$('span[id="'+Cal_Date+'"]').css('color', '#ccc');
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
								});
							</script>
						</div>
					</div><!--tabpanel-->
				</div>
			</div>
		</div>
	</div>
	@include('frontend.booking.set_availity')	  
	<script>
		$(document).ready(function(){
			var sel_date ='<?php echo $sel_date;?>';
			date_arr = [];
			date_arr = sel_date.split('-');
			for (var i = 1; i < date_arr[1]; i++) {
				var Cal_Date = date_arr[0]+'-'+i+'-'+date_arr[2];
				if(i<10){
					var Cal_Date = date_arr[0]+'-0'+i+'-'+date_arr[2];
				}
				$('div span[id="'+Cal_Date+'"]').parent('div').css({
					"background-color" : "#fff",
					"pointer-events": "none"
				});
				$('span[id="'+Cal_Date+'"]').css('color', '#ccc');
			}
			$('.custom-prev').css({"pointer-events": "none"});
		})
	</script>
@endsection