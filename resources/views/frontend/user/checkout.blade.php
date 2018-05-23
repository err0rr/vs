@extends('frontend.layouts.masterinner')
@section('content')
<style>
	.item.active > img
	{
		height: 280px;
	}
</style>
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
					<li><a href="{!! URL::to('') !!}">{{ trans('Home') }}</a></li>
					<li class="active">{{ trans('Checkout') }}</li>
				</ol>
			</div>
			@if(count($cart))
				{{ Form::open([ 'method'=>'POST','url'=>'user/checkout/payment/process','id'=>'myform']) }}
					<div class="cart_info">
						@if(count($cart))
							<div class="col-lg-4 col-md-4 col-sm-4 pad_left0">
								<div class="cart_details" style="min-height:350px;">
									<h5>{{ trans('Escort payment info') }}</h5>
									<ul>
										<?php $grand_subtotal = 0;?>


			
											<li>
												<span class="col-lg-4 col-md-4 col-sm-4 user-round-image">
												<a href="{!! URL::to('cast/'.$get_all_escort->user_id.'-'.$get_all_escort->name)!!}">
												<img src="{!! URL::to('img/users').'/'.$get_all_escort->photo !!}" ></a></span>
												<span class="col-lg-8 col-md-8 col-sm-8">
													<a href="{!! URL::to('cast/'.$get_all_escort->user_id.'-'.$get_all_escort->name)!!}">{!! $get_all_escort->name !!}</a>
													<p>Time Sloat: <p>{!! substr($time_slot->start_time, 0,5).' - '.substr($time_slot->end_time, 0,5) !!}</p></p>
													<p>Date : {!! $cart['book_date'] !!}</p>
													<p>Rate : {!! $get_all_escort->minimum_rate !!}/Hr</p>
												</span>
											</li>


									</ul>
									<div class="total_blk">
										<ul>
<!-- 											<li>
												<span class="left_price">{{ trans('Subtotal') }}</span>
												<span class="right_price">${{$grand_subtotal}}</span>
											</li> -->
											<li>
												<!-- <span class="left_price">{{ trans('My Balance') }}</span> -->
												<!-- <span class="right_price">${{ Auth::User()->total_amount_balance }}</span> -->
											</li>
											<li>
												<span class="left_price">{{ trans('Total :') }}</span>
												<?php /*?><span class="right_price">${{$total}}</span><?php */?>
												<span class="right_price">
													<?php $start_time = strtotime($time_slot->start_time);
															$end_time = strtotime($time_slot->end_time);
														 $timediff = $end_time - $start_time;
														 $differTime = ($timediff/3600);
														 $hrtime = explode('.', $differTime);
														 $differs = 0;
														if($hrtime[0] >= 1){
															$differs = $hrtime[0];
														}
														if (strpos($differTime, '.') > 0) {
															$differs = $differs+1;
														}
													 ?>
													{!! $differs*$get_all_escort->minimum_rate !!}{{ trans('CHF') }}							
												</span>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8">
								<div class="payment_form">
									<h5>{{ trans('Billing Information') }}</h5>
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 pd0">
											<div class="col-lg-6 col-md-6 col-sm-6">
												<div class="form-group">
													<label for="usr">{{ trans('First Name') }}:</label>
													<input type="text" name="fname" class="form-control validate[required]" id="usr1" value="{{ Auth::user()->fname }}">
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6">
												<div class="form-group">
													<label for="usr">{{ trans('Last Name') }}:</label>
													<input type="text" class="form-control validate[required]" id="usr2" name="lname" value="{{ Auth::user()->lname }}">
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6">
												<div class="form-group">
													<label for="usr">{{ trans('Address Details') }}:</label>
													<input type="text" class="form-control validate[required]" id="usr3" name="address">
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6">
												<div class="form-group">
													<label for="usr">{{ trans('City Name') }}:</label>
													<input type="text" class="form-control validate[required]" id="usr4" name="city">
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6">
												<div class="form-group">
													<label for="usr">{{ trans('State') }}:</label>
													<input type="text" class="form-control validate[required]" id="usr5" name="state">
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6">
												<div class="form-group">
													<label for="usr">{{ trans('Zip Code') }}:</label>
													<input type="text" class="form-control validate[required]" id="usr6" name="zip">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="payment_detail">
									<h5>{{ trans('Payment Information') }}</h5>
									<div class="form-group">
										<label for="usr">{{ trans('Account Number') }}:</label>
										<input type="text" class="form-control account_no_inp validate[required]" id="usr7" placeholder="{{ trans('Accont Number') }}." name="account_number">
									</div>
									<div class="form-group">
										<label for="usr" style="width:100%;">{{ trans('Card Expiry Date') }}:</label>
										<select name="ex_date" class="form-control date_inp_box1 validate[required]">
											<option value="">{{ trans('Expiry Month') }}</option>
											<?php $month=range(01,12);
											foreach($month as $v) {
												$montval=$v;
												if($v<10) {
													$montval="0".$v;
												} ?>
												<option value="{{$montval}}">{{$montval}}</option>
											<?php }?>
										</select>
										<select name="ex_year" class="form-control date_inp_box1 validate[required]">
											<option value="">{{ trans('Expiry Year') }}</option>
											<?php $year=range(2016,2050);
											foreach($year as $v) { ?>
												<option value="{{$v}}">{{$v}}</option>
											<?php }?>
										</select>
									</div>
									<div class="form-group">
										<label for="usr" style="width:100%;">{{ trans('CVV') }}:</label>
										<input type="text" class="form-control cvv_inpt_box validate[required]" id="usr8" name="cvv">
									</div>
								</div>
							</div>
						@else
							<p align="center">{{ trans('You have no Article in the shopping cart') }}</p>
						@endif
					</div>
					<div class="report-submit manage_model">
						<input name="sub" type="submit" class="btn save_btn" value="{{ trans('Submit') }}">
					</div>
				@endif
			{{ Form::close() }}
		</div>
            <script type='text/javascript'>  
	$(document).ready(function(){
                
		$("#myform").validationEngine();
	});
    </script>
	</section> <!--/#cart_items-->
      
        
@endsection
  