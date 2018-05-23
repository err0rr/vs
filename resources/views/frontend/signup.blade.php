@extends('frontend.layouts.master')
@section('content')
<div class="signup_block">
      <div class="panel-body">
		<div class="col-md-6">
		 <div class="signup_left">
			<a href="{!! URL::to('register')!!}" style="color:#333"><h1 style="text-align:center;width:100%">Member Sign up</h1></a>			
			<div class="text-center extra-margin-3">
				<a href="{!! URL::to('register')!!}" class="btn btn-transparent">Register</a>		
			</div>
		  <h3>What You Get</h3>
		  <ul>
		  <li><span>Access to private pictures</span></li>
		  <li><span>Instant booking of the escorts</span></li>
		  <li><span>Live chat with the escorts</span></li>
		  <li><span>Access to « member’s only » escorts </span></li>
		  <li><span>Having a good time  </span></li>		  
		  </ul>
		  <hr/>
		  <h3>What You Need</h3>
		  <ul>
		  <li><span>No more phone calls to busy numbers </span></li>
		  <li><span>Clear and easy booking</span></li>
		  <li><span>Simple instructions to find the place</span></li>
		  <li><span>Accurate info on the escort (pics, age, etc)</span></li>		 
		  </ul>
		   <h3>Price</h3>
		  <ul>
		  <li><span>It’s free and always will be (Highlight) </span></li>
		  </ul>
		 </div>
		</div>
		<div class="col-md-6">
		 <div class="signup_left">
			<a href="{!! URL::to('e-register')!!}" style="color:#333"><h1 style="text-align:center;width:100%">Escort Sign up</h1></a>			
			<div class="text-center extra-margin-3">
				<a href="{!! URL::to('e-register')!!}" class="btn btn-transparent">Register</a>			
			</div>
		  <h3>What You Get</h3>
		  <ul>
		  <li><span>Visibility of your add </span></li>
		  <li><span>Easy management of your work time</span></li>
		  <li><span>Live chat with your clients</span></li>
		  <li><span>At a glance daily calendar </span></li>
		  <li><span>Competitive ad prices </span></li>
		 
		  </ul>
		  <hr/>
		  <h3>What You Need</h3>
		  <ul>
		  <li><span>Registered safe clients</span></li>
		  <li><span>Reviews from other escorts on clients </span></li>
		  <li><span>Easy time management in calendar </span></li>
		   <li><span>Live chat with clients (saving you money on phone bills) </span></li>
		    <li><span>Easy and Intuitive price management to drum up business during low demand periods (Yield management) </span></li>
		     <li><span>Reasonable prices for your online advertising (not 800 chf per month like some of our competitiors)</span></li>
		  </ul>
		  <hr/>
		  <h3>Price</h3>
		  <ul>
		  <li><span>99 Chf per month</span></li>
		  </ul>
		 </div>
		</div>
     </div>
</div>

<style>
.extra-margin-3 {
    margin: 20px;
}
</style>

@endsection