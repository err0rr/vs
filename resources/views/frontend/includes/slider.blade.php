<?php $slider = DB::table('sliders')->where('flag', 'home')->first();?>

@if(!empty($slider))
	<div class="slider" style="background: url(<?php echo URL::to('img/slider/'.$slider->image); ?>); height: 540px; background-size: cover; background-position: center center;">
@else
	<div class="slider" style="background: url(<?php echo URL::to('img/slider_inner.jpg');?>)  height: 630px; background-size: cover; background-position: center center;">
@endif
	<div class="overlay_img"></div>
	<div id="" class="carousel slide" data-ride="carousel">		
		<div class="text">
			<p>TOO MUCH FUN <br> THIS NIGHT</p>
		</div>
	</div>
</div>