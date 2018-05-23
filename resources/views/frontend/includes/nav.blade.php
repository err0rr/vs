 <nav class="navbar navbar-default headernav">
  <div class="container">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#frontend-navbar-collapse">
			<span class="sr-only">{{ trans('labels.general.toggle_navigation') }}</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="{!! URL::to('/')!!}"><img src="{!! URL::to('img/myangels.ch light background.png')!!}" style="width: 200px;"></a>		
	</div><!--navbar-header-->
		
    <div class="collapse navbar-collapse" id="frontend-navbar-collapse">
		<ul class="nav navbar-nav navbar-right menu">               
			<li><!-- <img class="head_icon" src="{!! URL::to('img/header_icon.png')!!}"> --></li>
			
			@if (access()->guest())
				<li>{{ link_to('login', trans('navs.frontend.login')) }}</li>
				<li>{{ link_to('signup', trans('navs.frontend.register')) }}</li>
			@else
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						{{ strtoupper(access()->user()->name) }} <span class="caret"></span>
					</a>

					<ul class="dropdown-menu" role="menu">
						<li>{{ link_to_route('frontend.user.dashboard', trans('My Profile')) }}</li>
						<?php /*?><li><a href="{{ URL::to('addgallery')}}">{{trans('common.addgallery') }}</a></li><?php */?>

						@if (access()->user()->canChangePassword())
							<li>{{ link_to_route('auth.password.change', trans('navs.frontend.user.change_password')) }}</li>
						@endif

						@if(Auth::user()->user_type == 'Escort')
							<li>{{ link_to_route('frontend.user.myprofile.calendar', trans('calendar')) }}</li>
						@endif
						
						<li>{{ link_to_route('frontend.user.myprofile.booking', trans('Booking')) }}</li>
						

						@if(Auth::user()->user_type == 'Escort')
						<li>{{ link_to_route('frontend.user.dashboard.availability', trans('My Availability')) }}</li>
						@endif

						@permission('view-backend')
						<li>{{ link_to_route('admin.dashboard', trans('navs.frontend.user.administration')) }}</li>
						@endauth

						<li>{{ link_to_route('getFeedback', trans('Feedback')) }}</li>

						<li>{{ link_to_route('auth.logout', trans('navs.general.logout')) }}</li>
					</ul>
				</li>
				@if(Route::currentRouteAction()!= 'App\Http\Controllers\Frontend\ProfileController@getProfile')			
				<script>
					$(document).ready(function() {
						$.ajax({
							url: "{!! URL::to('setchatsession') !!}",
							type: 'get',							
							success: function(){
							$.getScript("{!! URL::to('cometchat/js.php?ext=js')!!}");	
							}
						});
					});
				</script>
				@endif				
				<link type="text/css" charset="utf-8" rel="stylesheet" media="all" href="{!! URL::to('cometchat/css.php?ext=css')!!}" />
				
			@endif
			<li><a href="{!! URL::to('faq')!!}">FAQ</a></li>
		</ul>
    </div>
  </div>
</nav>