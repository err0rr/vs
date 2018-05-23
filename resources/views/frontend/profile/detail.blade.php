<link rel="stylesheet" href="../css/lightbox.min.css">
<script src="../js/lightbox-plus-jquery.min.js"></script>
@extends('frontend.layouts.master')
@section('content')
	<?php /*?>@if(!empty($user_images_arr))
		<!--@if(!empty($user_images_arr_yes))
			<div class="item slide_img"><img src="{!! URL::to('timthumb.php')!!}?src={!! URL::to('img/users').'/'.$user_images_arr_yes->filename !!}&q=450&w=450" alt="Owl Image"></div>
		@else
			<div class="item slide_img"><img src="{!! URL::to('timthumb.php')!!}?src={!! URL::to('img/users').'/'.$user_images_arr_no->filename !!}&q=450&w=450" alt="Owl Image"></div>
		@endif -->
		<div class="imgcrousel" style="padding-top: 96px;">
			<div id="profile-slider">
				@foreach($user_images_arr as $value)
					<div class="item slide_img"><img src="{!! URL::to('timthumb.php')!!}?src={!! URL::to('img/users').'/'.$value->filename !!}&q=450&w=450" alt="Owl Image"></div>
					
				@endforeach
			</div>
		</div>
		<script>
			$(document).ready(function() {
				$("#profile-slider").owlCarousel({
					autoPlay: 3000, //Set AutoPlay to 3 seconds
					items : 3,
					itemsDesktop : [1199,3],
					itemsDesktopSmall : [979,3],
					navigation : true,
					pagination : false,
					navigationText : ["",""],
					autoPlay : true,
				});
			});
		</script>
	@else
		@include('frontend.includes.profile_slider')
	@endif <?php */?>
	@include('includes.partials.messages')
	@if(!empty($get_all_escort->coverphoto))
	<div class="imgcrousel" style="background: url(../img/users/<?php echo $get_all_escort->coverphoto; ?>); height: 540px; background-size: cover; background-position: center center;">
	@else
	<div class="imgcrousel" style="background: url(img/slider_inner.jpg); height: 540px; background-size: cover; background-position: center center;">
	@endif
		<div class="overlay_img"></div>
	</div>


	<?php /*?><div class="imgcrousel" style="padding-top: 96px;">
		<div class="mob-height overlay_img_details"></div>
			<div id="" class="carousel slide" data-ride="carousel">
			<div class="" role="listbox">
				<div class="item active1">
					@if(!empty($get_all_escort->coverphoto))
						<img src="{!! URL::to('timthumb.php')!!}?src={!! URL::to('img/users').'/'.$get_all_escort->coverphoto !!}&q=530&w=1349" alt="Owl Image">
					@else
						<img src="{!! URL::to('timthumb.php')!!}?src={!! URL::to('img/slider_inner.jpg') !!}&q=530&w=1349" alt="Owl Image">
					@endif
				@if(!empty($user_images_arr_yes) && !empty($user_images_arr_no))
					@if(!empty($user_images_arr_yes))
						<img src="{!! URL::to('timthumb.php')!!}?src={!! URL::to('img/users').'/'.$user_images_arr_yes->filename !!}&q=530&w=1349" alt="Owl Image">
					@else
						<img src="{!! URL::to('timthumb.php')!!}?src={!! URL::to('img/users').'/'.$user_images_arr_no->filename !!}&q=530&w=1349" alt="Owl Image">
					@endif 
				@else
					<img src="{!! URL::to('timthumb.php')!!}?src={!! URL::to('img/slider_inner.jpg') !!}&q=530&w=1349" alt="Owl Image">
				@endif
				</div>
			</div>		
		</div>
	</div><?php */?> 
	<!-- @include('includes.partials.messages') -->
	<!--<div class="slider login_slider">
		<div id="" class="carousel slide" data-ride="carousel">
			<div class="" role="listbox">
				<div class="item active">
					<img src="{!! URL::to('img/slider_inner.jpg')!!}">
				</div>
			</div>		
		</div>
	</div>-->
	<div class="container profile_details_block">
		<div class="row profilerow">
			<div class="profile">
				<div class="col-md-4">
				
					<!-- <img src="{!!URL::to('timthumb.php')!!}?src={!! URL::to('img/users').'/'.$get_all_escort->photo !!}&q=370&w=358"> -->
					<img src="{!! URL::to('img/users').'/'.$get_all_escort->photo !!}">
					
					<!-- <p class="review_profile1">
						<i class="fa fa-heart-o" aria-hidden="true"></i>
						<i class="fa fa-phone" aria-hidden="true"></i>
						<i class="fa fa-comments-o" aria-hidden="true"></i>
					</p> -->
				</div>
				<div class="col-md-5 user_detail">
					<h1>{{$get_all_escort->name}} <img src="{!! URL::to('img/chat.svg') !!}" alt="" title="" style="height: 50px; width: 50px;"></h1>
					<!--<p>{{$get_all_escort->type}}</p>-->
					<p class="review_profile">
						@if($get_all_escort->user_type == 'Escort')
							<?php $counts = count($user_review_arr); ?>
							@if($counts>0)
								<?php $avg_rat =  $user_rating_sum->sum/$counts;
								$avg_rating =  number_format($avg_rat); ?>
								@for($i=1; $i<=$avg_rating; $i++)
									<i class="fa fa-star" aria-hidden="true"></i>
								@endfor
								@for($i=$avg_rating; $i<5; $i++)
									<i class="fa fa-star-o" aria-hidden="true"></i>
								@endfor
								({!! number_format($avg_rat,'1') !!})
							@else
								<i class="fa fa-star-o" aria-hidden="true"></i> 
								<i class="fa fa-star-o" aria-hidden="true"></i> 
								<i class="fa fa-star-o" aria-hidden="true"></i> 
								<i class="fa fa-star-o" aria-hidden="true"></i> 
								<i class="fa fa-star-o" aria-hidden="true"></i>  (0)
							@endif
						@endif
						@if(!empty($get_all_escort->phone))
						<b><i class="fa fa-phone" aria-hidden="true"></i>
						<?php $data = $get_all_escort->phone ;
		 			        echo "+".substr($data, 0, 2)." (".substr($data, 2, 1).") ".substr($data, 3, 2)." ".substr($data, 5, 3)." ".substr($data,8,3); ?>						
						<!-- {{$get_all_escort->phone }} --></b>
						@endif
					</p>
					@if($get_all_escort->user_type == 'Escort')
						<h5>Rate :
	                     @if($get_all_escort->rate_1h>0)

								{{$get_all_escort->rate_1h}} {{ trans('CHF/Hr') }}
						@else		
						{{ trans('No Rate ') }}
						@endif
						</h5>
					@endif
				</div>

				
			@if($get_all_escort->user_type == 'Escort')
				<div class="col-md-3 calender_block">
					@if(!empty(Auth::User()->id))
						<a class="" href="{!! URL::to('booking-escort').'/'.$get_all_escort->user_id.'-'.$get_all_escort->name !!}">BOOK NOW</a>
					@else
						<a class="" href="{!! URL::to('login') !!}">BOOK NOW</a>
					@endif					
	
				</div>
			@endif

				


			</div>
		@if($get_all_escort->user_type == 'Escort')
			<div class="review">
			<div class="col-md-12">
					<!-- <h5>GALLERY</h5> -->
					<div class="gallery">
						<?php /*?><ul id="content-6">
							@if(!empty($user_images_arr))
								@foreach($user_images_arr as $value)
									<li>
										<div class="hovereffect">										
											<a class="example-image-link" href="{!!URL::to('timthumb.php')!!}?src={!! URL::to('img/users').'/'.$value->filename !!}&q=500&w=500"" data-lightbox="example-set"><img class="image_gallery example-image" src="{!!URL::to('timthumb.php')!!}?src={!! URL::to('img/users').'/'.$value->filename !!}&q=277&w=200"></a>
											
										</div>
									</li>
								@endforeach
							@endif
						</ul> <?php */?>
{!! Html::style('css/jquery.fancybox.css') !!}
{!! Html::script('js/jquery.fancybox.pack.js') !!}
<script type="text/javascript">	
					$(document).ready(function() {
						$.ajax({
							url: "{!! URL::to('setchatsession') !!}",
							type: 'get',							
							success: function(){
							$.getScript("{!! URL::to('cometchat/js.php?ext=js')!!}");
							setTimeout(function(){ 
								jqcc.cometchat.chatWith('{!! $get_all_escort->user_id!!}');	
								 }, 30000);
							
							}
						});
					});
				
	$(document).ready(function() {
		/*
		 *  Simple image gallery. Uses default settings
		*/
		$('.fancybox').fancybox();
				
	});
</script>
<ul class="hov-gal girllist_block">
	@if(!empty($user_images_arr))
		@foreach($user_images_arr as $value)
		@if(!empty($value->filename))
			<li>
			<div class="overeffect">
				<div class="hovereffect">
				
					<a class="fancybox" href="{!! URL::to('img/users').'/'.$value->filename !!}" data-fancybox-group="gallery">

<i class="fa fa-search" aria-hidden="true"></i>
					
					<!-- 	<img class="image_gallery" src="{!!URL::to('timthumb.php')!!}?src={!! URL::to('img/users').'/'.$value->filename !!}&q=277&w=260&h=260" alt="" /> -->
						<img class="image_gallery" src="{!! URL::to('img/users').'/'.$value->filename !!}" alt="" />

						<div class="overlay"></div>
					</a>

					
				</div>
				</div>


			</li>
			@endif
		@endforeach
	@endif
</ul>
					</div>
				</div>
				</div>
				@endif

			<div class="about">
				<div class="col-md-12">
					<h5>ABOUT ME</h5>
					@if(!empty($get_all_escort->message))
									<p class=""><span> <?php echo "<pre id='message1'>"; print_r($get_all_escort->message); echo "</pre>"; ?></span></p>
								@else
									<p class="" id="message1"><span>No About her Contect</span></p>
								@endif
					<?php /*<p>{{$get_all_escort->message}}</p> */?>
				</div>
			</div>
		@if($get_all_escort->user_type == 'Escort')
			<div class="services service_profile_list">
				<div class="col-md-12 list_view">
					 <h5>Services</h5> 
					<ul>
						@if(!empty($user_Service_arr))
							@foreach($user_Service_arr as $value)
								<li><span> <img style="width: 35%; " src="{!! URL::to('img/services').'/'.$value->image !!}"></span></li>
							@endforeach
						@endif
					</ul>
				</div>
				<style type="text/css">
					.list_view li::before {
						background-image: none !important;
					}
					.services .list_view ul li {
						height: 16% !important;
					}
				</style>
				<?php /*?><div class="col-md-4 calender_block">
					{!! Html::style('css/bootstrap-datetimepicker.min.css') !!}
					{!! Html::script("js/moment.js") !!}
					{!! Html::script("js/bootstrap-datetimepicker.min.js") !!}
					<h5>Make Booking</h5>
					<table id="calendar-demo" class="calendar"></table>
					<input type="hidden" name="calendar_date" id="dt_due" value="">
					<br>
					@if(!empty(Auth::User()->id))
						<a class="book_now" href="#">BOOK NOW</a>
					@else
						<a class="book_now" href="{!! URL::to('login') !!}">BOOK NOW</a>
					@endif
						
	
				</div><?php */?>
			</div>
		@endif
			<div class="modal timemodel" style="display:none" role='model'>
				<div id="etime_slot"></div>
			</div>
			<div class="personal_detail hide_border_box">
				<div class="col-md-8 col-sm-8 detail detail_list_view">
					<h5>Details</h5>
					@if(!empty($get_all_escort->canton))
						<p><b class="detail_text">Canton</b><b class="dot"> : </b><b class="per_det">{{ ucfirst($get_all_escort->canton) }}</b></p>
					@endif
					@if(!empty($get_all_escort->city))
						<p><b class="detail_text">City</b><b class="dot"> :  </b><b class="    per_det">{{ ucfirst($get_all_escort->city) }}</b></p>
					@endif
					@if(!empty($get_all_escort->nationality))
						<p><b class="detail_text">Nationality</b><b class="dot"> : </b><b class="per_det">{{ucfirst($get_all_escort->nationality)}}</b></p>
					@endif
					@if(!empty($get_all_escort->ethnicity))
						<p><b class="detail_text">Ethnicity</b><b class="dot"> : </b><b class="per_det">{{$get_all_escort->ethnicity}}</b></p>
					@endif
					@if(!empty($get_all_escort->age))
						<p><b class="detail_text">Age</b><b class="dot"> : </b><b class="per_det">{{$get_all_escort->age}}</b></p>
					@endif
					@if(!empty($get_all_escort->weight))
						<p><b class="detail_text">Weight</b><b class="dot"> : </b><b class="per_det">{{$get_all_escort->weight}}</b></p>
					@endif
					@if(!empty($get_all_escort->height))
						<p><b class="detail_text">Height</b><b class="dot"> : </b><b class="per_det">{{$get_all_escort->height}}</b></p>
					@endif
					@if(!empty($get_all_escort->eyes))
						<p><b class="detail_text">Eyes</b><b class="dot"> : </b><b class="per_det">{{$get_all_escort->eyes}}</b></p>
					@endif
					@if(!empty($get_all_escort->hair))
						<p><b class="detail_text">Hair</b><b class="dot"> : </b><b class="per_det">{{$get_all_escort->hair}}</b></p>
					@endif
					@if(!empty($get_all_escort->breast_size))
						<p><b class="detail_text">Breast size</b><b class="dot"> : </b><b class="per_det">{{$get_all_escort->breast_size}}</b></p>
					@endif
					@if(!empty($get_all_escort->pubic_hair))
						<p><b class="detail_text">Pubic hair</b><b class="dot"> : </b><b class="per_det">{{$get_all_escort->pubic_hair}}</b></p>
					@endif
					@if(!empty($get_all_escort->location))
						<p><b class="detail_text">Location</b><b class="dot"> : </b><b class="per_det">{{$get_all_escort->location}}</b></p>
					@endif
					@if(!empty($get_all_escort->orientation))
						<p><b class="detail_text">Orientation</b><b class="dot"> : </b><b class="per_det">{{$get_all_escort->orientation}}</b></p>
					@endif
					@if(!empty($get_all_escort->instruction))
						<p><b class="detail_text">Primary contact</b><b class="dot"> :  </b><b class="    per_det">{{$get_all_escort->instruction}}</b></p>
					@endif
				</div>
				<div class="col-md-4 col-sm-4 detail flag_detail_page">
					<h5>LANGUAGE(S)</h5>
					@if(!empty($user_Language_arr))
						@foreach($user_Language_arr as $key=>$value)
							<p><img src="{{ asset('img/lang_flag/'.$value->flag) }}" onerror="this.src='{{ asset('img/lang_flag/no-image.png') }}';" class="flag"> {!! $value->name !!}</p>
							<div class="ratebox" id="test1{!! $key+1 !!}" data-id="rating{!! $key+1 !!}" data-rating="{{ $value->rating }}"></div>
						@endforeach
					@endif
				</div>
			</div>
			<?php /*<div class="personal_detail hide_border_box">
				<div class="col-md-4 detail">
					<h5>Details</h5>
					<p><b class="detail_text">Phone</b><b class="dot"> : </b><b class="per_det"><?php $data = $get_all_escort->phone ;
		 			        echo "+".substr($data, 0, 2)." (".substr($data, 2, 1).") ".substr($data, 3, 2)." ".substr($data, 5, 3)." ".substr($data,8,3); ?>   
					</b></p>
					<p><b class="detail_text">Primary contact</b><b class="dot"> :  </b><b class="    per_det">{{$get_all_escort->instruction}}</b></p>
					<p><b class="detail_text">Min.</b><b class="dot"> : </b><b class="per_det">    {{$get_all_escort->minimum_rate}}
					    	@if($get_all_escort->minimum_rate)
							 {{ trans('CHF') }}
					        @else		
					         {{ trans('No Rate ') }}
					        @endif
					</b></p>
					<p><b class="detail_text">Region</b><b class="dot"> : </b><b class="per_det">{{$get_all_escort->region}}</b></p>
					<p><b class="detail_text">Age</b><b class="dot"> : </b><b class="per_det">{{$get_all_escort->age}}</b></p>
					<p><b class="detail_text">Nationality</b><b class="dot"> : </b><b class="per_det">{{$get_all_escort->nationality}}</b></p>
				</div><br><br><br>
				<div class="col-md-4 detail">
					<p><b class="detail_text">Phone</b><b class="dot"> : </b><b class="per_det"><?php $data = $get_all_escort->phone ;
		 			        echo "+".substr($data, 0, 2)." (".substr($data, 2, 1).") ".substr($data, 3, 2)." ".substr($data, 5, 3)." ".substr($data,8,3); ?>   
					</b></p>
					<p><b class="detail_text">Primary contact</b><b class="dot"> :  </b><b class="    per_det">{{$get_all_escort->instruction}}</b></p>
					<p><b class="detail_text">Min.</b><b class="dot"> : </b><b class="per_det">    {{$get_all_escort->minimum_rate}}
					    	@if($get_all_escort->minimum_rate)
							 {{ trans('CHF') }}
					        @else		
					         {{ trans('No Rate ') }}
					        @endif
					</b></p>
					<p><b class="detail_text">Region</b><b class="dot"> : </b><b class="per_det">{{$get_all_escort->region}}</b></p>
					<p><b class="detail_text">Age</b><b class="dot"> : </b><b class="per_det">{{$get_all_escort->age}}</b></p>
					<p><b class="detail_text">Nationality</b><b class="dot"> : </b><b class="per_det">{{$get_all_escort->nationality}}</b></p>
				</div>
				<div class="col-md-4 detail">
					<h5>LANGUAGE(S)</h5>
					@if(!empty($user_Language_arr))
						@foreach($user_Language_arr as $value)
							<p><img src="{{ asset('img/lang_flag/'.$value->flag) }}" onerror="this.src='{{ asset('img/lang_flag/no-image.png') }}';" class="flag"> {!! $value->name !!}</p>
						@endforeach
					@endif
				</div>
			</div> */?>
			@if($get_all_escort->user_type == 'Escort')
			<div class="review">
				<div class="col-md-12">
					<h5>REVIEW</h5>
					<div class="review_block_services review_profile_height" id="content-4">
						<?php $counts = count($user_review_arr); ?>
						@if($counts>0)
						
								<div class="reveiew_first user_summary_review" style="width: 100%;">
									<div class="col-md-12">
										<p class="review_profile">
											<span>Accuracy :</span>
											<?php $user_rating_accuract_sum =  $user_rating_accuract_sum->sum/$counts; ?>
											@if($user_rating_accuract_sum>0)
												<?php for($i=1; $i<=$user_rating_accuract_sum; $i++){ ?>
													<i class="fa fa-star" aria-hidden="true"></i>
												<?php } 
												if($i-1<$user_rating_accuract_sum){?>
													<i class="fa fa-star-half-o" aria-hidden="true"></i>
												<?php $i++; }
												for ($i; $i<=5 ; $i++) { ?> 
													<i class="fa fa-star-o" aria-hidden="true"></i>
												<?php }
												?>
											@else
												<i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i>
											@endif
										</p>

										 <p class="review_profile">
											<span>Communication :</span>
											<?php  $user_rating_communication_sum =  $user_rating_communication_sum->sum/$counts; ?>
											@if($user_rating_communication_sum>0)
												<?php for($i=1; $i<=$user_rating_communication_sum; $i++){ ?>
													<i class="fa fa-star" aria-hidden="true"></i>
												<?php } 
												if($i-1<$user_rating_communication_sum){?>
													<i class="fa fa-star-half-o" aria-hidden="true"></i>
												<?php $i++; }
												for ($i; $i<=5 ; $i++) { ?> 
													<i class="fa fa-star-o" aria-hidden="true"></i>
												<?php }
												?>
											@else
												<i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i>
											@endif
										</p>
										
										<p class="review_profile">
											<span>Hygiene :</span>
											<?php $user_rating_hygiene_sum =  $user_rating_hygiene_sum->sum/$counts; ?> 
											@if($user_rating_hygiene_sum>0)
												<?php for($i=1; $i<=$user_rating_hygiene_sum; $i++){ ?>
													<i class="fa fa-star" aria-hidden="true"></i>
												<?php } 
												if($i-1<$user_rating_hygiene_sum){?>
													<i class="fa fa-star-half-o" aria-hidden="true"></i>
												<?php $i++; }
												for ($i; $i<=5 ; $i++) { ?> 
													<i class="fa fa-star-o" aria-hidden="true"></i>
												<?php }
												?>
											@else
												<i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i>
											@endif
										</p>

										<p class="review_profile">
											<span>Friendliness :</span>
											<?php $user_rating_friendliness_sum =  $user_rating_friendliness_sum->sum/$counts; ?> 
											@if($user_rating_friendliness_sum>0)
												<?php for($i=1; $i<=$user_rating_friendliness_sum; $i++){ ?>
													<i class="fa fa-star" aria-hidden="true"></i>
												<?php } 
												if($i-1<$user_rating_friendliness_sum){?>
													<i class="fa fa-star-half-o" aria-hidden="true"></i>
												<?php $i++; }
												for ($i; $i<=5 ; $i++) { ?> 
													<i class="fa fa-star-o" aria-hidden="true"></i>
												<?php }
												?>
											@else
												<i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i>
											@endif
										</p>

										<p class="review_profile">
											<span>Cleanliness :</span>
											<?php $user_rating_cleanlines_sum =  $user_rating_cleanlines_sum->sum/$counts; ?> 
											@if($user_rating_cleanlines_sum>0)
												<?php for($i=1; $i<=$user_rating_cleanlines_sum; $i++){ ?>
													<i class="fa fa-star" aria-hidden="true"></i>
												<?php } 
												if($i-1<$user_rating_cleanlines_sum){?>
													<i class="fa fa-star-half-o" aria-hidden="true"></i>
												<?php $i++; }
												for ($i; $i<=5 ; $i++) { ?> 
													<i class="fa fa-star-o" aria-hidden="true"></i>
												<?php }
												?>
											@else
												<i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i>
											@endif
										</p>

										<p class="review_profile">
											<span>Talent :</span>
											<?php $user_rating_talent_sum =  $user_rating_talent_sum->sum/$counts; ?> 
											@if($user_rating_talent_sum>0)
												<?php for($i=1; $i<=$user_rating_talent_sum; $i++){ ?>
													<i class="fa fa-star" aria-hidden="true"></i>
												<?php } 
												if($i-1<$user_rating_talent_sum){?>
													<i class="fa fa-star-half-o" aria-hidden="true"></i>
												<?php $i++; }
												for ($i; $i<=5 ; $i++) { ?> 
													<i class="fa fa-star-o" aria-hidden="true"></i>
												<?php }
												?>
											@else
												<i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i>
											@endif
										</p> 
									</div>
								</div>
							@endif
							

						@if(!empty($user_review_arr))
							@foreach($user_review_arr as $key=>$value)
							<?php $avf_raring = ($value->accuract_rating+$value->communication_rating+$value->hygiene_rating+$value->friendliness_rating+$value->cleanlines_rating+$value->talent_rating)/6;
							?>

								<div class="reveiew_first user_summary_review" style="width: 100%;">
									

									<div class="col-md-12 pd0">
									  <div class="review_user_img">
										<img src="{{ asset('img/users/'.$value->photo) }}" onerror="this.src='{{ asset('img/users/noimage.jpg') }}';">
									 </div>
									 <div class="review_user_detail">
										
										<p class="user_name"> <a href="{!! URL::to('cast/'.$value->user_id.'-' .$value->name)!!}">{!! $value->name !!} </a><span class="label label-default ishwar">{!! number_format($avf_raring,1) !!}</span> 
											@if($avf_raring>0)
												<?php for($i=1; $i<=$avf_raring; $i++){ ?>
													<i class="fa fa-star" style="color:#ff4d58; " aria-hidden="true"></i>
												<?php } 
												if($i-1<$avf_raring){?>
													<i class="fa fa-star-half-o" style="color:#ff4d58; " style="color:#ff4d58; " aria-hidden="true"></i>
												<?php $i++; }
												for ($i; $i<=5 ; $i++) { ?> 
													<i class="fa fa-star-o" style="color:#ff4d58; " aria-hidden="true"></i>
												<?php }
												?>
											@else
												<i class="fa fa-star-o" style="color:#ff4d58; " aria-hidden="true"></i> <i class="fa fa-star-o" style="color:#ff4d58; " aria-hidden="true"></i> <i class="fa fa-star-o" style="color:#ff4d58; " aria-hidden="true"></i> <i class="fa fa-star-o" style="color:#ff4d58; " aria-hidden="true"></i> <i class="fa fa-star-o" style="color:#ff4d58; " aria-hidden="true"></i>
											@endif
										 </p>







										<p class="review_profile"><b> on {!! date('F d, Y', strtotime($value->created_at)) !!}</b></p>
									</div>
									</div>
										
										<div class="review_user_img"></div>
										 <div class="review_user_detail"><p class="short_dicrb">{!! $value->description !!}</p></div>
									
								</div>





							@endforeach
						@else <br>
							<div class="reveiew_first">
								<div class="col-md-12">
									<h4>"No Reviews"</h4>
								</div>
							</div>
						@endif
					</div>
				</div>
				<?php /*<div class="col-md-6">
					<h5>GALLERY</h5>
					<div class="gallery">
						<?php /*?><ul id="content-6">
							@if(!empty($user_images_arr))
								@foreach($user_images_arr as $value)
									<li>
										<div class="hovereffect">										
											<a class="example-image-link" href="{!!URL::to('timthumb.php')!!}?src={!! URL::to('img/users').'/'.$value->filename !!}&q=500&w=500"" data-lightbox="example-set"><img class="image_gallery example-image" src="{!!URL::to('timthumb.php')!!}?src={!! URL::to('img/users').'/'.$value->filename !!}&q=277&w=200"></a>
											
										</div>
									</li>
								@endforeach
							@endif
						</ul> 
{!! Html::style('css/jquery.fancybox.css') !!}
{!! Html::script('js/jquery.fancybox.pack.js') !!}
<script type="text/javascript">
	$(document).ready(function() { */?>
		<?php /*
		 *  Simple image gallery. Uses default settings
		*/ ?>
		<?php /*$('.fancybox').fancybox();
	});
</script>
<ul>
	@if(!empty($user_images_arr))
		@foreach($user_images_arr as $value)
			<li>
				<div class="hovereffect">
					<a class="fancybox" href="{!! URL::to('img/users').'/'.$value->filename !!}" data-fancybox-group="gallery">
						<img class="image_gallery" src="{!!URL::to('timthumb.php')!!}?src={!! URL::to('img/users').'/'.$value->filename !!}&q=277&w=200" alt="" />
					</a>
				</div>
			</li>
		@endforeach
	@endif
</ul>
					</div>
				</div>*/?>
			</div>
			@endif
		</div>
	</div>
<style>
	.slider{ display:none !important; }
</style>
			<link href="{{ URL::asset('css/raterater.css') }}" rel="stylesheet"/>

			<style>
			/* Override star colors */
			/*.raterater-bg-layer {
			    color: rgba( 0, 0, 0, 0.25 );
			}
			.raterater-hover-layer {
			    color: rgba( 255, 255, 0, 0.75 );
			}
			.raterater-hover-layer.rated {
			    color: rgba( 255, 255, 0, 1 );
			}
			.raterater-rating-layer {
			    color: rgba( 255, 155, 0, 0.75 );
			}
			.raterater-outline-layer {
			    color: rgba( 0, 0, 0, 0.25 );
			}*/	
			</style>
			<!---------------------------------->
<!-- We need jquery and raterater.jquery.js -->
<script src="{{ URL::asset('js/raterater1.jquery.js') }}"></script>

<script>

/* This is out callback function for when a rating is submitted
 */
function rateAlert(id, rating)
{
    //alert( 'Rating for '+id+' is '+rating+' stars!' );

    $('.ratebox').each(function(key, val){
    	if($(val).attr('data-id') == id){
    		$(val).attr('data-rating',rating);
    	}
    });
/*    if($('.ratebox').attr('data-id')==id){
    	alert($('.ratebox').attr('data-id'));
    	console.log($('.ratebox').attr('data-id'));
    }
*/}

/* Here we initialize raterater on our rating boxes
 */
$(function() {
    $( '.ratebox' ).raterater( { 
        submitFunction: 'rateAlert', 
        allowChange: false,
        starWidth: 20,
        spaceWidth: 5,
        numStars: 5
    } );
});

</script>
<script>		
$('#calendar-demo').datetimepicker({
	inline: true,
	minDate : moment(),
	format: 'YYYY-MM-DD'
}).on('dp.change', function(e){
  $('#dt_due').val(e.date.format('YYYY-MM-DD'));
});
var currentDate = moment().format('YYYY-MM-DD');
$('#dt_due').val(currentDate);

$('.book_now').click(function(){


	var datetime = $('#dt_due').val()
	var excort_name = window.location.href.split('/');
	var ex_n_length = excort_name.length;
	ex_n_length_new = ex_n_length - 1;
	var e_name = excort_name[ex_n_length_new];							
	$.ajax({
		type: "get",
		url: "{!!URL::to('user/booking')!!}",
		data: {datetime: datetime, e_name: e_name},
		success: function(result) {
			$(".timemodel").modal('show');
			$('#etime_slot').html(result);

		}
	});
});

$('.close_popup').click(function(){
	$('.timemodel').hide();
});

</script>
<script>
				(function($){
					$(window).load(function(){
							$("#content-1").mCustomScrollbar({
								scrollButtons:{enable:true},
								theme:"3d-thick"
							});
						$("#content-2").mCustomScrollbar({
							scrollButtons:{enable:true},
							theme:"3d-thick"
						});
						 $("#content-3").mCustomScrollbar({
							scrollButtons:{enable:true},
							theme:"3d-thick"
						});
					   $("#content-4").mCustomScrollbar({
							scrollButtons:{enable:true},
							theme:"3d-thick"
						});
						  $("#content-5").mCustomScrollbar({
							scrollButtons:{enable:true},
							theme:"3d-thick"
						});
					});
				})(jQuery);
			</script>
<style type="text/css">
.alert {
  border-radius: 0;
  left: 0;
  margin-bottom: 50px;
  position: absolute;
  text-align: center;
  top: 56px;
  width: 100%;
  z-index: 111;
}
.contentbox {
  position: relative;
}
</style>	


<!-- @include('frontend.user.time_slot_booking') -->
@endsection