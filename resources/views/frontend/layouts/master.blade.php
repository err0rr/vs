<!DOCTYPE html>
<html lang="en">
	<head>
		@include('frontend.includes.head')
	</head>
	<body>
		<script>var app_url = '{!! url('/') !!}';</script>
		<script>var siteurl = "{{URL::to('/')}}";</script>
		@include('frontend.includes.header')
		@if(Request::path() == 'myprofile')
			@if($user->user_type=="Escort")
			@else
				<?php $pageact = Route::currentRouteAction();
				if($pageact == 'App\Http\Controllers\Frontend\FrontendController@index'){ ?>
					@include('frontend.includes.slider') <?php
				} 
				else{ ?>
					<!-- @include('frontend.includes.inner_default_banner')  --><?php
				} ?>
			@endif
		@else
			<?php $pageact = Route::currentRouteAction();
			if($pageact == 'App\Http\Controllers\Frontend\FrontendController@index'){ ?>
				@include('frontend.includes.slider') <?php
			}
			else{ ?>
				@include('frontend.includes.inner_default_banner') <?php	
			} ?>
		@endif
		@if(Request::path() != 'cast/*')
			@include('includes.partials.messages')
		@endif
		@if(Request::path() == 'availability')
			<div class="contentbox1">
		@else
			<div class="contentbox">
		@endif
		<!-- @if(Request::path() != 'cast/*')
			@include('includes.partials.messages')
		@endif -->
			@yield('content')
		</div>
		@include('frontend.includes.footer')
		{!! Html::style('css/sweetalert.css') !!}
		{!! Html::script("js/sweetalert.js") !!}
 		{!! Html::script("js/sweetalert.min.js") !!}
		@include('includes.partials.ga')
	</body>
</html>