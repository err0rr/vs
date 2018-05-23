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
	<div class="">
		<div class="dashboard_block faq_block">
			<div class="panel panel-default">
				<div class="panel-heading">Booking Details</div>
				<div class="ex-row">
				<div id="exTab1" class="">	
					<ul  class="nav nav-pills">
						<li class="active ">
			        		<a  href="{!! URL::to('booking')!!}"  class="" >
			        			@if(Auth::User()->user_type == 'Escort')
			        				Upcoming Booking
			        			@else
			        				Ongoing Booking
			        			@endif		        			 
			        		</a>
						</li>
						<li>
							<a href="{!! URL::to('bookingpast')!!}"  class="" >Past Booking </a>
						</li>
					</ul>
					<div class="tab-content clearfix">
					  	<div class="tab-pane active" id="1a">
							<div class="panel-body1">
								<div role="tabpanelfhfg">
									<div class="custom-box" id="getdatas">
									<h3></h3>
										<?php $sum= 0;?>
										@if(count($upcoming_booking_arr)>0)
											@foreach($upcoming_booking_arr as $k=>$vals)

											<?php 
											$rs = str_replace(',','', $vals->rate);
											$sum= $sum+$rs;?>
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
															<li>{{$vals->rate}} CHF</li>
														</ul>
													</div>
													<div class="col-md-3 col-sm-3 user-info">
														<ul id="actionlinks{{$vals->id}}">
															@if($vals->invitation_accepted=="P")
																@if($user_type == 'Escort')
																<li>
																	<button class="custom-bn btn btn-primary btn-sx" onclick="chnagestatus({{$vals->id}},'Y');">Accept</button>
																	<button class="custom-bn btn btn-primary btn-sx" onclick="chnagestatus({{$vals->id}},'R');">Decline</button>
																</li>
																@else
																	<li class="">Waiting  confirmation</li>
																@endif
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
							</div>
							<input type="hidden" name ="gropcount" id="gropcount" value="">
	 <div class="animation_image" style="display:none" align="center"><img src="{{ asset('img/ajax-loader.gif') }}"></div>
							@if(Auth::User()->user_type == 'Escort')
								<div style="display: block; font-weight: 600; text-align: center;margin-top: 19px;">
									<p>Upcoming Earning: <?php echo $sum;?> CHF</p>
								</div>
							@endif
						</div>
						<div class="tab-pane" id="2a" style="display: none;">
							<div class="panel-body1">
								<div role="tabpanelfhfg">
									<div class="custom-box">
									
									<?php //echo '<pre>'; print_r($booked_data_arr); die;?>
										<?php $total= 0;//echo "<pre>"; print_r($booked_data_arr); die;?>
										@if(count($booked_data_arr)>0)
											@foreach($booked_data_arr as $k=>$vals)
											<?php if($vals->invitation_accepted =='Y')
											{
												$rs = str_replace(',','', $vals->rate);
												$total=$total+$rs;
											} ?>
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
															<li>{{$vals->rate}} CHF</li>
														</ul>
													</div>
													<div class="col-md-3 col-sm-3 user-info">
														<ul id="actionlinks{{$vals->id}}">
															@if($vals->invitation_accepted=="P")
																@if($user_type == 'Escort')
																<li>
																	<button class="custom-bn btn btn-primary btn-sx" onclick="chnagestatus({{$vals->id}},'Y');">Accept</button>
																	<button class="custom-bn btn btn-primary btn-sx" onclick="chnagestatus({{$vals->id}},'R');">Decline</button>
																</li>
																@else
																	<li class="">Waiting  confirmation</li>
																@endif
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
							</div>
							@if(Auth::User()->user_type == 'Escort')
								<div style="display: block; font-weight: 600; text-align: center;margin-top: 19px;">
									<p>Total Earned: <?php echo $total;?> CHF</p>
								</div>
							@endif
						</div>
					</div>
		  		</div>
			

				</div>
			</div>
		</div>
	</div>
	
	<?php $total_groups= ceil($totals/10);?>
	<script type="text/javascript">
	var track_load = 1; //total loaded record group(s)
    var loading  = false; //to prevents multipal ajax loads
	var total_groups = <?php echo $total_groups;?>;
	$(document).ready(function() {
//total record group(s)
//$('#results').load("autoload_process.php", {'group_no':track_load}, function() {track_load++;}); //load first group


    if($(window).scrollTop() + $(window).height() == $(document).height())  //user scrolled to bottom of the page?
    {
    	var gropcount =$("#gropcount").val();
        if(gropcount)
            {
                total_groups= parseInt(gropcount);
            }
    console.log(total_groups);
        if(track_load <= total_groups && loading==false) //there's more data to load
        {       
            loading = true; //prevent further ajax loading
            $('.animation_image').show(); //show loading image
            //load data from the server using a HTTP POST request
            $.get("{!!URL::to('getfilterbooking')!!}",{'group_no': track_load}, function(data){
                $("#getdatas").append(data); //append received data into the element
                //hide loading image
                $('.animation_image').hide(); //hide loading image once data is received
                track_load++; //loaded group increment
                loading = false;
            }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
                alert(thrownError); //alert with HTTP error
                $('.animation_image').hide(); //hide loading image
                loading = false;
            });
        }
    }
});

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