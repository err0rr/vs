<div class="imgcrousel">
	<div id="profile-slider">
		<div class="item"><img src="{!! URL::to('img/profile_slider_img-1.jpg')!!}" alt="Owl Image"></div>
		<div class="item"><img src="{!! URL::to('img/profile_slider_img-2.jpg')!!}" alt="Owl Image"></div>
		<div class="item"><img src="{!! URL::to('img/profile_slider_img-3.jpg')!!}" alt="Owl Image"></div>
		<div class="item"><img src="{!! URL::to('img/profile_slider_img-1.jpg')!!}" alt="Owl Image"></div>
		<div class="item"><img src="{!! URL::to('img/profile_slider_img-2.jpg')!!}" alt="Owl Image"></div>
		<div class="item"><img src="{!! URL::to('img/profile_slider_img-3.jpg')!!}" alt="Owl Image"></div>	
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