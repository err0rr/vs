<?php $flag = Request::path();
$slider = DB::table('sliders')->where('flag', $flag)->first(); ?>
<?php if(!empty($slider))
{
	$path = public_path().'\img\slider'."\'";
	if(!file_exists(rtrim($path,"'").$slider->image))
	{
		$slider ='';
	}
} ?>
@if(!empty($slider))
	<div class="slider login_slider" style="background: url(<?php echo URL::to('img/slider/'.$slider->image); ?>); height: 540px; background-size: cover; background-position: center center;">
@else
	<div class="slider login_slider" style="background: url(<?php echo URL::to('img/slider_inner.jpg')?>); height: 540px; background-size: cover; background-position: center center;">
@endif
		<div class="overlay_img"></div>
	</div>
<?php /*?>
	@if($flag == 'calendar' || $flag == 'password/change' || $flag == 'availability' || $flag == 'login' || $flag == 'myprofile' || $flag == 'profile/edit' || $flag == 'public/faq')
		<div class="overlay_img"></div>
	@elseif($flag == 'user/booking/checkout')
		<div class="overlay_img_checkout1"></div>
	@else
		<div class="overlay_img_checkout"></div>
	@endif
<!-- 	<div id="" class="carousel slide" data-ride="carousel">
		<div class="" role="listbox">
			<div class="item active">
				@if(!empty($slider))
					<img src="{!! URL::to('img/slider/'.$slider->image)!!}">
				@else
					<img src="{!! URL::to('img/slider_inner.jpg')!!}">
				@endif
			</div>
		</div>
	</div><?php */?>

<?php //echo $flag; die;?>