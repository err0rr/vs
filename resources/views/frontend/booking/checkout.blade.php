@extends('frontend.layouts.masterinner')
@section('content')
	<style>
		.item.active > img { height: 280px; }
	</style>
	<section id="cart_items">
		<div class="dashboard_block">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
					<li><a href="{!! URL::to('') !!}">{{ trans('Home') }}</a></li>
					<li class="active">{{ trans('Checkout') }}</li>
				</ol>
			</div>
			@if(count($all_data))
				{{ Form::open([ 'method'=>'POST','url'=>'checkout','id'=>'myform']) }}
					<div class="cart_info">
						<div class="col-lg-4 col-md-4 col-sm-4 pad_left0">
							<div class="cart_details" style="min-height:350px;">
								<h5>{{ trans('Escort payment info') }}</h5>
								<ul>
									<li>
										<span class="col-lg-4 col-md-4 col-sm-4 user-round-image">
											<a href="{!! URL::to('cast/'.$get_all_escort->user_id.'-'.$get_all_escort->name)!!}">
												<img src="{!! URL::to('img/users').'/'.$get_all_escort->photo !!}" >
											</a>
										</span>
										<span class="col-lg-8 col-md-8 col-sm-8">
											<a href="{!! URL::to('cast/'.$get_all_escort->user_id.'-'.$get_all_escort->name)!!}">{!! $get_all_escort->name !!}</a>
											<p>Time Sloat: <p>{!! $all_data['time_start'] !!} - {!! $all_data['time_end'] !!}</p></p>
											<p>Date : {!! $all_data['book_date'] !!}</p>
											<p>Rate : ${!! $all_data['rate'] !!} CHF</p>
										</span>
									</li>
								</ul>
								<div class="total_blk">
									<ul>
										<li></li>
										<li></li>
										<li>Total : ${!! $all_data['rate'] !!} CHF</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-lg-8 col-md-8 col-sm-8">
							<?php /*?><div class="payment_form">
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
							</div> <?php */?>
							<div class="payment_form">
								<h5>{{ trans('Payment Option') }}</h5>
								<div class="form-group">
									<label for="usr" style="width:100%;"></label>
									<input type="radio" class="validate[required]" id="" name="COD"> {{ trans('Cash on Delivery') }}
								</div>
								<?php /*?><div class="form-group">
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
								</div><?php */?>
							</div>
						</div>
					<div class="report-submit manage_model">
						<input name="sub" type="submit" class="btn save_btn margin"  value="{{ trans('Submit') }}">
					</div>
					</div>
					
				@endif
			{{ Form::close() }}
		</div>
		<style type="text/css">
			.margin{margin-top: 2%;}
		</style>
		<script type='text/javascript'>  
			$(document).ready(function(){
				$("#myform").validationEngine();
			});
		</script>
	</section> <!--/#cart_items-->
@endsection  