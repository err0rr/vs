<!DOCTYPE html>
<html lang="en">
	<head>
		@include('frontend.includes.head')
	</head>
	<body>
		<script>var app_url = '{!! url('/') !!}';</script>
		<script>var siteurl = "{{URL::to('/')}}";</script>
		@include('frontend.includes.header')
		
			
		@include('frontend.includes.inner_default_banner') 	
			
		
		<div class="contentbox">
		@if(Request::path() != 'cast/*')
			@include('includes.partials.messages')
		@endif
			@yield('content')
		</div>
		@include('frontend.includes.footer')
		@include('includes.partials.ga')
	</body>
</html>