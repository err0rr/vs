{!! Html::style('css/lightbox.min.css') !!}
{!! Html::script('js/lightbox-plus-jquery.min.js') !!}
@extends('frontend.layouts.master')
@section('content')
		{!! Html::style('upload_js_css/css/jquery.filer.css') !!}
 		{!! Html::style('upload_js_css/css/themes/jquery.filer-dragdropbox-theme.css') !!}
 		{!! Html::script("upload_js_css/js/jquery.filer.min.js") !!}
 		{!! Html::script("upload_js_css/js/custom.js") !!}
		
 		
 	@if($user->user_type=="Escort")
 	<!-- 	{!! Html::style('upload_js_css/css/jquery.filer.css') !!}
 		{!! Html::style('upload_js_css/css/themes/jquery.filer-dragdropbox-theme.css') !!}
 		{!! Html::script("upload_js_css/js/jquery.filer.min.js") !!}
 		{!! Html::script("upload_js_css/js/custom.js") !!} -->
 			<?php /*?><div id="owl-demo">
 				@if(!empty($user_images_arr))
 					@foreach($user_images_arr as $value)
							<div class="item slide_img"><img class="img-responsive" src="{!! URL::to('timthumb.php')!!}?src={!! URL::to('img/users').'/'.$value->filename !!}&q=444&w=450" alt="Owl Image"></div>							
						@endforeach
					@else
						<div class="item"><img class="img-responsive" src="{!! URL::to('img/profile_slider_img-1.jpg') !!}" alt="Owl Image"></div>
						<div class="item"><img class="img-responsive" src="{!! URL::to('img/profile_slider_img-2.jpg') !!}" alt="Owl Image"></div>
						<div class="item"><img class="img-responsive" src="{!! URL::to('img/profile_slider_img-3.jpg') !!}" alt="Owl Image"></div>
					@endif
				</div><?php */?>
	@if(!empty($user->coverphoto))
	<div class="imgcrousel" style="background: url(img/users/<?php echo $user->coverphoto; ?>); height: 540px; background-size: cover; background-position: center center;">
	@else
	<div class="imgcrousel" style="background: url(img/slider_inner.jpg); height: 540px; background-size: cover; background-position: center center;">
	@endif
		<div class="overlay_img"></div>
	</div>


	<?php /*?><div class="imgcrousel" style="padding-top: 96px;">
		<div id="" class="carousel slide" data-ride="carousel">
			<div class="" role="listbox">
				<div class="item active1" id="user_cover_image">
					@if(!empty($user->coverphoto))
						<img src="{!! URL::to('timthumb.php')!!}?src={!! URL::to('img/users').'/'.$user->coverphoto !!}&q=530&w=1349" alt="Owl Image">
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
		</div><?php */?>

        <div class="slider_edit_section">
			<span class="editImage edit_browse_file1"><img class="img-responsive" src="{!! URL::to('img/edit.png') !!}"><input type="file" name="files[]" class="filer_input23" multiple="multiple" accept="image/*"></span>
			<!-- <div class="" id="edit_image_cover" style="display:none;">
				<input type="file" name="files[]" class="filer_input23" multiple="multiple">
				<div class="gallery_submit">
					<button id="hit8" class="btn save_btn">Save</button>
					<button id="hit8-cancel" class="btn save_btn">Cancel</button>
				</div>
			</div> -->
		</div>
		<script>
			$( document ).ready(function() {
				$(".editImage").click(function(){
					$("#edit_image_cover").animate({
						height: 'toggle'
					});
				});
			});
		</script>
		<script>
				$(document).ready(function() {
					$('#hit8').click(function() {
						var user_id = "<?php echo Auth::User()->id?>";
						$.ajax({
							url: "{!! URL::to('user/profile/edit/coverimage') !!}",
							type: 'get',
							data: {user_id:user_id},
							success: function(data)
							{
								$('#user_cover_image').html('');
								$('#user_cover_image').html(data);
								$("#edit_image_cover").hide();
								//alert('Saved successfully');
								swal({
									title: "Saved successfully",
									//text: "Please click on ok button!",
									type: "success",
								});
								window.location.reload();
							}
						});
					});
				});
				$(document).ready(function() {
					$('#hit8-cancel').click(function() {
						swal({
					      title: "Are you sure?",
					      //text: "You will not be able to recover this imaginary file!",
					      type: "warning",
					      showCancelButton: true,
					      confirmButtonColor: '#DD6B55',
					      confirmButtonText: 'Yes',
					      closeOnConfirm: true
					    },
					    function(){
							$("#edit_image_cover").hide();
					    });
						/*if (confirm('Are you sure ?')) {
							$("#edit_image_cover").hide();
						}*/
					});
				});
			</script>
	</div>
			</div>
			<div class="container">
				<div class="row profilerow">
					<div class="profile">
						<div class="col-md-4">
							<div id="user_image"><img class="img-responsive" src="{!! URL::to('img/users').'/'.$user->photo !!}"></div>
							<span class="edit edit_browse_file"><img class="img-responsive" src="{!! URL::to('img/edit.png') !!}"><input type="file" name="files[]" class="filer_input22" multiple="multiple" accept="image/*"></span>
							<!-- <div class="" id="edit_image" style="display:none;">
								<div class="gallery_submit">
									<button id="hit7" class="btn save_btn">Save</button>
									<button id="hit7-cancel" class="btn save_btn">Cancel</button>
								</div>
							</div> -->
							<!-- <p class="review_profile1"><i class="fa fa-heart-o" aria-hidden="true"></i>  <i class="fa fa-phone" aria-hidden="true"></i>  <i class="fa fa-comments-o" aria-hidden="true"></i></p> -->
						</div>
						<div class="col-md-8 user_detail">
							<h1 class="name1" id="name1"><span>{{ ucfirst($user->name) }}</span></h1>
							<h1 id="name2" style="display:none;"><span><input id="term" type="text" name="name" value="{{ $user->name }}"></span></h1>
							<!-- <span class="barbiq_edit name1"><i class="fa fa-pencil" aria-hidden="true"></i></span> -->
							<!--<p class="test12"><span>{{ $user_info_arr->type }}</span></p>-->
							<p class="review_profile">
								<?php $counts = count($review_arr); ?>
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
									<i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i>  (0)
								@endif
								<b><i class="fa fa-phone" aria-hidden="true"></i><span id="new_number">
								<?php $data =  $user->phone;
		 			              echo "+".substr($data, 0, 2)." (".substr($data, 2, 1).") ".substr($data, 3, 2)." ".substr($data, 5, 3)." ".substr($data,8,3); ?>
								</span></b>
							</p>
							<h5>Rate &nbsp; &nbsp; &nbsp; : <span class="" id="new_price" style="width:20%;">
							@if( $user_info_arr->rate_1h>0)
{{ $user_info_arr->rate_1h }} {{ trans('CHF/Hr') }}
					        @else		
					        {{ trans('No result ') }}
					        @endif</span>
					        </h5>
							<div class="barbiq_save_btn">
								<button id="hit" class="btn save_btn" style="display: none;">Save</button>
								<button id="hit-cancel" class="btn save_btn" style="display: none;">Cancel</button>
								<button id="hit-edit" class="btn save_btn">Edit</button>
							</div>
						</div>
					</div><div class="about">
					<div class="col-md-12">
							<div class="review_bg_block">
								<h5 class="gallery_heading">GALLERY</h5>
								<span class="gallery_edit_ico"><img src="{!! URL::to('img/edit_gallery.png') !!}"></span>
								<div class="browse_gallery_btn" id="browse_gallery_btn">
									<input type="file" name="files[]" id="filer_input2" class="filer_input2" multiple="multiple" accept="image/*">
									<div class="gallery_submit">
										<button id="hit6" class="btn save_btn">Save</button>
										<button id="hit6-cancel" class="btn save_btn">Cancel</button>
									</div>
								</div>
								
								<div class="gallery" id="user_images">
									<ul id="content-3" class="hov-gal girllist_block">
										@if(!empty($user_images_arr))
											@foreach($user_images_arr as $value)
												<li>
													<span class="radio_slider_img close_image">
														<?php /* <input type="radio" name="image" onclick="sliderImg('{!! $value->id !!}')" <?php if($value->slider_image == 'Yes') { echo "checked=checked"; }?>>
														<label>Slider Image</label> */?>
														<label class="cross_slider" onclick="img_remove('{!! $value->id !!}')"><i class="fa fa-times" aria-hidden="true"></i></label>
													</span>
													
													<div class="hovereffect">
													
														<img src="{!! URL::to('img/users').'/'.$value->filename !!}">
														<div class="overlay">
															<!-- <a class="info" href="#"><i class="fa fa-search" aria-hidden="true"></i></a> -->
														</div>
													</div>
													
												</li>
											@endforeach
										@endif
									</ul>
								</div>
					
							</div>
						</div>
					</div>
					<div class="about">
						<div class="col-md-12">
							<h5>ABOUT ME</h5>
							@if(!empty($user_info_arr->message))
								<p class=""><span><?php echo "<pre id='message1'>"; print_r($user_info_arr->message); echo "</pre>"; ?></span></p>
							@else
								<p class="" id="message1"><span>No About her Contect</span></p>
							@endif
							<p class="" id="message2" style="display:none;">
								<span><textarea id="message" type="teat" id="message" name="message"  rows="3" cols="150">	{{ $user_info_arr->message }}</textarea> </span>
							</p>
							<div class="barbiq_save_btn">
								<button id="hit5" class="btn save_btn" style="display:none">Save</button>
								<button id="hit5-cancel" class="btn save_btn" style="display:none">Cancel</button>
								<button id="hit5-edit" class="btn save_btn">Edit</button>
							</div>
						</div>
					</div>
					<div class="services services_dashboard_list">
						<div class="col-md-12 list_view">
							<h5>Services</h5>
							<ul id="content-1" class="hit3-check">
								<?php $servide_id='';
								if(!empty($user_Service_id)){
									foreach($user_Service_id as $value){
										$servide_id[] = $value->service_id;
									}
								}?>

								@if(!empty($service_arr))
									@foreach($service_arr as $key=>$value)
										<li><label for="list{!! $key+1 !!}"><span> <img style="width: 35%; " src="{!! URL::to('img/services').'/'.$value->image !!}"></span></li>
									@endforeach
								@endif
							</ul>
							<ul id="content-1" class="hit3-check1" style="display: none;">
								<?php $servide_id='';
								if(!empty($user_Service_id)){
									foreach($user_Service_id as $value){
										$servide_id[] = $value->service_id;
									}
								}?>

								@if(!empty($service_arr))
									@foreach($service_arr as $key=>$value)
										<li><input type="checkbox" id="list{!! $key+1 !!}" name="services" value="{!! $value->id!!}" class="" <?php if(!empty($servide_id)) { if(in_array($value->id,$servide_id)) { echo "checked=checked"; } }?> /><label for="list{!! $key+1 !!}"><span> <img style="width: 35%; " src="{!! URL::to('img/services').'/'.$value->image !!}"></span></li>
									@endforeach
								@endif
							</ul>
							<div class="barbiq_save_btn">
								<button id="hit3" class="btn save_btn" style="display: none;">Save</button>
								<button id="hit3-cancel" class="btn save_btn" style="display: none;">Cancel</button>
								<button id="hit3-edit" class="btn save_btn">Edit</button>
							</div>
						</div>
						<?php /*?><div class="col-md-4 calender_block">
							{!! Html::style('css/dcalendar.picker.css') !!}
							{!! Html::script("js/dcalendar.picker.js") !!}
							<!--<h5>Make Booking</h5>
							<img src="{!! URL::to('img/calender.jpg') !!}">-->
							<h5>My Booking</h5>
							<table id="calendar-demo" class="calendar"></table>
							<br><a href="{!! URL::to('/calendar') !!}">My Booking</a>
							<script>
								$('#calendar-demo').dcalendar(); //creates the calendar
							</script>
						</div><?php */?>
					</div>
					<div class="col-md-12 personal_detail">
						<!-- <div class="col-md-8"> -->

							<div class="col-md-4 ">
								<h5>Details</h5>
								<p>
									<b class="detail_text">Canton</b><b class="dot"> :  </b>
									<b class="per_det" id="canton1"><span>{{ $user_info_arr->canton }}</span></b>
									<b class="per_det" id="canton2" style="display:none"><span>
										<select style="width:100%;" class="" name="canton" id="canton">
											<option value="">Canton</option>
											@foreach($cantons as $value)
												<option value="{{ $value->name }}" <?php if($user_info_arr->canton == $value->name) { echo "selected=selected"; } ?>>{{ $value->name }}</option>
											@endforeach
										</select>
									</span></b>
								</p>
								<p>
									<b class="detail_text">City</b><b class="dot"> :  </b>
									<b class="per_det" id="city1"><span>{{ $user_info_arr->city }}</span></b>
									<b class="per_det" id="city2" style="display:none"><span><input id="city" type="text" name="city" value="{{ $user_info_arr->city }}"></span></b>
								</p>
								<p>
									<b class="detail_text">Nationality</b><b class="dot"> :  </b>
									<b class="per_det" id="nationality1"><span>{{ $user_info_arr->nationality }}</span></b>
									<b class="per_det" id="nationality2" style="display:none"><span>
										<select style="width:100%;" class="" name="nationality" id="nationality">
											<option value="">Nationality</option>
											@foreach($country as $v)
												<option value="{{$v->countryName}}" <?php if($user_info_arr->nationality == $v->countryName) { echo "selected=selected"; } ?>>{{$v->countryName}}</option>
											@endforeach
										</select>
									</span></b>
								</p>
								<p>
									<b class="detail_text">Ethnicity</b><b class="dot"> :  </b>
									<b class="per_det" id="ethnicity1"><span>{{ $user_info_arr->ethnicity }}</span></b>
									<b class="per_det" id="ethnicity2" style="display:none"><span>
										<select style="width:100%;" class="" name="ethnicity" id="ethnicity">
<option value="Caucasian" <?php if($user_info_arr->ethnicity == 'Caucasian') { echo "selected='selected'"; }?> >Caucasian</option>
<option value="Arab" <?php if($user_info_arr->ethnicity == 'Arab') { echo "selected='selected'"; }?>>Arab</option>
<option value="Asian" <?php if($user_info_arr->ethnicity == 'Asian') { echo "selected='selected'"; }?>>Asian</option>
<option value="Black" <?php if($user_info_arr->ethnicity == 'Black') { echo "selected='selected'"; }?>>Black</option>
<option value="Hispanic" <?php if($user_info_arr->ethnicity == 'Hispanic') { echo "selected='selected'"; }?>>Hispanic</option>
<option value="Other" <?php if($user_info_arr->ethnicity == 'Other') { echo "selected='selected'"; }?>>Other</option>
										</select>
									</span></b>
								</p>
								<p>
									<b class="detail_text">Age</b><b class="dot"> :  </b>
									<b class="per_det" id="age1"><span>{{ $user_info_arr->age }}</span></b>
									<b class="per_det" id="age2" style="display:none"><span>
										<select style="width:100%;" class="" name="age" id="age">
											<option value="">Age</option>
											@foreach($age as $v)
												<option value="{{$v}}" <?php if($user_info_arr->age == $v) { echo "selected=selected"; } ?> >{{$v}}</option>
											@endforeach
										</select>
									</span></b>
								</p>
								<p>
									<b class="detail_text">Weight</b><b class="dot"> :  </b>
									<b class="per_det" id="weight1"><span>{{ $user_info_arr->weight }}</span></b>
									<b class="per_det" id="weight2" style="display:none"><span><input id="weight" type="text" name="weight" value="{{ $user_info_arr->weight }}"></span></b>
								</p>
								<p>
									<b class="detail_text">Height</b><b class="dot"> :  </b>
									<b class="per_det" id="height1"><span>{{ $user_info_arr->height }}</span></b>
									<b class="per_det" id="height2" style="display:none"><span><input id="height" type="text" name="height" value="{{ $user_info_arr->height }}"></span></b>
								</p>
							</div>
							<div class="col-md-4 ">
								<br><br><br>
								<p>
									<b class="detail_text">Eyes</b><b class="dot"> :  </b>
									<b class="per_det" id="eyes1"><span>{{ $user_info_arr->eyes }}</span></b>
									<b class="per_det" id="eyes2" style="display:none"><span><input id="eyes" type="text" name="eyes" value="{{ $user_info_arr->eyes }}"></span></b>
								</p>
								<p>
									<b class="detail_text">Hair</b><b class="dot"> :  </b>
									<b class="per_det" id="hair1"><span>{{ $user_info_arr->hair }}</span></b>
									<b class="per_det" id="hair2" style="display:none"><span><input id="hair" type="text" name="hair" value="{{ $user_info_arr->hair }}"></span></b>
								</p>
								<p>
									<b class="detail_text">Breast size</b><b class="dot"> :  </b>
									<b class="per_det" id="breast_size1"><span>{{ $user_info_arr->breast_size }}</span></b>
									<b class="per_det" id="breast_size2" style="display:none"><span><input id="breast_size" type="text" name="breast_size" value="{{ $user_info_arr->breast_size }}"></span></b>
								</p>
								<p>
									<b class="detail_text">Pubic hair</b><b class="dot"> :  </b>
									<b class="per_det" id="pubic_hair1"><span>{{ $user_info_arr->pubic_hair }}</span></b>
									<b class="per_det" id="pubic_hair2" style="display:none"><span><input id="pubic_hair" type="text" name="pubic_hair" value="{{ $user_info_arr->pubic_hair }}"></span></b>
								</p>
								<p>
									<b class="detail_text">Location</b><b class="dot"> :  </b>
									<b class="per_det" id="location1"><span>{{ $user_info_arr->location }}</span></b>
									<b class="per_det" id="location2" style="display:none">
										<span>
											<?php /*?><input id="location" type="text" name="location" value="{{ $user_info_arr->location }}"><?php */?>
											<select style="width:100%;" class="" name="location" id="location">
<option value="Outcall" <?php if($user_info_arr->location == 'Outcall') { echo "selected='selected'"; }?> >Outcall</option>
<option value="Incall" <?php if($user_info_arr->location == 'Incall') { echo "selected='selected'"; }?>>Incall</option>
										</select>
										</span>
									</b>
								</p>
								<p>
									<b class="detail_text">Orientation</b><b class="dot"> :  </b>
									<b class="per_det" id="orientation1"><span>{{ $user_info_arr->orientation }}</span></b>
									<b class="per_det" id="orientation2" style="display:none"><span><input id="orientation" type="text" name="orientation" value="{{ $user_info_arr->orientation }}"></span></b>
								</p>
								
								<p>
									<b class="detail_text">Primary contact</b><b class="dot"> :  </b>
									<b class="per_det" id="instruction1"><span>{{ $user_info_arr->instruction }}</span></b>
									<b class="per_det" id="instruction2" style="display:none"><span><input id="instruction" type="text" name="instruction" value="{{ $user_info_arr->instruction }}"></span></b>
								</p>
								<p>
									<b class="detail_text">Phone</b><b class="dot"> : </b>
									<b class="per_det" id="phone1"><span>
									<?php $data =  $user->phone;
		 			              echo "+".substr($data, 0, 2)." (".substr($data, 2, 1).") ".substr($data, 3, 2)." ".substr($data, 5, 3)." ".substr($data,8,3); ?></span></b>
									<b class="per_det" id="phone2" style="display:none"><span><input id="phone" type="text" name="phone" value="{{ $user->phone }}"></span></b>
								</p>	
								
								
							
								<?php /*?><div class="barbiq_save_btn">
									<button id="hit1" class="btn save_btn" style="display:none">Save</button>
									<button id="hit1-cancel" class="btn save_btn" style="display:none">Cancel</button>
									<button id="hit1-edit" class="btn save_btn">Edit</button>
								</div><?php */?>
							</div>
						<!-- </div>
						<div class="col-md-3"></div> -->
						<div class="col-md-4">
							<div class="language_box  detail flag_detail_page" id="content-2">
								<h5>LANGUAGE(S)</h5>
								<?php $lang_id='';
								if(!empty($user_language_id)){
									foreach($user_language_id as $value){
										$lang_id[] = $value->language_id;
									}
								}?>
								@if(!empty($language_arr))
								<?php //echo '<pre>'; print_r($lang_id);
								//echo '<pre>'; print_r($language_arr); 
								//echo '<pre>'; print_r($user_language_id); ?>
									<div id=lang>
										@foreach($language_arr as $key=>$value)
										<?php if(!empty($user_language_id)){
										foreach($user_language_id as $val){ ?>
											<?php if($val->language_id==$value->id){?>
										<p class="paragraph">
											<img src="{!! URL::to('img/lang_flag').'/'.$value->flag !!}" class="flag"> {!! $value->name !!}
										</p>
										<?php if($val->rating > 0){?>
										<div class="val val-tare abc">
											<div class="ratebox" id="test1{!! $key+1 !!}" data-id="rating{!! $key+1 !!}" data-rating="{{ $val->rating }}"></div>
										</div> <?php }?> <br>
											<?php } ?>
											<?php }}  ?>
										
									@endforeach
									</div>
<div id=lang1 style="display: none">
	@foreach($language_arr as $key=>$value)
		<p class="paragraph">
			<input type="checkbox" id="test{!! $key+1 !!}" class="attrbute_check1" name="language" value="{!! $value->id!!}" <?php if(!empty($lang_id)) { if(in_array($value->id,$lang_id)) { echo "checked=checked"; } }?> />
			<label for="test{!! $key+1 !!}"></label>
			<img src="{!! URL::to('img/lang_flag').'/'.$value->flag !!}" class="flag"> {!! $value->name !!}
		</p>
		<div <?php if(!empty($lang_id)) { if(in_Array($value->id,$lang_id)) { } else { echo "style='display: none;'"; } } else { echo "style='display: none;'"; } ?> id="catbox-{{ $value->id}}" class="val val-tare abc">
			<?php $r=0; foreach($user_language_id as $val)
			{ 
				if($val->language_id==$value->id)
				{ 
					$r++; ?>
					<div class="ratebox" id="test1{!! $key+1 !!}" data-id="rating{!! $key+1 !!}" data-rating="{{ $val->rating }}"></div>
				<?php }
			} 
			if($r==0)
				{ ?> 
					<div class="ratebox" id="test-{!! $value->id !!}" data-id="rating{!! $key+1 !!}" data-rating="" style="display: none;"></div>
				<?php }
			?>
		</div><br>
	@endforeach
</div>
								@endif
							
<script type="text/javascript">
    $(function () {
        $(".attrbute_check1").click(function () {
            if ($(this).is(":checked")) {
                var ids=$(this).val();
                //alert(ids);
                $('#catbox-'+ids).show();
                $('#test-'+ids).show();
            } else {
                var ids=$(this).val();
                $('#catbox-'+ids).hide();
                console.log($('#catbox-'+ids +' .ratebox'));
                //alert($('#catbox-'+ids +' .ratebox').attr('data-rating'));
                $('#catbox-'+ids +' .ratebox').attr('data-rating',' ');
    
            }
        });
    });
</script>

							<br><?php /*?><div class="barbiq_save_btn">
								<button id="hit4" class="btn save_btn">Save</button>
								<button class="btn save_btn">Cancel</button>
							</div><?php */?>
										
									
									
						</div>

<!-- ///////////////////////////////////////////////////////////// -->
<div class="detail_block">
								<h5>Booking RATES</h5>
<p>
	<b class="detail_text">15 Mins</b><b class="dot"> : </b>
	<b class="per_det" id="rate_15m1">
		<span>
			{{ $user_info_arr->rate_15m }}
			@if( $user_info_arr->rate_15m)
				{{ trans('CHF') }}
			@endif
		</span>
	</b>
	<b class="per_det" id="rate_15m2" style="display:none">
		<span><input id="rate_15m" type="text" name="rate_15m" value="{{ $user_info_arr->rate_15m }}"></span></b>
</p>


<p>
	<b class="detail_text">30 Mins</b><b class="dot"> : </b>
	<b class="per_det" id="rate_30m1">
		<span>
			{{ $user_info_arr->rate_30m }}
			@if( $user_info_arr->rate_30m)
				{{ trans('CHF') }}
			@endif
		</span>
	</b>
	<b class="per_det" id="rate_30m2" style="display:none">
		<span><input id="rate_30m" type="text" name="rate_30m" value="{{ $user_info_arr->rate_30m }}"></span></b>
</p>


<p>
	<b class="detail_text">1 HR</b><b class="dot"> : </b>
	<b class="per_det" id="rate_1h1">
		<span>
			{{ $user_info_arr->rate_1h }}
			@if( $user_info_arr->rate_1h)
				{{ trans('CHF') }}
			@endif
		</span>
	</b>
	<b class="per_det" id="rate_1h2" style="display:none">
		<span><input id="rate_1h" type="text" name="rate_1h" value="{{ $user_info_arr->rate_1h }}"></span></b>
</p>

<p>
	<b class="detail_text">24 HRS</b><b class="dot"> : </b>
	<b class="per_det" id="rate_1d1">
		<span>
			{{ $user_info_arr->rate_1d }}
			@if( $user_info_arr->rate_1d)
				{{ trans('CHF') }}
			@endif
		</span>
	</b>
	<b class="per_det" id="rate_1d2" style="display:none">
		<span><input id="rate_1d" type="text" name="rate_1d" value="{{ $user_info_arr->rate_1d }}"></span></b>
</p>	
								
								
							</div>
							<div class="barbiq_save_btn">
								<button id="hit1" class="btn save_btn" style="display:none">Save</button>
								<button id="hit1-cancel" class="btn save_btn" style="display:none">Cancel</button>
								<button id="hit1-edit" class="btn save_btn">Edit</button>
								<?php /*?><button id="hit9" class="btn save_btn">Save</button>
								<button id="hit9-cancel" class="btn save_btn">Cancel</button><?php */?>
							</div>
							
			<script type="text/javascript">
				/*$(document).ready(function() {
					$('#hit9').click(function() {
						$("#rate_15m2").hide(); $("#rate_15m1").show();
						var rate_15m =$('#rate_15m').val();
						$("#rate_15m1").html(''); $("#rate_15m1").html(rate_15m+' CHF');

						$("#rate_30m2").hide(); $("#rate_30m1").show();
						var rate_30m =$('#rate_30m').val();
						$("#rate_30m1").html(''); $("#rate_30m1").html(rate_30m+' CHF');

						$("#rate_1h2").hide(); $("#rate_1h1").show();
						var rate_1h =$('#rate_1h').val();
						$("#rate_1h1").html(''); $("#rate_1h1").html(rate_1h+' CHF');

						$("#rate_1d2").hide(); $("#rate_1d1").show();
						var rate_1d =$('#rate_1d').val();
						$("#rate_1d1").html(''); $("#rate_1d1").html(rate_1d+' CHF');

						$.ajax({
							url: "{!! URL::to('user/profile/rates') !!}",
							type: 'get',
							data: {rate_15m:rate_15m, rate_30m:rate_30m, rate_1h:rate_1h, rate_1d:rate_1d},
							success: function(data)
							{
								alert('Saved successfully');
							}
						});
					});
				});
				$(document).ready(function() {
					$('#hit9-cancel').click(function() {
						if (confirm('Are you sure ?')) {
							$("#rate_15m2").hide(); $("#rate_15m1").show();
							$("#rate_30m2").hide(); $("#rate_30m1").show();
							$("#rate_1h2").hide(); $("#rate_1h1").show();
							$("#rate_1d2").hide(); $("#rate_1d1").show();
						}
					});
				});*/
			</script>
<!--//////////////////////////////////////////////////////  -->

					</div>

					<?php /*<div class="personal_detail">
						<div class="col-md-5">
							<div class="detail_block">
								<h5>Details</h5>
								<p>
									<b class="detail_text">Phone</b><b class="dot"> : </b>
									<b class="per_det" id="phone1"><span>
									<?php $data =  $user->phone;echo "+".substr($data, 0, 2)." (".substr($data, 2, 1).") ".substr($data, 3, 2)." ".substr($data, 5, 3)." ".substr($data,8,3);
									 ?></span></b>
									<b class="per_det" id="phone2" style="display:none"><span><input id="phone" type="text" name="phone" value="{{ $user->phone }}"></span></b>
								</p>
								<p>
									<b class="detail_text">Primary contact</b><b class="dot"> :  </b>
									<b class="per_det" id="instruction1"><span>{{ $user_info_arr->instruction }}</span></b>
									<b class="per_det" id="instruction2" style="display:none"><span><input id="instruction" type="text" name="instruction" value="{{ $user_info_arr->instruction }}"></span></b>
								</p>
								<p>
									<b class="detail_text">Min.</b><b class="dot"> : </b>
									<b class="per_det" id="minimum_rate1">
										<span>
											{{ $user_info_arr->minimum_rate }}
											@if( $user_info_arr->minimum_rate)
												{{ trans('CHF') }}
											@else		
												{{ trans('No result ') }}
											@endif
										</span>
									</b>
									<b class="per_det" id="minimum_rate2" style="display:none">
										<span><input id="minimum_rate" type="text" name="minimum_rate" value="{{ $user_info_arr->minimum_rate }}"></span></b>
								</p>

<p>
	<b class="detail_text">Rate 15M</b><b class="dot"> : </b>
	<b class="per_det" id="rate_15m1">
		<span>
			{{ $user_info_arr->rate_15m }}
			@if( $user_info_arr->rate_15m)
				{{ trans('CHF') }}
			@else		
				{{ trans('No result ') }}
			@endif
		</span>
	</b>
	<b class="per_det" id="rate_15m2" style="display:none">
		<span><input id="rate_15m" type="text" name="rate_15m" value="{{ $user_info_arr->rate_15m }}"></span></b>
</p>


<p>
	<b class="detail_text">Rate 30M</b><b class="dot"> : </b>
	<b class="per_det" id="rate_30m1">
		<span>
			{{ $user_info_arr->rate_30m }}
			@if( $user_info_arr->rate_30m)
				{{ trans('CHF') }}
			@else		
				{{ trans('No result ') }}
			@endif
		</span>
	</b>
	<b class="per_det" id="rate_30m2" style="display:none">
		<span><input id="rate_30m" type="text" name="rate_30m" value="{{ $user_info_arr->rate_30m }}"></span></b>
</p>


<p>
	<b class="detail_text">Rate 1H</b><b class="dot"> : </b>
	<b class="per_det" id="rate_1h1">
		<span>
			{{ $user_info_arr->rate_1h }}
			@if( $user_info_arr->rate_1h)
				{{ trans('CHF') }}
			@else		
				{{ trans('No result ') }}
			@endif
		</span>
	</b>
	<b class="per_det" id="rate_1h2" style="display:none">
		<span><input id="rate_1h" type="text" name="rate_1h" value="{{ $user_info_arr->rate_1h }}"></span></b>
</p>

<p>
	<b class="detail_text">Rate 24H</b><b class="dot"> : </b>
	<b class="per_det" id="rate_1d1">
		<span>
			{{ $user_info_arr->rate_1d }}
			@if( $user_info_arr->rate_1d)
				{{ trans('CHF') }}
			@else		
				{{ trans('No result ') }}
			@endif
		</span>
	</b>
	<b class="per_det" id="rate_1d2" style="display:none">
		<span><input id="rate_1d" type="text" name="rate_1d" value="{{ $user_info_arr->rate_1d }}"></span></b>
</p>
								
								
								<p>
									<b class="detail_text">Region</b><b class="dot"> :  </b>
									<b class="per_det" id="region1"><span>{{ $user_info_arr->region }}</span></b>
									<b class="per_det" id="region2" style="display:none"><span>
										<!--<input id="region" type="text" name="region" value="{{ $user_info_arr->region }}">-->
										<select style="width:100%;" class="" name="region" id="region">
											<option value="">Region</option>
											@foreach($region_arr as $v)
												<option value="{{$v->name}}" <?php if($user_info_arr->region == $v->name) { echo "selected=selected"; } ?> >{{$v->name}}</option>
											@endforeach
										</select>
									</span></b>
								</p>
								<p>
									<b class="detail_text">Age</b><b class="dot"> :  </b>
									<b class="per_det" id="age1"><span>{{ $user_info_arr->age }}</span></b>
									<b class="per_det" id="age2" style="display:none"><span>
										<select style="width:100%;" class="" name="age" id="age">
											<option value="">Age</option>
											@foreach($age as $v)
												<option value="{{$v}}" <?php if($user_info_arr->age == $v) { echo "selected=selected"; } ?> >{{$v}}</option>
											@endforeach
										</select>
									</span></b>
								</p>
								<p>
									<b class="detail_text">Nationality</b><b class="dot"> :  </b>
									<b class="per_det" id="nationality1"><span>{{ $user_info_arr->nationality }}</span></b>
									<b class="per_det" id="nationality2" style="display:none"><span>
										<select style="width:100%;" class="" name="nationality" id="nationality">
											<option value="">Nationality</option>
											@foreach($country as $v)
												<option value="{{$v->countryName}}" <?php if($user_info_arr->nationality == $v->countryName) { echo "selected=selected"; } ?>>{{$v->countryName}}</option>
											@endforeach
										</select>
									</span></b>
								</p>	
								
								
							</div>
							<div class="barbiq_save_btn">
								<button id="hit1" class="btn save_btn">Save</button>
								<button id="hit1-cancel" class="btn save_btn">Cancel</button>
							</div>
						</div>
						<div class="col-md-3"></div>
						<div class="col-md-4 detail">
							<div class="language_box" id="content-2">
								<h5>LANGUAGE(S)</h5>
								<?php $lang_id='';
								if(!empty($user_language_id)){
									foreach($user_language_id as $value){
										$lang_id[] = $value->language_id;
									}
								}?>
								@if(!empty($language_arr))
									@foreach($language_arr as $key=>$value)
										<p><input type="checkbox" id="test{!! $key+1 !!}" name="language" value="{!! $value->id!!}" <?php if(!empty($lang_id)) { if(in_array($value->id,$lang_id)) { echo "checked=checked"; } }?> /><label for="test{!! $key+1 !!}"></label><img src="{!! URL::to('img/lang_flag').'/'.$value->flag !!}" class="flag"> {!! $value->name !!}</p>
									@endforeach
								@endif
							</div>
							<div class="barbiq_save_btn">
								<button id="hit4" class="btn save_btn">Save</button>
								<button class="btn save_btn">Cancel</button>
							</div>
						</div>
					</div>*/ ?>
				</div>
				<?php /*?>	<div class="personal_detail ">
					<div class="review ">
						<div class="col-md-12">
							<div class="review_bg_block">
								<h5>REVIEW</h5>
								<div class="review_block_services" id="content-4">
								@if(!empty($review_arr))
@foreach($review_arr as $key=>$value)
<?php $avf_raring = ($value->accuract_rating+$value->communication_rating+$value->hygiene_rating+$value->friendliness_rating+$value->cleanlines_rating+$value->talent_rating)/6; ?>
	<div class="reveiew_first">		
		<div class="col-md-12">
		<div class="col-md-6">
			<p class="review_profile">
				Accuracy :
				@if($value->accuract_rating>0)
					<?php for($i=1; $i<=$value->accuract_rating; $i++){ ?>
						<i class="fa fa-star" aria-hidden="true"></i>
					<?php } 
					if($i>$value->accuract_rating){?>
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
				Communication: 
				@if($value->communication_rating>0)
					<?php for($i=1; $i<=$value->communication_rating; $i++){ ?>
						<i class="fa fa-star" aria-hidden="true"></i>
					<?php } 
					if($i>$value->communication_rating){?>
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
				Hygiene : 
				@if($value->hygiene_rating>0)
					<?php for($i=1; $i<=$value->hygiene_rating; $i++){ ?>
						<i class="fa fa-star" aria-hidden="true"></i>
					<?php } 
					if($i>$value->hygiene_rating){?>
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
		<div class="col-md-12">

			<p class="review_profile">
				Friendliness : 
				@if($value->friendliness_rating>0)
					<?php for($i=1; $i<=$value->friendliness_rating; $i++){ ?>
						<i class="fa fa-star" aria-hidden="true"></i>
					<?php } 
					if($i>$value->friendliness_rating){?>
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
				Cleanliness : 
				@if($value->cleanlines_rating>0)
					<?php for($i=1; $i<=$value->cleanlines_rating; $i++){ ?>
						<i class="fa fa-star" aria-hidden="true"></i>
					<?php } 
					if($i>$value->cleanlines_rating){?>
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
				Talent : 
				@if($value->talent_rating>0)
					<?php for($i=1; $i<=$value->talent_rating; $i++){ ?>
						<i class="fa fa-star" aria-hidden="true"></i>
					<?php } 
					if($i>$value->talent_rating){?>
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
		<div class="col-md-12">
			<div class="col-md-2 grl-img">

			<img src="{{ asset('img/users/'.$value->photo) }}" onerror="this.src='{{ asset('img/users/noimage.jpg') }}';">
		</div>
		<div class="col-md-5 grl-content">	<p class="user_name">{!! $value->name !!}</p>
			<p class="review_profile"><b> on {!! date('F d, Y', strtotime($value->created_at)) !!}</b></p>
		</div>

<div class="col-md-5 ave-btn"><button class="btn report_btn">Average Rating: {!! number_format($avf_raring,2) !!}</button></div>

		</div>
		<div class="col-md-12">
			<p>{!! $value->description !!}</p>
		</div>
	</div>
@endforeach
								@else
									<br>
									<div class="reveiew_first">
										<div class="col-md-12"><h4>"No Reviews"</h4></div>
									</div>
								@endif
							</div>







						  </div>
						</div>
						
					</div>
				</div><?php */?>
				
				
				
				<div class="review">
				<div class="col-md-12">
					<h5>REVIEW</h5>
					<div class="review_block_services" id="content-4">
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
										
										<p class="user_name"> {!! $value->name !!} <span class="label label-default ishwar">{!! number_format($avf_raring,1) !!}</span> 
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
			</div>
				
				
				
			</div>
			<script>
				function sliderImg(id)
				{
					var id = id;
					//alert(id);
					$.ajax({
						url: "{!! URL::to('user/profile/sliderImg') !!}",
						type: 'get',
						data: {id:id},
						success: function(data){
							//alert('Saved successfully');
							swal({
									title: "Saved successfully",
									//text: "Please click on ok button!",
									type: "success",
								});
							//$('#fieldAttribute').html(data);
						}
					});
				}
			</script>
			<style>
				.edit_browse_file1 .jFiler-items.jFiler-row { display: none; }				
				.edit_browse_file .jFiler-items.jFiler-row { display: none; }				
			</style>
			<!-- We need the raterater stylesheet -->
			<link href="{{ URL::asset('css/raterater.css') }}" rel="stylesheet"/>

			<style>
			/* Override star colors */
			.raterater-bg-layer {
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
			}
			</style>
			<!---------------------------------->
<!-- We need jquery and raterater.jquery.js -->
<script src="{{ URL::asset('js/raterater.jquery.js') }}"></script>

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
        allowChange: true,
        starWidth: 20,
        spaceWidth: 5,
        numStars: 5
    } );
});

</script>			
			<script>
				$(".name1").click(function(){
					/*$("#name1").hide();
					$("#name2").show();*/
				});
				$(document).ready(function() {
					$('#hit').click(function() {
						$("#name2").hide();
						$("#name1").show();
						$("#name1").html('');
						$("#hit-edit").show();
							$('#hit').hide();
							$('#hit-cancel').hide();
						var name =$('#term').val();
						
						$("#name1").html(name);
						$.ajax({
							url: "{!! URL::to('user/profile/edit') !!}",
							type: 'get',
							data: {name:name},
							success: function(data){
								//alert('Saved successfully');
								swal({
									title: "Saved successfully",
									//text: "Please click on ok button!",
									type: "success",
								});
								//$('#fieldAttribute').html(data);
							}
						});
					});
				});
				$(document).ready(function() {
					$('#hit-cancel').click(function() {
						//alert('hr');
						swal({
					      title: "Are you sure?",
					      //text: "You will not be able to recover this imaginary file!",
					      type: "warning",
					      showCancelButton: true,
					      confirmButtonColor: '#DD6B55',
					      confirmButtonText: 'Yes',
					      closeOnConfirm: true
					    },
					    function(){
					      $("#name2").hide();
							$("#name1").show();
							$("#hit-edit").show();
							$('#hit').hide();
							$('#hit-cancel').hide();
					    });
						/*if (confirm('Are you sure ?')) {
							$("#name2").hide();
							$("#name1").show();
						}	*/					
					});
				});
				$(document).ready(function() {
					$('#hit-edit').click(function() {
						$('#hit').show();
						$('#hit-cancel').show();
						$('#hit-edit').hide();
						$("#name1").hide();
						$("#name2").show();
					});
				});
			</script>
			
			<script>
				/*$("#phone1").click(function(){
					$("#phone1").hide();
					$("#phone2").show();
				});*/
				/*$("#instruction1").click(function(){
					$("#instruction1").hide();
					$("#instruction2").show();
				});*/
				$("#minimum_rate1").click(function(){
					$("#minimum_rate1").hide();
					$("#minimum_rate2").show();
				});
$("#rate_15m1").click(function(){
	$("#rate_15m1").hide();
	$("#rate_15m2").show();
});

$("#rate_30m1").click(function(){
	$("#rate_30m1").hide();
	$("#rate_30m2").show();
});

$("#rate_1h1").click(function(){
	$("#rate_1h1").hide();
	$("#rate_1h2").show();
});

$("#rate_1d1").click(function(){
	$("#rate_1d1").hide();
	$("#rate_1d2").show();
});


				$("#region1").click(function(){
					$("#region1").hide();
					$("#region2").show();
				});
				/*$("#age1").click(function(){
					$("#age1").hide();
					$("#age2").show();
				});*/
				/*$("#nationality1").click(function(){
					$("#nationality1").hide();
					$("#nationality2").show();
				});*/
				/*$("#canton1").click(function(){
					$("#canton1").hide();
					$("#canton2").show();
				});*/
				/*$("#weight1").click(function(){
					$("#weight1").hide();
					$("#weight2").show();
				});*/
				/*$("#height1").click(function(){
					$("#height1").hide();
					$("#height2").show();
				});*/
				/*$("#city1").click(function(){
					$("#city1").hide();
					$("#city2").show();
				});*/
				/*$("#ethnicity1").click(function(){
					$("#ethnicity1").hide();
					$("#ethnicity2").show();
				});*/
				/*$("#eyes1").click(function(){
					$("#eyes1").hide();
					$("#eyes2").show();
				});*/



				/*$("#hair1").click(function(){
					$("#hair1").hide();
					$("#hair2").show();
				});*/
				/*$("#breast_size1").click(function(){
					$("#breast_size1").hide();
					$("#breast_size2").show();
				});*/
				/*$("#pubic_hair1").click(function(){
					$("#pubic_hair1").hide();
					$("#pubic_hair2").show();
				});*/
				/*$("#location1").click(function(){
					$("#location1").hide();
					$("#location2").show();
				});*/
				/*$("#orientation1").click(function(){
					$("#orientation1").hide();
					$("#orientation2").show();
				});*/
/*				$(document).ready(function() {
					$('#hit1').click(function() {
						$("#phone2").hide(); $("#phone1").show();
						var phone =$('#phone').val();
						$("#phone1").html(''); $("#phone1").html(phone);
						$("#new_number").html(''); $("#new_number").html(phone);
						$("#instruction2").hide(); $("#instruction1").show();
						var instruction =$('#instruction').val();
						$("#instruction1").html(''); $("#instruction1").html(instruction);
						$("#minimum_rate2").hide(); $("#minimum_rate1").show();
						var minimum_rate =$('#minimum_rate').val();
						$("#minimum_rate1").html(''); $("#minimum_rate1").html(minimum_rate+' CHF');
						$("#rate_15m2").hide(); $("#rate_15m1").show();
						var rate_15m =$('#rate_15m').val();
						$("#rate_15m1").html(''); $("#rate_15m1").html(rate_15m+' CHF');

						$("#rate_30m2").hide(); $("#rate_30m1").show();
						var rate_30m =$('#rate_30m').val();
						$("#rate_30m1").html(''); $("#rate_30m1").html(rate_30m+' CHF');

						$("#rate_1h2").hide(); $("#rate_1h1").show();
						var rate_1h =$('#rate_1h').val();
						$("#rate_1h1").html(''); $("#rate_1h1").html(rate_1h+' CHF');

						$("#rate_1d2").hide(); $("#rate_1d1").show();
						var rate_1d =$('#rate_1d').val();
						$("#rate_1d1").html(''); $("#rate_1d1").html(rate_1d+' CHF');

						$("#new_price").html(''); $("#new_price").html(minimum_rate+' $/hr');
						$("#region2").hide(); $("#region1").show();
						var region =$('#region').val();
						$("#region1").html(''); $("#region1").html(region);
						$("#age2").hide(); $("#age1").show();
						var age =$('#age').val();
						$("#age1").html(''); $("#age1").html(age);
						$("#nationality2").hide(); $("#nationality1").show();
						var nationality =$('#nationality').val();
						$("#nationality1").html(''); $("#nationality1").html(nationality);
						$.ajax({
							url: "{!! URL::to('user/profile/details') !!}",
							type: 'get',
							data: {name:name, phone:phone, instruction:instruction, minimum_rate:minimum_rate, region:region, age:age, nationality:nationality, rate_15m:rate_15m, rate_30m:rate_30m, rate_1h:rate_1h, rate_1d:rate_1d},
							success: function(data)
							{
								alert('Saved successfully');
							}
						});
					});
				});  */
				$(document).ready(function() {
					$('#hit1-edit').click(function() {
						$("#hit1-edit").hide();
						$("#hit1").show();
						$("#hit1-cancel").show();

						$("#canton1").hide();
						$("#canton2").show();
						$("#weight1").hide();
						$("#weight2").show();
						$("#age1").hide();
						$("#age2").show();
						$("#hair1").hide();
						$("#hair2").show();
						$("#breast_size1").hide();
						$("#breast_size2").show();
						$("#orientation1").hide();
						$("#orientation2").show();
						$("#pubic_hair1").hide();
						$("#pubic_hair2").show();
						$("#location1").hide();
						$("#location2").show();
						$("#eyes1").hide();
						$("#eyes2").show();
						$("#instruction1").hide();
						$("#instruction2").show();
						$("#phone1").hide();
						$("#phone2").show();
						$("#height1").hide();
						$("#height2").show();
						$("#city1").hide();
						$("#city2").show();
						$("#ethnicity1").hide();
						$("#ethnicity2").show();
						$("#nationality1").hide();
						$("#nationality2").show();

						$("#rate_15m1").hide();
						$("#rate_15m2").show();
						$("#rate_30m1").hide();
						$("#rate_30m2").show();
						$("#rate_1h1").hide();
						$("#rate_1h2").show();
						$("#rate_1d1").hide();
						$("#rate_1d2").show();

						$("#lang").hide();
						$("#lang1").show();
					});
				});

				$(document).ready(function() {
					$('#hit1').click(function() {
						$("#phone2").hide(); $("#phone1").show();
						var phone =$('#phone').val();
						$("#phone1").html(''); $("#phone1").html(phone);
						$("#new_number").html(''); $("#new_number").html(phone);
						
						$("#instruction2").hide(); $("#instruction1").show();
						var instruction =$('#instruction').val();
						$("#instruction1").html(''); $("#instruction1").html(instruction);
						$("#age2").hide(); $("#age1").show();
						var age =$('#age').val();
						$("#age1").html(''); $("#age1").html(age);
						$("#nationality2").hide(); $("#nationality1").show();
						var nationality =$('#nationality').val();
						$("#nationality1").html(''); $("#nationality1").html(nationality);
						$("#canton2").hide(); $("#canton1").show();
						var canton =$('#canton').val();
						$("#canton1").html(''); $("#canton1").html(canton);
						$("#weight2").hide(); $("#weight1").show();
						var weight =$('#weight').val();
						$("#weight1").html(''); $("#weight1").html(weight);
						$("#height2").hide(); $("#height1").show();
						var height =$('#height').val();
						$("#height1").html(''); $("#height1").html(height);
						$("#city2").hide(); $("#city1").show();
						var city =$('#city').val();
						$("#city1").html(''); $("#city1").html(city);
						$("#ethnicity2").hide(); $("#ethnicity1").show();
						var ethnicity =$('#ethnicity').val();
						$("#ethnicity1").html(''); $("#ethnicity1").html(ethnicity);
						$("#eyes2").hide(); $("#eyes1").show();
						var eyes =$('#eyes').val();
						$("#eyes1").html(''); $("#eyes1").html(eyes);
						$("#hair2").hide(); $("#hair1").show();
						var hair =$('#hair').val();
						$("#hair1").html(''); $("#hair1").html(hair);
						$("#breast_size2").hide(); $("#breast_size1").show();
						var breast_size =$('#breast_size').val();
						$("#breast_size1").html(''); $("#breast_size1").html(breast_size);
						$("#pubic_hair2").hide(); $("#pubic_hair1").show();
						var pubic_hair =$('#pubic_hair').val();
						$("#pubic_hair1").html(''); $("#pubic_hair1").html(pubic_hair);
						$("#location2").hide(); $("#location1").show();
						var location =$('#location').val();
						$("#location1").html(''); $("#location1").html(location);
						$("#orientation2").hide(); $("#orientation1").show();
						var orientation =$('#orientation').val();
						$("#orientation1").html(''); $("#orientation1").html(orientation);

						$("#rate_15m2").hide(); $("#rate_15m1").show();
						var rate_15m =$('#rate_15m').val();
						$("#rate_15m1").html(''); $("#rate_15m1").html(rate_15m+' CHF');

						$("#rate_30m2").hide(); $("#rate_30m1").show();
						var rate_30m =$('#rate_30m').val();
						$("#rate_30m1").html(''); $("#rate_30m1").html(rate_30m+' CHF');

						$("#rate_1h2").hide(); $("#rate_1h1").show();
						var rate_1h =$('#rate_1h').val();
						$("#rate_1h1").html(''); $("#rate_1h1").html(rate_1h+' CHF');

						$("#rate_1d2").hide(); $("#rate_1d1").show();
						var rate_1d =$('#rate_1d').val();
						$("#rate_1d1").html(''); $("#rate_1d1").html(rate_1d+' CHF');

						var language_id = [];
						$('input[name=language]:checked').map(function() {
							language_id.push($(this).val());
						});
						//alert(language_id);
						var rating = [];
						$('.ratebox').map(function() {
							if($(this).attr('data-rating') != '')
							{
								rating.push($(this).attr('data-rating'));
							}
						});
						//alert(rating);
						//alert(rating);
						



						$.ajax({
							url: "{!! URL::to('user/profile/details') !!}",
							type: 'get',
							data: {phone:phone,instruction:instruction, age:age, nationality:nationality, canton:canton, weight:weight, height:height, city:city, ethnicity:ethnicity, eyes:eyes, hair:hair, breast_size:breast_size, location:location, pubic_hair:pubic_hair, orientation:orientation,rate_15m:rate_15m, rate_30m:rate_30m, rate_1h:rate_1h, rate_1d:rate_1d, language_id:language_id,rating:rating},
							success: function(data)
							{
								//alert('Saved successfully');
								$("#hit1-edit").show();
								$("#hit1").hide();
								$("#hit1-cancel").hide();
								$("#lang").show();
								$("#lang1").hide();
								swal({
									title: "Saved successfully",
									//text: "Please click on ok button!",
									type: "success",
								});
								window.location.reload();
								
							}
						});
					});
				});

				/*$(document).ready(function() {
					$('#hit1-cancel').click(function() {
						if (confirm('Are you sure ?')) {
							$("#phone2").hide(); $("#phone1").show();
							$("#instruction2").hide(); $("#instruction1").show();
							$("#minimum_rate2").hide(); $("#minimum_rate1").show();
							$("#rate_15m2").hide(); $("#rate_15m1").show();
							$("#rate_30m2").hide(); $("#rate_30m1").show();
							$("#rate_1h2").hide(); $("#rate_1h1").show();
							$("#rate_1d2").hide(); $("#rate_1d1").show();
							$("#region2").hide(); $("#region1").show();
							$("#age2").hide(); $("#age1").show();
							$("#nationality2").hide(); $("#nationality1").show();
						}
					});
				});*/
				$(document).ready(function() {
					$('#hit1-cancel').click(function() {
						swal({
					      title: "Are you sure?",
					      //text: "You will not be able to recover this imaginary file!",
					      type: "warning",
					      showCancelButton: true,
					      confirmButtonColor: '#DD6B55',
					      confirmButtonText: 'Yes',
					      closeOnConfirm: true
					    },
					    function(){
					      $("#hit1-edit").show();
							$("#hit1").hide();
							$("#hit1-cancel").hide();
							$("#region2").hide(); $("#region1").show();
							$("#age2").hide(); $("#age1").show();
							$("#nationality2").hide(); $("#nationality1").show();
							$("#canton2").hide(); $("#canton1").show();
							$("#weight2").hide(); $("#weight1").show();
							$("#height2").hide(); $("#height1").show();
							$("#city2").hide(); $("#city1").show();
							$("#ethnicity2").hide(); $("#ethnicity1").show();
							$("#eyes2").hide(); $("#eyes1").show();
							$("#hair2").hide(); $("#hair1").show();
							$("#breast_size2").hide(); $("#breast_size1").show();
							$("#pubic_hair2").hide(); $("#pubic_hair1").show();
							$("#location2").hide(); $("#location1").show();
							$("#orientation2").hide(); $("#orientation1").show();
							$("#instruction2").hide(); $("#instruction1").show();
							$("#rate_15m2").hide(); $("#rate_15m1").show();
							$("#rate_30m2").hide(); $("#rate_30m1").show();
							$("#rate_1h2").hide(); $("#rate_1h1").show();
							$("#rate_1d2").hide(); $("#rate_1d1").show();
							$("#lang1").hide(); $("#lang").show();
					    });
					    window.location.reload();
						/*if (confirm('Are you sure ?')) {
							$("#hit1-edit").show();
							$("#hit1").hide();
							$("#hit1-cancel").hide();
							$("#region2").hide(); $("#region1").show();
							$("#age2").hide(); $("#age1").show();
							$("#nationality2").hide(); $("#nationality1").show();
							$("#canton2").hide(); $("#canton1").show();
							$("#weight2").hide(); $("#weight1").show();
							$("#height2").hide(); $("#height1").show();
							$("#city2").hide(); $("#city1").show();
							$("#ethnicity2").hide(); $("#ethnicity1").show();
							$("#eyes2").hide(); $("#eyes1").show();
							$("#hair2").hide(); $("#hair1").show();
							$("#breast_size2").hide(); $("#breast_size1").show();
							$("#pubic_hair2").hide(); $("#pubic_hair1").show();
							$("#location2").hide(); $("#location1").show();
							$("#orientation2").hide(); $("#orientation1").show();
							$("#instruction2").hide(); $("#instruction1").show();
							$("#rate_15m2").hide(); $("#rate_15m1").show();
							$("#rate_30m2").hide(); $("#rate_30m1").show();
							$("#rate_1h2").hide(); $("#rate_1h1").show();
							$("#rate_1d2").hide(); $("#rate_1d1").show();
							$("#lang1").hide(); $("#lang").show();
						}*/
					});
				});

			</script>
			
			<script>
				$(document).ready(function() {
					$('#hit3').click(function() {
						$('#hit3-edit').show();
						$('#hit3-cancel').hide();
						$('#hit3').hide();
						$('.hit3-check').show();
						$('.hit3-check1').hide();
						var service_id = [];
						$('input[name=services]:checked').map(function() {
							service_id.push($(this).val());
						});
						$.ajax({
							url: "{!! URL::to('user/profile/services') !!}",
							type: 'get',
							data: {service_id:service_id},
							success: function(data)
							{
								//alert('Saved successfully');
								swal({
									title: "Saved successfully",
									//text: "Please click on ok button!",
									type: "success",
								});
								//$('#fieldAttribute').html(data);
							}
						});
					});
				});
				$(document).ready(function() {
					$('#hit3-edit').click(function() {
						$('#hit3-edit').hide();
						$('#hit3-cancel').show();
						$('#hit3').show();
						$('.hit3-check').hide();
						$('.hit3-check1').show();
					});
				});
				$(document).ready(function() {
					$('#hit3-cancel').click(function() {
						swal({
					      title: "Are you sure?",
					      //text: "You will not be able to recover this imaginary file!",
					      type: "warning",
					      showCancelButton: true,
					      confirmButtonColor: '#DD6B55',
					      confirmButtonText: 'Yes',
					      closeOnConfirm: true
					    },
					    function(){
					    	$('#hit3-edit').show();
							$('#hit3-cancel').hide();
							$('#hit3').hide();
							$('.hit3-check').hide();
							
						$('.hit3-check').show();
						$('.hit3-check1').hide();
					    });
						/*if (confirm('Are you sure ?')) {
							$("#message2").hide();
							$("#message1").show();
						}*/
					});
				});
			</script>
			
			<script>
				$(document).ready(function() {
					$('#hit4').click(function() {
						var language_id = [];
						$('input[name=language]:checked').map(function() {
							language_id.push($(this).val());
						});
						alert(language_id);
						var rating = [];
						$('.ratebox').map(function() {
							if($(this).attr('data-rating') != '')
							{
								rating.push($(this).attr('data-rating'));
							}
						});
						alert(rating);
						//alert(rating);
						$.ajax({
							url: "{!! URL::to('user/profile/languages') !!}",
							type: 'get',
							data: {language_id:language_id,rating:rating},
							success: function(data)
							{
								//alert('Saved successfully');
								swal({
									title: "Saved successfully",
									//text: "Please click on ok button!",
									type: "success",
								});
								//$('#fieldAttribute').html(data);
							}
						});
					});
				});
			</script>
			
			<script>
				$("#message1").click(function(){
					//alert("hello");
					/*$("#message1").hide();
					$("#message2").show();*/
				});
				$(document).ready(function() {
					$('#hit5').click(function() {
						$("#message2").hide();
						$("#message1").show();
						$("#message1").html('');
						$('#hit5').hide();
						$('#hit5-cancel').hide();
						$('#hit5-edit').show();
						var message =$('#message').val();
						$("#message1").html(message);
						$.ajax({
							url: "{!! URL::to('user/profile/edit/message') !!}",
							type: 'get',
							data: {message:message},
							success: function(data)
							{
								//alert('Saved successfully');
								swal({
									title: "Saved successfully",
									//text: "Please click on ok button!",
									type: "success",
								});
								//$('#fieldAttribute').html(data);
							}
						});
					});
				});
				$(document).ready(function() {
					$('#hit5-cancel').click(function() {
						swal({
					      title: "Are you sure?",
					      //text: "You will not be able to recover this imaginary file!",
					      type: "warning",
					      showCancelButton: true,
					      confirmButtonColor: '#DD6B55',
					      confirmButtonText: 'Yes',
					      closeOnConfirm: true
					    },
					    function(){
					      $("#message2").hide();
						  $("#message1").show();
						  $('#hit5').hide();
						  $('#hit5-cancel').hide();
						  $('#hit5-edit').show();
					    });
						/*if (confirm('Are you sure ?')) {
							$("#message2").hide();
							$("#message1").show();
						}*/
					});
				});
				$(document).ready(function() {
					$('#hit5-edit').click(function() {
						$('#hit5').show();
						$('#hit5-cancel').show();
						$('#hit5-edit').hide();
						$("#message2").show();
						$("#message1").hide();
					});
				});
			</script>
			
			<script>
				$(document).ready(function() {
					$('#hit6').click(function() {
						var user_id = "<?php echo Auth::User()->id?>";
						$.ajax({
							url: "{!! URL::to('user/profile/edit/images') !!}",
							type: 'get',
							data: {user_id:user_id},
							success: function(data)
							{
								location.reload(true);
								$('.jFiler-row').css("display", "none");
								$("#browse_gallery_btn").hide();
								$('#user_images').html('');
								$('#user_images').html(data);
								 $("#content-3").mCustomScrollbar({
									scrollButtons:{enable:true},
									theme:"3d-thick"
								});
								//alert('Saved successfully');
								swal({
									title: "Saved successfully",
									//text: "Please click on ok button!",
									type: "success",
								});
							}
						});
					});
				});
				$(document).ready(function() {
					$('#hit6-cancel').click(function() {
						swal({
					      title: "Are you sure?",
					      //text: "You will not be able to recover this imaginary file!",
					      type: "warning",
					      showCancelButton: true,
					      confirmButtonColor: '#DD6B55',
					      confirmButtonText: 'Yes',
					      closeOnConfirm: true
					    },
					    function(){
					      $("#browse_gallery_btn").hide();
							$(".close_image").hide();
					    });
						/*if (confirm('Are you sure ?')) {
							$("#browse_gallery_btn").hide();
							$(".close_image").hide();
						}*/
					});
				});
			</script>
			
			<script>
				$(document).ready(function() {
					$('#hit7').click(function() {
						var user_id = "<?php echo Auth::User()->id?>";
						$.ajax({
							url: "{!! URL::to('user/profile/edit/image') !!}",
							type: 'get',
							data: {user_id:user_id},
							success: function(data)
							{
								$('#user_image').html('');
								$('#user_image').html(data);
								$("#edit_image").hide();
								//alert('Saved successfully');
								swal({
									title: "Saved successfully",
									//text: "Please click on ok button!",
									type: "success",
								});
							}
						});
					});
				});
				$(document).ready(function() {
					$('#hit7-cancel').click(function() {
						swal({
					      title: "Are you sure?",
					      //text: "You will not be able to recover this imaginary file!",
					      type: "warning",
					      showCancelButton: true,
					      confirmButtonColor: '#DD6B55',
					      confirmButtonText: 'Yes',
					      closeOnConfirm: true
					    },
					    function(){
					      $("#edit_image").hide();
					    });
						/*if (confirm('Are you sure ?')) {
							$("#edit_image").hide();
						}*/
					});
				});
			</script>
			
			<script>
				function img_remove(id)
				{
					var id = id;
					swal({
					      title: "Are you sure remove gallery image ?'))",
					      //text: "You will not be able to recover this imaginary file!",
					      type: "warning",
					      showCancelButton: true,
					      confirmButtonColor: '#DD6B55',
					      confirmButtonText: 'Yes',
					      closeOnConfirm: true
					    },
					    function(){
					     $.ajax({
							url: "{!! URL::to('user/profile/images/remove') !!}",
							type: 'get',
							data: {id:id},
							success: function(data)
							{
								location.reload(true);
								$('#user_images').html('');
								$('#user_images').html(data);
								$("#content-3").mCustomScrollbar({
									scrollButtons:{enable:true},
									theme:"3d-thick"
								});
								alert('Remove successfully');
							}
						});
					    });
					/*if (confirm('Are you sure remove gallery image ?')) {
						$.ajax({
							url: "{!! URL::to('user/profile/images/remove') !!}",
							type: 'get',
							data: {id:id},
							success: function(data)
							{
								location.reload(true);
								$('#user_images').html('');
								$('#user_images').html(data);
								$("#content-3").mCustomScrollbar({
									scrollButtons:{enable:true},
									theme:"3d-thick"
								});
								alert('Remove successfully');
							}
						});
					}*/
				}
			</script>
			<!---------------------------------->
			
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
					});
				})(jQuery);
			</script>
			<script>
				$(document).ready(function() {
					$("#owl-demo").owlCarousel({
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
			<script>
				$( document ).ready(function() {
					$(".gallery_edit_ico").click(function(){
						$(".browse_gallery_btn").animate({
							height: 'toggle'
						});
						$(".close_image").toggle();
					});
				});
			</script>
			<script>
				$( document ).ready(function() {
					$(".edit").click(function(){
						$("#edit_image").animate({
							height: 'toggle'
						});
					});
				});
			</script>
			<script>
				$(".test").click(function(event){
					var span, input, text;
					event = event || window.event; // Get the event (handle MS difference)
					span = event.target || event.srcElement; // Get the root element of the event (handle MS difference)
					// If it's a span...
					if (span && span.tagName.toUpperCase() === "SPAN") {
						span.style.display = "none"; // Hide it
						text = span.innerHTML; // Get its text
						input = document.createElement("input"); // Create an input
						input.type = "text";
						input.name = "name";
						input.size = Math.max(text.length / 4 * 3, 4);
						span.parentNode.insertBefore(input, span);
						input.focus(); // Focus it, hook blur to undo
						input.onblur = function() {
							span.parentNode.removeChild(input); // Remove the input
							span.innerHTML = input.value; // Update the span
							if(input.value==""){
								span.innerHTML="Barbiq Nate";
							}
							span.style.display = ""; // Show the span again
						};
					}
				});
			</script>
			<script>
				$(".test1").click(function(event){
					var span, input, text;
					event = event || window.event; // Get the event (handle MS difference)
					span = event.target || event.srcElement; // Get the root element of the event (handle MS difference)
					// If it's a span...
					if (span && span.tagName.toUpperCase() === "SPAN") {
						span.style.display = "none"; // Hide it
						text = span.innerHTML; // Get its text
						input = document.createElement("textarea"); // Create an input
						input.type = "text";
						input.size = Math.max(text.length / 4 * 3, 4);
						span.parentNode.insertBefore(input, span);
						input.focus(); // Focus it, hook blur to undo
						input.onblur = function() {
							span.parentNode.removeChild(input); // Remove the input
							span.innerHTML = input.value; // Update the span
							if(input.value==""){
								span.innerHTML="Lorem Ipsum is simply dummy text of the printing and typesetting industry.";
							}
							span.style.display = ""; // Show the span again
						};
					}
				});
			</script>
		@else
	@if(!empty($user->coverphoto))
	<div class="imgcrousel" style="background: url(img/users/<?php echo $user->coverphoto; ?>); height: 540px; background-size: cover; background-position: center center;">
	@else
	<div class="imgcrousel" style="background: url(img/slider_inner.jpg); height: 540px; background-size: cover; background-position: center center;">
	@endif
		<div class="overlay_img"></div>
	</div>
        <div class="slider_edit_section">
			<span class="editImage edit_browse_file1"><img class="img-responsive" src="{!! URL::to('img/edit.png') !!}"><input type="file" name="files[]" class="filer_input23" multiple="multiple" accept="image/*"></span>
<!-- 			<div class="" id="edit_image_cover" style="display:none;">				
				<div class="gallery_submit">
					<button id="hit8" class="btn save_btn">Save</button>
					<button id="hit8-cancel" class="btn save_btn">Cancel</button>
				</div>
			</div> -->
		</div>
		<script>
			$( document ).ready(function() {
				$(".editImage").click(function(){
					$("#edit_image_cover").animate({
						height: 'toggle'
					});
				});
			});
		</script>
		<script>
				$(document).ready(function() {
					$('#hit8').click(function() {
						var user_id = "<?php echo Auth::User()->id?>";
						$.ajax({
							url: "{!! URL::to('user/profile/edit/coverimage') !!}",
							type: 'get',
							data: {user_id:user_id},
							success: function(data)
							{
								$('#user_cover_image').html('');
								$('#user_cover_image').html(data);
								$("#edit_image_cover").hide();
								//alert('Saved successfully');
								swal({
									title: "Saved successfully",
									//text: "Please click on ok button!",
									type: "success",
								});
								window.location.reload();
							}
						});
					});
				});
				/*$(document).ready(function() {
					swal({
					      title: "Are you sure?",
					      //text: "You will not be able to recover this imaginary file!",
					      type: "warning",
					      showCancelButton: true,
					      confirmButtonColor: '#DD6B55',
					      confirmButtonText: 'Yes',
					      closeOnConfirm: true
					    },
					    function(){
					      $("#edit_image_cover").hide();
					    });
					/*$('#hit8-cancel').click(function() {
						if (confirm('Are you sure ?')) {
							$("#edit_image_cover").hide();
						}
					});*/
				});*/
			</script>



	</div>
			</div>
			<div class="container">
				<div class="row profilerow">
					<div class="profile">
						<div class="col-md-4 col-sm-4">
							<div id="user_image"><img class="img-responsive" src="{!! URL::to('img/users').'/'.$user->photo!!}"></div>
							<span class="edit edit_browse_file"><img class="img-responsive" src="{!! URL::to('img/edit.png') !!}"><input type="file" name="files[]" class="filer_input22" multiple="multiple" accept="image/*"></span>
							<!--<div class="" id="edit_image" style="display:none;">	
								<div class="gallery_submit">
									<button id="hit7" class="btn save_btn">Save</button>
									<button id="hit7-cancel" class="btn save_btn">Cancel</button>
								</div>
							</div>
							<p class="review_profile1"><i class="fa fa-heart-o" aria-hidden="true"></i>  <i class="fa fa-phone" aria-hidden="true"></i>  <i class="fa fa-comments-o" aria-hidden="true"></i></p>-->
						</div>
						<div class="col-md-8 col-sm-8 user_detail">
							<h1 class="name1" id="name1"><span>{{ ucfirst($user->name) }}</span></h1>
							<h1 id="name2" style="display:none;"><span><input id="term" type="text" name="name" value="{{ $user->name }}"></span></h1>
							<!-- <span class="barbiq_edit name1"><i class="fa fa-pencil" aria-hidden="true"></i></span> -->
							<p class="review_profile">
								<b class="rigt_phone_icon"><i class="fa fa-phone" aria-hidden="true"></i><span id="new_number">
								<?php $data =  $user->phone;
		 			              echo "+".substr($data, 0, 2)." (".substr($data, 2, 1).") ".substr($data, 3, 2)." ".substr($data, 5, 3)." ".substr($data,8,3); ?>
								</span></b>
								<b class="" id="new_number1" style="display:none"><span><input id="new_number2" type="text" name="new_number" value="{{ $user->phone }}"></span></b><br>
								<?php /*?><b><i class="fa-envelope" aria-hidden="true"></i><span id="new_number">
								<?php echo $user->email; ?>
								</span></b><?php */?>
							</p>
							<div class="barbiq_save_btn">
								<button id="hit" class="btn save_btn" style="display: none;">Save</button>
								<button id="hit-cancel" class="btn save_btn" style="display: none;">Cancel</button>
								<button id="hit-edit" class="btn save_btn">Edit</button>
							</div>
						</div>
						<div class="about">
							<div class="col-md-12">
								<h5>ABOUT ME</h5>
								@if(!empty($user_info_arr->message))
									<p class=""><span><?php echo "<pre id='message1'>"; print_r($user_info_arr->message); echo "</pre>"; ?></span></p>
								@else
									<p class="" id="message1"><span>No About her Contect</span></p>
								@endif
								<p class="" id="message2" style="display:none;">
									<span><textarea id="message" type="teat" id="message" name="message"  rows="3" cols="150">	{{ $user_info_arr->message }}</textarea> </span>
								</p>
								<div class="barbiq_save_btn">
									<button id="hit5" class="btn save_btn" style="display:none">Save</button>
									<button id="hit5-cancel" class="btn save_btn" style="display:none">Cancel</button>
									<button id="hit5-edit" class="btn save_btn">Edit</button>
								</div>
							</div>
						</div>
						<div class="col-md-12 personal_detail">
						<!-- <div class="col-md-8"> -->

							<div class="col-md-4">
								<h5>Details</h5>
								<p>
									<b class="detail_text">Canton</b><b class="dot"> :  </b>
									<b class="per_det" id="canton1"><span>{{ $user_info_arr->canton }}</span></b>
									<b class="per_det" id="canton2" style="display:none"><span>
										<select style="width:100%;" class="" name="canton" id="canton">
											<option value="">Canton</option>
											@foreach($cantons as $value)
												<option value="{{ $value->name }}" <?php if($user_info_arr->canton == $value->name) { echo "selected=selected"; } ?>>{{ $value->name }}</option>
											@endforeach
										</select>
									</span></b>
								</p>
								<p>
									<b class="detail_text">City</b><b class="dot"> :  </b>
									<b class="per_det" id="city1"><span>{{ $user_info_arr->city }}</span></b>
									<b class="per_det" id="city2" style="display:none"><span><input id="city" type="text" name="city" value="{{ $user_info_arr->city }}"></span></b>
								</p>
								<p>
									<b class="detail_text">Nationality</b><b class="dot"> :  </b>
									<b class="per_det" id="nationality1"><span>{{ $user_info_arr->nationality }}</span></b>
									<b class="per_det" id="nationality2" style="display:none"><span>
										<select style="width:100%;" class="" name="nationality" id="nationality">
											<option value="">Nationality</option>
											@foreach($country as $v)
												<option value="{{$v->countryName}}" <?php if($user_info_arr->nationality == $v->countryName) { echo "selected=selected"; } ?>>{{$v->countryName}}</option>
											@endforeach
										</select>
									</span></b>
								</p>
								<p>
									<b class="detail_text">Ethnicity</b><b class="dot"> :  </b>
									<b class="per_det" id="ethnicity1"><span>{{ $user_info_arr->ethnicity }}</span></b>
									<b class="per_det" id="ethnicity2" style="display:none"><span>
										<select style="width:100%;" class="" name="ethnicity" id="ethnicity">
											<option value="Caucasian" <?php if($user_info_arr->ethnicity == 'Caucasian') { echo "selected='selected'"; }?> >Caucasian</option>
											<option value="Arab" <?php if($user_info_arr->ethnicity == 'Arab') { echo "selected='selected'"; }?>>Arab</option>
											<option value="Asian" <?php if($user_info_arr->ethnicity == 'Asian') { echo "selected='selected'"; }?>>Asian</option>
											<option value="Black" <?php if($user_info_arr->ethnicity == 'Black') { echo "selected='selected'"; }?>>Black</option>
											<option value="Hispanic" <?php if($user_info_arr->ethnicity == 'Hispanic') { echo "selected='selected'"; }?>>Hispanic</option>
											<option value="Other" <?php if($user_info_arr->ethnicity == 'Other') { echo "selected='selected'"; }?>>Other</option>
										</select>
									</span></b>
								</p>
								<p>
									<b class="detail_text">Age</b><b class="dot"> :  </b>
									<b class="per_det" id="age1"><span>{{ $user_info_arr->age }}</span></b>
									<b class="per_det" id="age2" style="display:none"><span>
										<select style="width:100%;" class="" name="age" id="age">
											<option value="">Age</option>
											@foreach($age as $v)
												<option value="{{$v}}" <?php if($user_info_arr->age == $v) { echo "selected=selected"; } ?> >{{$v}}</option>
											@endforeach
										</select>
									</span></b>
								</p>
								<?php /*?><p>
									<b class="detail_text">Weight</b><b class="dot"> :  </b>
									<b class="per_det" id="weight1"><span>{{ $user_info_arr->weight }}</span></b>
									<b class="per_det" id="weight2" style="display:none"><span><input id="weight" type="text" name="weight" value="{{ $user_info_arr->weight }}"></span></b>
								</p>
								<p>
									<b class="detail_text">Height</b><b class="dot"> :  </b>
									<b class="per_det" id="height1"><span>{{ $user_info_arr->height }}</span></b>
									<b class="per_det" id="height2" style="display:none"><span><input id="height" type="text" name="height" value="{{ $user_info_arr->height }}"></span></b>
								</p><?php */?>
							</div>
							<div class="col-md-4 ">
								<br><br><br>
								<?php /*?><p>
									<b class="detail_text">Eyes</b><b class="dot"> :  </b>
									<b class="per_det" id="eyes1"><span>{{ $user_info_arr->eyes }}</span></b>
									<b class="per_det" id="eyes2" style="display:none"><span><input id="eyes" type="text" name="eyes" value="{{ $user_info_arr->eyes }}"></span></b>
								</p>
								<p>
									<b class="detail_text">Hair</b><b class="dot"> :  </b>
									<b class="per_det" id="hair1"><span>{{ $user_info_arr->hair }}</span></b>
									<b class="per_det" id="hair2" style="display:none"><span><input id="hair" type="text" name="hair" value="{{ $user_info_arr->hair }}"></span></b>
								</p>
								<p>
									<b class="detail_text">Breast size</b><b class="dot"> :  </b>
									<b class="per_det" id="breast_size1"><span>{{ $user_info_arr->breast_size }}</span></b>
									<b class="per_det" id="breast_size2" style="display:none"><span><input id="breast_size" type="text" name="breast_size" value="{{ $user_info_arr->breast_size }}"></span></b>
								</p>
								<p>
									<b class="detail_text">Pubic hair</b><b class="dot"> :  </b>
									<b class="per_det" id="pubic_hair1"><span>{{ $user_info_arr->pubic_hair }}</span></b>
									<b class="per_det" id="pubic_hair2" style="display:none"><span><input id="pubic_hair" type="text" name="pubic_hair" value="{{ $user_info_arr->pubic_hair }}"></span></b>
								</p><?php */?>
								<p>
									<b class="detail_text">Location</b><b class="dot"> :  </b>
									<b class="per_det" id="location1"><span>{{ $user_info_arr->location }}</span></b>
									<b class="per_det" id="location2" style="display:none"><span><input id="location" type="text" name="location" value="{{ $user_info_arr->location }}"></span></b>
								</p>
								<p>
									<b class="detail_text">Orientation</b><b class="dot"> :  </b>
									<b class="per_det" id="orientation1"><span>{{ $user_info_arr->orientation }}</span></b>
									<b class="per_det" id="orientation2" style="display:none"><span><input id="orientation" type="text" name="orientation" value="{{ $user_info_arr->orientation }}"></span></b>
								</p>
								
								<p>
									<b class="detail_text">Primary contact</b><b class="dot"> :  </b>
									<b class="per_det" id="instruction1"><span>{{ $user_info_arr->instruction }}</span></b>
									<b class="per_det" id="instruction2" style="display:none"><span><input id="instruction" type="text" name="instruction" value="{{ $user_info_arr->instruction }}"></span></b>
								</p>

								<p>
									<b class="detail_text">Phone</b><b class="dot"> : </b>
									<b class="per_det" id="phone1"><span>
									<?php $data =  $user->phone;echo "+".substr($data, 0, 2)." (".substr($data, 2, 1).") ".substr($data, 3, 2)." ".substr($data, 5, 3)." ".substr($data,8,3);
									 ?></span></b>
									<b class="per_det" id="phone2" style="display:none"><span><input id="phone" type="text" name="phone" value="{{ $user->phone }}"></span></b>
								</p>	
								
								
							
								<?php /*?><div class="barbiq_save_btn">
									<button id="hit1" class="btn save_btn" style="display:none">Save</button>
									<button id="hit1-cancel" class="btn save_btn" style="display:none">Cancel</button>
									<button id="hit1-edit" class="btn save_btn">Edit</button>
								</div><?php */?>
							</div>
						<!-- </div>
						<div class="col-md-3"></div> -->
						<div class="col-md-4 col-sm-4 detail flag_detail_page user_lang">
							<div class="language_box" id="content-2">
								<h5>LANGUAGE(S)</h5>
								<?php $lang_id='';
								if(!empty($user_language_id)){
									foreach($user_language_id as $value){
										$lang_id[] = $value->language_id;
									}
								}?>
								@if(!empty($language_arr))
									<div id="lang">
										@foreach($language_arr as $key=>$value)
										<?php if(!empty($user_language_id)){
										foreach($user_language_id as $val){ 
											if($val->language_id==$value->id){?>
										<p><img src="{!! URL::to('img/lang_flag').'/'.$value->flag !!}" class="flag"> {!! $value->name !!}</p>
										<?php if($val->rating > 0){?>
										<div class="val val-tare abc">
											<div class="ratebox" id="test1{!! $key+1 !!}" data-id="rating{!! $key+1 !!}" data-rating="{{ $val->rating }}"></div>
										</div> <?php }?><br>
											<?php }
											}} 
											 ?>
										
									@endforeach
									</div>
									<div id="lang1" style="display: none;">
									@foreach($language_arr as $key=>$value)
										<p><input type="checkbox" id="test{!! $key+1 !!}" class="attrbute_check1" name="language" value="{!! $value->id!!}" <?php if(!empty($lang_id)) { if(in_array($value->id,$lang_id)) { echo "checked=checked"; } }?> /><label for="test{!! $key+1 !!}"></label><img src="{!! URL::to('img/lang_flag').'/'.$value->flag !!}" class="flag"> {!! $value->name !!}</p>
										<div <?php if(!empty($lang_id)) { if(in_Array($value->id,$lang_id)) { } else { echo "style='display: none;'"; } } else { echo "style='display: none;'"; } ?> id="catbox-{{ $value->id}}" class="val val-tare abc">
											<?php if(!empty($user_language_id))
											{
												$r=0;
												foreach($user_language_id as $val)
												{ 
													if($val->language_id==$value->id)
													{
														$r++; ?>
														<div class="ratebox" id="test1{!! $key+1 !!}" data-id="rating{!! $key+1 !!}" data-rating="{{ $val->rating }}"></div>
													<?php }
												}
												if($r==0){ ?>
													<div class="ratebox" id="test-{!! $value->id !!}" data-id="rating{!! $key+1 !!}" data-rating="" style="display: none;"></div>
												<?php }
											} 
											else{ ?>
												<div class="ratebox" id="test-{!! $value->id !!}" data-id="rating{!! $key+1 !!}" data-rating="" style="display: none;"></div>
											<?php } ?>
										</div><br>
										
									@endforeach
									</div>
								@endif
							
<script type="text/javascript">
    $(function () {
        $(".attrbute_check1").click(function () {
            if ($(this).is(":checked")) {
                var ids=$(this).val();
                //alert(ids);
                $('#catbox-'+ids).show();
                $('#test-'+ids).show();
            } else {
                var ids=$(this).val();
                $('#catbox-'+ids).hide();
                console.log($('#catbox-'+ids +' .ratebox'));
                //alert($('#catbox-'+ids +' .ratebox').attr('data-rating'));
                $('#catbox-'+ids +' .ratebox').attr('data-rating',' ');
    
            }
        });
    });
</script>

							<?php /*?><br><div class="barbiq_save_btn">
								<button id="hit4" class="btn save_btn">Save</button>
								<button class="btn save_btn">Cancel</button>
							</div><?php */?>
						</div>
						<div class="barbiq_save_btn">
							<button id="hit1" class="btn save_btn" style="display:none">Save</button>
							<button id="hit1-cancel" class="btn save_btn" style="display:none">Cancel</button>
							<button id="hit1-edit" class="btn save_btn">Edit</button>
						</div>
					</div>
					</div>
					</div>
			<?php /*<div class="dashboard_block">
				<div class="panel panel-default">
					<div class="panel-heading">{{ trans('navs.frontend.dashboard') }}</div>
					<div class="panel-body">
						<div role="tabpanel">
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active">
									<a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">{{ trans('navs.frontend.user.my_information') }}</a>
								</li>
							</ul>
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="profile">
									<table class="table table-striped table-hover table-bordered dashboard-table">
										<tr>
											<th>{{ trans('labels.frontend.user.profile.avatar') }}</th>
											<td><img src="{!! URL::to('img/users').'/'.$user->photo!!}" class="user-profile-image" style="height:80px;" /></td>
										</tr>
										<tr>
											<th>{{ trans('labels.frontend.user.profile.name') }}</th>
											<td>{{ $user->name }}</td>
										</tr>
										<tr>
											<th>{{ trans('common.phone') }}</th>
											<td>{{ $user->phone }}</td>
										</tr>
										<tr>
											<th>{{ trans('labels.frontend.user.profile.email') }}</th>
											<td>{{ $user->email }}</td>
										</tr>
										@if($user->user_type=="Escort")
											@include('frontend.user.showescortinfo')
										@endif
										<tr>
											<th>{{ trans('labels.frontend.user.profile.created_at') }}</th>
											<td>{{ $user->created_at }} ({{ $user->created_at->diffForHumans() }})</td>
										</tr>
										<tr>
											<th>{{ trans('labels.frontend.user.profile.last_updated') }}</th>
											<td>{{ $user->updated_at }} ({{ $user->updated_at->diffForHumans() }})</td>
										</tr>
										<tr>
											<th>{{ trans('labels.general.actions') }}</th>
											<td>
												{{ link_to_route('frontend.user.profile.edit', trans('labels.frontend.user.profile.edit_information'), [], ['class' => 'btn-margin btn btn-primary btn-xs']) }}
												@if ($user->canChangePassword())
													{{ link_to_route('auth.password.change', trans('navs.frontend.user.change_password'), [], ['class' => 'btn-margin btn btn-warning btn-xs']) }}
												@endif
											</td>
										</tr>
									</table>
								</div><!--tab panel profile-->
							</div><!--tab content-->
						</div><!--tab panel-->
					</div><!--panel body-->
				</div><!-- panel -->
			</div><!-- col-md-10 -->*/?>
				<script>
				$(".name1").click(function(){
					/*$("#name1").hide();
					$("#name2").show();*/
				});
				$("#new_number").click(function(){
					/*$("#new_number").hide();
					$("#new_number1").show();*/
				});
				$(document).ready(function() {
					$('#hit').click(function() {
						$("#name2").hide();
						$("#name1").show();
						$("#new_number1").hide();
						$("#new_number").show();
						$("#new_number2").html('');
						$("#name1").html('');

							$("#hit-edit").show();
							$('#hit').hide();
							$('#hit-cancel').hide();




						var name =$('#term').val();
						var phone =$('#new_number2').val();
						//alert(phone);
						
						$("#name1").html(name);
						$.ajax({
							url: "{!! URL::to('user/profile/edit') !!}",
							type: 'get',
							data: {name:name,phone:phone},
							success: function(data){
								//alert('Saved successfully');
								swal({
									title: "Saved successfully",
									//text: "Please click on ok button!",
									type: "success",
								});
								window.location.reload();
								//$('#fieldAttribute').html(data);
							}
						});
					});
				});
				$(document).ready(function() {
					$('#hit-cancel').click(function() {
						swal({
					      title: "Are you sure?",
					      //text: "You will not be able to recover this imaginary file!",
					      type: "warning",
					      showCancelButton: true,
					      confirmButtonColor: '#DD6B55',
					      confirmButtonText: 'Yes',
					      closeOnConfirm: true
					    },
					    function(){
					      $("#name2").hide();
							$("#name1").show();
							$("#hit-edit").show();
							$("#new_number1").hide();
							$("#new_number").show();
							$('#hit').hide();
							$('#hit-cancel').hide();
					    });
						/*if (confirm('Are you sure ?')) {
							$("#name2").hide();
							$("#name1").show();
							$("#new_number1").hide();
							$("#new_number").show();
						}*/						
					});
				});
			</script>

			<script>
				$("#message1").click(function(){
					/*$("#message1").hide();
					$("#message2").show();*/
				});
				$(document).ready(function() {
					$('#hit5').click(function() {
						$("#message2").hide();
						$("#message1").show();
						$('#hit5').hide();
						$('#hit5-cancel').hide();
						$('#hit5-edit').show();
						$("#message1").html('');
						var message =$('#message').val();
						$("#message1").html(message);
						$.ajax({
							url: "{!! URL::to('user/profile/edit/message') !!}",
							type: 'get',
							data: {message:message},
							success: function(data)
							{
								//alert('Saved successfully');
								swal({
									title: "Saved successfully",
									//text: "Please click on ok button!",
									type: "success",
								});
								//$('#fieldAttribute').html(data);
							}
						});
					});
				});
				
			</script>
			
			<script>
				$(document).ready(function() {
					$('#hit6').click(function() {
						var user_id = "<?php echo Auth::User()->id?>";
						$.ajax({
							url: "{!! URL::to('user/profile/edit/images') !!}",
							type: 'get',
							data: {user_id:user_id},
							success: function(data)
							{
								location.reload(true);
								$('.jFiler-row').css("display", "none");
								$("#browse_gallery_btn").hide();
								$('#user_images').html('');
								$('#user_images').html(data);
								 $("#content-3").mCustomScrollbar({
									scrollButtons:{enable:true},
									theme:"3d-thick"
								});
								//alert('Saved successfully');
								swal({
									title: "Saved successfully",
									//text: "Please click on ok button!",
									type: "success",
								});
							}
						});
					});
				});
				$(document).ready(function() {
					$('#hit6-cancel').click(function() {
						swal({
					      title: "Are you sure?",
					      //text: "You will not be able to recover this imaginary file!",
					      type: "warning",
					      showCancelButton: true,
					      confirmButtonColor: '#DD6B55',
					      confirmButtonText: 'Yes',
					      closeOnConfirm: true
					    },
					    function(){
					      $("#browse_gallery_btn").hide();
							$(".close_image").hide();
					    });
						/*if (confirm('Are you sure ?')) {
							$("#browse_gallery_btn").hide();
							$(".close_image").hide();
						}*/
					});
				});
			</script>
			
			<script>
				$(document).ready(function() {
					$('#hit7').click(function() {
						var user_id = "<?php echo Auth::User()->id?>";
						$.ajax({
							url: "{!! URL::to('user/profile/edit/image') !!}",
							type: 'get',
							data: {user_id:user_id},
							success: function(data)
							{
								$('#user_image').html('');
								$('#user_image').html(data);
								$("#edit_image").hide();
								//alert('Saved successfully');
								swal({
									title: "Saved successfully",
									//text: "Please click on ok button!",
									type: "success",
								});
							}
						});
					});
				});
				$(document).ready(function() {
					$('#hit7-cancel').click(function() {
						swal({
					      title: "Are you sure?",
					      //text: "You will not be able to recover this imaginary file!",
					      type: "warning",
					      showCancelButton: true,
					      confirmButtonColor: '#DD6B55',
					      confirmButtonText: 'Yes',
					      closeOnConfirm: true
					    },
					    function(){
					      $("#edit_image").hide();
					    });
						/*if (confirm('Are you sure ?')) {
							$("#edit_image").hide();
						}*/
					});
				});
			</script>
			<style>
				.edit_browse_file1 .jFiler-items.jFiler-row { display: none; }				
				.edit_browse_file .jFiler-items.jFiler-row { display: none; }				
			</style>			
			<script>
				function img_remove(id)
				{
					var id = id;
					swal({
					      title: "Are you sure remove gallery image ?",
					      //text: "You will not be able to recover this imaginary file!",
					      type: "warning",
					      showCancelButton: true,
					      confirmButtonColor: '#DD6B55',
					      confirmButtonText: 'Yes',
					      closeOnConfirm: true
					    },
					    function(){
					      $.ajax({
							url: "{!! URL::to('user/profile/images/remove') !!}",
							type: 'get',
							data: {id:id},
							success: function(data)
							{
								location.reload(true);
								$('#user_images').html('');
								$('#user_images').html(data);
								$("#content-3").mCustomScrollbar({
									scrollButtons:{enable:true},
									theme:"3d-thick"
								});
								alert('Remove successfully');
							}
						});
					    });
					/*if (confirm('Are you sure remove gallery image ?')) {
						$.ajax({
							url: "{!! URL::to('user/profile/images/remove') !!}",
							type: 'get',
							data: {id:id},
							success: function(data)
							{
								location.reload(true);
								$('#user_images').html('');
								$('#user_images').html(data);
								$("#content-3").mCustomScrollbar({
									scrollButtons:{enable:true},
									theme:"3d-thick"
								});
								alert('Remove successfully');
							}
						});
					}*/
				}
			</script>
			<!---------------------------------->
			
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
			<script>
				$(document).ready(function() {
					$("#owl-demo").owlCarousel({
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
			<script>
				$( document ).ready(function() {
					$(".gallery_edit_ico").click(function(){
						$(".browse_gallery_btn").animate({
							height: 'toggle'
						});
						$(".close_image").toggle();
					});
				});
			</script>
			<!-- <script>
				$( document ).ready(function() {
					$(".edit").click(function(){
						$("#edit_image").animate({
							height: 'toggle'
						});
					});
				});
			</script> -->
			<script>
				$("#message1").click(function(){
					/*$("#message1").hide();
					$("#message2").show();*/
				});
				$(document).ready(function() {
					$('#hit5').click(function() {
						$("#message2").hide();
						$("#message1").show();
						$("#message1").html('');
						var message =$('#message').val();
						$("#message1").html(message);
						$.ajax({
							url: "{!! URL::to('user/profile/edit/message') !!}",
							type: 'get',
							data: {message:message},
							success: function(data)
							{
								//alert('Saved successfully');
								swal({
									title: "Saved successfully",
									//text: "Please click on ok button!",
									type: "success",
								});
								//$('#fieldAttribute').html(data);
							}
						});
					});
				});
				$(document).ready(function() {
					$('#hit5-cancel').click(function() {
						swal({
					      title: "Are you sure?",
					      //text: "You will not be able to recover this imaginary file!",
					      type: "warning",
					      showCancelButton: true,
					      confirmButtonColor: '#DD6B55',
					      confirmButtonText: 'Yes',
					      closeOnConfirm: true
					    },
					    function(){
					    	 $('#hit5').hide();
							$('#hit5-cancel').hide();
							$('#hit5-edit').show();
					     	$("#message2").hide();
							$("#message1").show();
					    });
						/*if (confirm('Are you sure ?')) {
							$("#message2").hide();
							$("#message1").show();
						}*/
					});
				});
			</script>
			<script>
				/*$("#phone1").click(function(){
					$("#phone1").hide();
					$("#phone2").show();
				});
				$("#instruction1").click(function(){
					$("#instruction1").hide();
					$("#instruction2").show();
				});*/
				/*$("#minimum_rate1").click(function(){
					$("#minimum_rate1").hide();
					$("#minimum_rate2").show();
				});*/
/*$("#rate_15m1").click(function(){
	$("#rate_15m1").hide();
	$("#rate_15m2").show();
});

$("#rate_30m1").click(function(){
	$("#rate_30m1").hide();
	$("#rate_30m2").show();
});

$("#rate_1h1").click(function(){
	$("#rate_1h1").hide();
	$("#rate_1h2").show();
});

$("#rate_1d1").click(function(){
	$("#rate_1d1").hide();
	$("#rate_1d2").show();
});*/


				/*$("#region1").click(function(){
					$("#region1").hide();
					$("#region2").show();
				});
				$("#age1").click(function(){
					$("#age1").hide();
					$("#age2").show();
				});*/
				/*$("#nationality1").click(function(){
					$("#nationality1").hide();
					$("#nationality2").show();
				});
				$("#canton1").click(function(){
					$("#canton1").hide();
					$("#canton2").show();
				});
				$("#weight1").click(function(){
					$("#weight1").hide();
					$("#weight2").show();
				});
				$("#height1").click(function(){
					$("#height1").hide();
					$("#height2").show();
				});
				$("#city1").click(function(){
					$("#city1").hide();
					$("#city2").show();
				});
				$("#ethnicity1").click(function(){
					$("#ethnicity1").hide();
					$("#ethnicity2").show();
				});
				$("#eyes1").click(function(){
					$("#eyes1").hide();
					$("#eyes2").show();
				});*/



				/*$("#hair1").click(function(){
					$("#hair1").hide();
					$("#hair2").show();
				});
				$("#breast_size1").click(function(){
					$("#breast_size1").hide();
					$("#breast_size2").show();
				});
				$("#pubic_hair1").click(function(){
					$("#pubic_hair1").hide();
					$("#pubic_hair2").show();
				});
				$("#location1").click(function(){
					$("#location1").hide();
					$("#location2").show();
				});
				$("#orientation1").click(function(){
					$("#orientation1").hide();
					$("#orientation2").show();
				});*/
/*				$(document).ready(function() {
					$('#hit1').click(function() {
						$("#phone2").hide(); $("#phone1").show();
						var phone =$('#phone').val();
						$("#phone1").html(''); $("#phone1").html(phone);
						$("#new_number").html(''); $("#new_number").html(phone);
						$("#instruction2").hide(); $("#instruction1").show();
						var instruction =$('#instruction').val();
						$("#instruction1").html(''); $("#instruction1").html(instruction);
						$("#minimum_rate2").hide(); $("#minimum_rate1").show();
						var minimum_rate =$('#minimum_rate').val();
						$("#minimum_rate1").html(''); $("#minimum_rate1").html(minimum_rate+' CHF');
						$("#rate_15m2").hide(); $("#rate_15m1").show();
						var rate_15m =$('#rate_15m').val();
						$("#rate_15m1").html(''); $("#rate_15m1").html(rate_15m+' CHF');

						$("#rate_30m2").hide(); $("#rate_30m1").show();
						var rate_30m =$('#rate_30m').val();
						$("#rate_30m1").html(''); $("#rate_30m1").html(rate_30m+' CHF');

						$("#rate_1h2").hide(); $("#rate_1h1").show();
						var rate_1h =$('#rate_1h').val();
						$("#rate_1h1").html(''); $("#rate_1h1").html(rate_1h+' CHF');

						$("#rate_1d2").hide(); $("#rate_1d1").show();
						var rate_1d =$('#rate_1d').val();
						$("#rate_1d1").html(''); $("#rate_1d1").html(rate_1d+' CHF');

						$("#new_price").html(''); $("#new_price").html(minimum_rate+' $/hr');
						$("#region2").hide(); $("#region1").show();
						var region =$('#region').val();
						$("#region1").html(''); $("#region1").html(region);
						$("#age2").hide(); $("#age1").show();
						var age =$('#age').val();
						$("#age1").html(''); $("#age1").html(age);
						$("#nationality2").hide(); $("#nationality1").show();
						var nationality =$('#nationality').val();
						$("#nationality1").html(''); $("#nationality1").html(nationality);
						$.ajax({
							url: "{!! URL::to('user/profile/details') !!}",
							type: 'get',
							data: {name:name, phone:phone, instruction:instruction, minimum_rate:minimum_rate, region:region, age:age, nationality:nationality, rate_15m:rate_15m, rate_30m:rate_30m, rate_1h:rate_1h, rate_1d:rate_1d},
							success: function(data)
							{
								alert('Saved successfully');
							}
						});
					});
				});*/

				$(document).ready(function() {
					$('#hit1-edit').click(function() {
						$('#hit1').show();
						$('#hit1-cancel').show();
						$('#hit1-edit').hide();
						$("#canton1").hide(); $("#canton2").show(); 
						$("#city1").hide(); $("#city2").show(); 
						$("#nationality1").hide(); $("#nationality2").show(); 
						$("#age1").hide(); $("#age2").show(); 
						$("#ethnicity1").hide(); $("#ethnicity2").show(); 
						$("#location1").hide(); $("#location2").show(); 
						$("#orientation1").hide(); $("#orientation2").show(); 
						$("#instruction1").hide(); $("#instruction2").show();
						$("#phone1").hide(); $("#phone2").show();
						$("#lang").hide(); $("#lang1").show();
						/*$("#region1").hide(); $("#region2").show(); 
						$("#weight1").hide(); $("#weight2").show(); 
						$("#height1").hide(); $("#height2").show(); 
						$("#eyes1").hide(); $("#eyes2").show(); 
						$("#hair1").hide(); $("#hair2").show(); 
						$("#breast_size1").hide(); $("#breast_size2").show(); 
						$("#pubic_hair1").hide(); $("#pubic_hair2").show(); */
					});
				});
				$(document).ready(function() {
					$('#hit5-edit').click(function() {
						$('#hit5').show();
						$('#hit5-cancel').show();
						$('#hit5-edit').hide();
						$("#message2").show();
						$("#message1").hide();
					});
				});

				$(document).ready(function() {
					$('#hit-edit').click(function() {
						$('#hit').show();
						$('#hit-cancel').show();
						$('#hit-edit').hide();
						$("#name1").hide();
						$("#name2").show();
						$("#new_number").hide();
					$("#new_number1").show();
					});
				});

				$(document).ready(function() {
					$('#hit1').click(function() {
						//alert('h');
						$("#canton2").hide(); $("#canton1").show();
						var canton =$('#canton').val();
						$("#canton1").html(''); $("#canton1").html(canton);
						$("#city2").hide(); $("#city1").show();
						var city =$('#city').val();
						$("#city1").html(''); $("#city1").html(city);
						$("#nationality2").hide(); $("#nationality1").show();
						var nationality =$('#nationality').val();
						$("#nationality1").html(''); $("#nationality1").html(nationality);
						$("#ethnicity2").hide(); $("#ethnicity1").show();
						var ethnicity =$('#ethnicity').val();
						$("#ethnicity1").html(''); $("#ethnicity1").html(ethnicity);
						$("#age2").hide(); $("#age1").show();
						var age =$('#age').val();
						$("#age1").html(''); $("#age1").html(age);
						$("#location2").hide(); $("#location1").show();
						var location =$('#location').val();
						$("#location1").html(''); $("#location1").html(location);
						$("#orientation2").hide(); $("#orientation1").show();
						var orientation =$('#orientation').val();
						$("#orientation1").html(''); $("#orientation1").html(orientation);
						$("#instruction2").hide(); $("#instruction1").show();
						var instruction =$('#instruction').val();
						$("#instruction1").html(''); $("#instruction1").html(instruction);
						$("#phone2").hide(); $("#phone1").show();
						var phone =$('#phone').val();
						$("#phone1").html(''); $("#phone1").html(phone);
						$("#new_number").html(''); $("#new_number").html(phone);
						$("#lang1").hide(); $("#lang").show();

						var language_id = [];
						//alert(language_id);
						$('input[name=language]:checked').map(function() {
							language_id.push($(this).val());
						});
						//alert(rating);
						var rating = [];
						$('.ratebox').map(function() {
							if($(this).attr('data-rating') != '')
							{
								rating.push($(this).attr('data-rating'));
							}
						});
						


						
						/*$("#weight2").hide(); $("#weight1").show();
						var weight =$('#weight').val();
						$("#weight1").html(''); $("#weight1").html(weight);
						$("#height2").hide(); $("#height1").show();
						var height =$('#height').val();
						$("#height1").html(''); $("#height1").html(height);
						$("#eyes2").hide(); $("#eyes1").show();
						var eyes =$('#eyes').val();
						$("#eyes1").html(''); $("#eyes1").html(eyes);
						$("#hair2").hide(); $("#hair1").show();
						var hair =$('#hair').val();
						$("#hair1").html(''); $("#hair1").html(hair);
						$("#breast_size2").hide(); $("#breast_size1").show();
						var breast_size =$('#breast_size').val();
						$("#breast_size1").html(''); $("#breast_size1").html(breast_size);
						$("#pubic_hair2").hide(); $("#pubic_hair1").show();
						var pubic_hair =$('#pubic_hair').val();
						$("#pubic_hair1").html(''); $("#pubic_hair1").html(pubic_hair);*/
						$.ajax({
							url: "{!! URL::to('user/profile/detailsclient') !!}",
							type: 'get',
							data: {canton:canton, city:city, nationality:nationality, ethnicity:ethnicity, age:age, location:location, orientation:orientation, instruction:instruction , phone:phone, language_id:language_id,rating:rating},
							success: function(data)
							{
								alert('Saved successfully');
								$('#hit1').hide();
								$('#hit1-cancel').hide();
								$('#hit1-edit').show();
								$("#lang").show();
								$("#lang1").hide();
								swal({
									title: "Saved successfully",
									//text: "Please click on ok button!",
									type: "success",
								});
								window.location.reload();
								
							}
						});
					});
				});

				/*$(document).ready(function() {
					$('#hit1-cancel').click(function() {
						if (confirm('Are you sure ?')) {
							$("#phone2").hide(); $("#phone1").show();
							$("#instruction2").hide(); $("#instruction1").show();
							$("#minimum_rate2").hide(); $("#minimum_rate1").show();
							$("#rate_15m2").hide(); $("#rate_15m1").show();
							$("#rate_30m2").hide(); $("#rate_30m1").show();
							$("#rate_1h2").hide(); $("#rate_1h1").show();
							$("#rate_1d2").hide(); $("#rate_1d1").show();
							$("#region2").hide(); $("#region1").show();
							$("#age2").hide(); $("#age1").show();
							$("#nationality2").hide(); $("#nationality1").show();
						}
					});
				});*/
				$(document).ready(function() {
					$('#hit1-cancel').click(function() {
						swal({
					      title: "Are you sure?",
					      //text: "You will not be able to recover this imaginary file!",
					      type: "warning",
					      showCancelButton: true,
					      confirmButtonColor: '#DD6B55',
					      confirmButtonText: 'Yes',
					      closeOnConfirm: true
					    },
					    function(){
					      $('#hit1').hide();
							$('#hit1-cancel').hide();
							$('#hit1-edit').show();
							$("#canton2").hide(); $("#canton1").show();
							$("#city2").hide(); $("#city1").show();
							$("#nationality2").hide(); $("#nationality1").show();
							$("#ethnicity2").hide(); $("#ethnicity1").show();
							$("#age2").hide(); $("#age1").show();
							$("#location2").hide(); $("#location1").show();
							$("#orientation2").hide(); $("#orientation1").show();
							$("#instruction2").hide(); $("#instruction1").show();
							$("#phone2").hide(); $("#phone1").show();
							$("#lang1").hide(); $("#lang").show();
					    });
					    window.location.reload();
						/*if (confirm('Are you sure ?')) {
							$('#hit1').hide();
							$('#hit1-cancel').hide();
							$('#hit1-edit').show();
							$("#canton2").hide(); $("#canton1").show();
							$("#city2").hide(); $("#city1").show();
							$("#nationality2").hide(); $("#nationality1").show();
							$("#ethnicity2").hide(); $("#ethnicity1").show();
							$("#age2").hide(); $("#age1").show();
							$("#location2").hide(); $("#location1").show();
							$("#orientation2").hide(); $("#orientation1").show();
							$("#instruction2").hide(); $("#instruction1").show();
							$("#phone2").hide(); $("#phone1").show();
							$("#langClient1").hide(); $("#langClient").show();
							/*$("#region2").hide(); $("#region1").show();
							$("#weight2").hide(); $("#weight1").show();
							$("#height2").hide(); $("#height1").show();
							$("#eyes2").hide(); $("#eyes1").show();
							$("#hair2").hide(); $("#hair1").show();
							$("#breast_size2").hide(); $("#breast_size1").show();
							$("#pubic_hair2").hide(); $("#pubic_hair1").show();

						}*/
					});
				});

			</script>
			
			<script>
				$(document).ready(function() {
					$('#hit3').click(function() {
						var service_id = [];
						$('input[name=services]:checked').map(function() {
							service_id.push($(this).val());
						});
						$.ajax({
							url: "{!! URL::to('user/profile/services') !!}",
							type: 'get',
							data: {service_id:service_id},
							success: function(data)
							{
								//alert('Saved successfully');
								swal({
									title: "Saved successfully",
									//text: "Please click on ok button!",
									type: "success",
								});
								//$('#fieldAttribute').html(data);
							}
						});
					});
				});
			</script>
			
			<script>
				/*$(document).ready(function() {
					$('#hit4').click(function() {
						var language_id = [];
						//alert(language_id);
						$('input[name=language]:checked').map(function() {
							language_id.push($(this).val());
						});
						//alert(rating);
						var rating = [];
						$('.ratebox').map(function() {
							if($(this).attr('data-rating') != '')
							{
								rating.push($(this).attr('data-rating'));
							}
						});
						//alert(rating);
						$.ajax({
							url: "{!! URL::to('user/profile/languages') !!}",
							type: 'get',
							data: {language_id:language_id,rating:rating},
							success: function(data)
							{
								alert('Saved successfully');
								//$('#fieldAttribute').html(data);
							}
						});
					});
				});*/
			</script>
			<style>
				.edit_browse_file1 .jFiler-items.jFiler-row { display: none; }				
				.edit_image_cover .jFiler-items.jFiler-row { display: none; }				
			</style>
			<!-- We need the raterater stylesheet -->
			<link href="{{ URL::asset('css/raterater.css') }}" rel="stylesheet"/>

			<style>
			/* Override star colors */
			.raterater-bg-layer {
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
			}
			</style>
			<!---------------------------------->
<!-- We need jquery and raterater.jquery.js -->
<script src="{{ URL::asset('js/raterater.jquery.js') }}"></script>

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
        allowChange: true,
        starWidth: 20,
        spaceWidth: 5,
        numStars: 5
    } );
});

</script>
		@endif
	</div><!-- row -->
	
@endsection