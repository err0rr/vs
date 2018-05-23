@extends('frontend.layouts.master')

@section('content')
    <div class="">
	 @if($user->user_type=="Escort")
		 <div class="imgcrousel">
<div id="owl-demo">
          
  <div class="item"><img src="{!! URL::to('img/profile_slider_img-1.jpg') !!}" alt="Owl Image"></div>
  <div class="item"><img src="{!! URL::to('img/profile_slider_img-2.jpg') !!}" alt="Owl Image"></div>
  <div class="item"><img src="{!! URL::to('img/profile_slider_img-3.jpg') !!}" alt="Owl Image"></div>
  <div class="item"><img src="{!! URL::to('img/profile_slider_img-1.jpg') !!}" alt="Owl Image"></div>
  <div class="item"><img src="{!! URL::to('img/profile_slider_img-2.jpg') !!}" alt="Owl Image"></div>
  <div class="item"><img src="{!! URL::to('img/profile_slider_img-3.jpg') !!}" alt="Owl Image"></div>
  <div class="item"><img src="{!! URL::to('img/profile_slider_img-1.jpg') !!}" alt="Owl Image"></div>
  <div class="item"><img src="{!! URL::to('img/profile_slider_img-2.jpg') !!}" alt="Owl Image"></div>
 
</div>
</div>

<div class="container">
<div class="row profilerow">
<div class="profile">
<div class="col-md-4">
<img src="{!! URL::to('img/profile_main.jpg') !!}">
<span class="edit"><img src="{!! URL::to('img/edit.png') !!}"></span>
<p class="review_profile1"><i class="fa fa-heart-o" aria-hidden="true"></i>  <i class="fa fa-phone" aria-hidden="true"></i>  <i class="fa fa-comments-o" aria-hidden="true"></i></p>
</div>
<div class="col-md-8 user_detail">
<h1 class="test"><span>Barbiq Nate</span></h1>
<span class="barbiq_edit"><i class="fa fa-pencil" aria-hidden="true"></i></span>
<p class="test"><span>French Inspired Bistyro and Wine Bar</span></p>
<p class="review_profile"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i>  (1) <b><i class="fa fa-phone" aria-hidden="true"></i> (212)-595-0303</b></p>
<h5>Rate &nbsp; &nbsp; &nbsp; : <span class="test" style="width:20%;">410 CHF</span></h5>
<div class="barbiq_save_btn">
 <button class="btn save_btn">Save</button>
 <button class="btn save_btn">Cancel</button>
</div>
</div>
</div>
<div class="about">
<div class="col-md-12">
<h5>ABOUT HER</h5>
<p class="test1"><span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</span></p>
<div class="barbiq_save_btn">
 <button class="btn save_btn">Save</button>
 <button class="btn save_btn">Cancel</button>
</div>
</div>
</div>
<div class="services">
<div class="col-md-8 list_view">
<h5>Services</h5>
<ul id="content-1">
<li><input type="checkbox" id="list1" /><label for="list1"><span>CUM ON BODY</span></li>
<li><input type="checkbox" id="list2" /><label for="list2"><span>Gg</span></li>
<li><input type="checkbox" id="list3" /><label for="list3"><span>Blowjob With Condom</span></li>
<li><input type="checkbox" id="list4" /><label for="list4"><span>French Kiss</span></li>
<li><input type="checkbox" id="list5" /><label for="list5"><span>Lesbo Show</span></li>
<li><input type="checkbox" id="list6" /><label for="list6"><span>Anal</span></li>
<li><input type="checkbox" id="list7" /><label for="list7"><span>Sex Toys</span></li>
<li><input type="checkbox" id="list8" /><label for="list8"><span>Striptease</span></li>
<li><input type="checkbox" id="list9" /><label for="list9"><span>Travelling</span></li>
<li><input type="checkbox" id="list10" /><label for="list10"><span>Tantric Massage</span></li>
<li><input type="checkbox" id="list11" /><label for="list11"><span>Prostate Massage</span></li>
<li><input type="checkbox" id="list12" /><label for="list12"><span>Cunnilingus</span></li>
<li><input type="checkbox" id="list13" /><label for="list13"><span>Blow Job</span></li>
<li><input type="checkbox" id="list14" /><label for="list14"><span>Striptease</span></li>
<li><input type="checkbox" id="list15" /><label for="list15"><span>Travelling</span></li>
<li><input type="checkbox" id="list16" /><label for="list16"><span>Tantric Massage</span></li>
<li><input type="checkbox" id="list17" /><label for="list17"><span>Prostate Massage</span></li>
<li><input type="checkbox" id="list18" /><label for="list18"><span>Cunnilingus</span></li>
<li><input type="checkbox" id="list19" /><label for="list19"><span>Blow Job</span></li>
</ul>
<div class="barbiq_save_btn">
 <button class="btn save_btn">Save</button>
 <button class="btn save_btn">Cancel</button>
</div>
</div>
<div class="col-md-4 calender_block">
 <h5>Make Booking</h5>
 <img src="{!! URL::to('img/calender.jpg') !!}">
 <a href="#">BOOK NOW</a>
</div>
</div>


<div class="personal_detail">
<div class="col-md-5">
<div class="detail_block">
<h5>Details</h5>
<p><b class="detail_text">Phone</b><b class="dot"> : </b><b class="per_det test"><span>(222)-987-6547</span></b></p>
<p><b class="detail_text">Instruction</b><b class="dot"> :  </b><b class="per_det test"><span>Call,SMS</span></b></p>
<p><b class="detail_text">Min. Rate</b><b class="dot"> : </b><b class="per_det test"><span>200 CHF</span></b></p>
</div>
<div class="barbiq_save_btn">
 <button class="btn save_btn">Save</button>
 <button class="btn save_btn">Cancel</button>
</div>
</div>
<div class="col-md-3"></div>
<div class="col-md-4">
<div class="language_box" id="content-2">
<h5>LANGUAGE KNOWN</h5>
<p><input type="checkbox" id="test1" /><label for="test1"></label><img src="http://cdn.countryflags.com/thumbs/spain/flag-400.png" class="flag"> Spanish</p>
<p><input type="checkbox" id="test2" /><label for="test2"></label><img src="http://orig06.deviantart.net/4954/f/2009/345/5/c/union_flag_icon_by_twila101.png" class="flag"> English</p>
<p><input type="checkbox" id="test3" /><label for="test3"></label><img src="http://cerrone.me/wp-content/uploads/2012/11/Italy-Flag-icon-254x158.png" class="flag"> Italian</p>
<p><input type="checkbox" id="test4" /><label for="test4"></label><img src="http://cdn.countryflags.com/thumbs/spain/flag-400.png" class="flag"> Spanish</p>
<p><input type="checkbox" id="test5" /><label for="test5"></label><img src="http://orig06.deviantart.net/4954/f/2009/345/5/c/union_flag_icon_by_twila101.png" class="flag"> English</p>
<p><input type="checkbox" id="test6" /><label for="test6"></label><img src="http://cerrone.me/wp-content/uploads/2012/11/Italy-Flag-icon-254x158.png" class="flag"> Italian</p>
</div>
<div class="barbiq_save_btn">
 <button class="btn save_btn">Save</button>
 <button class="btn save_btn">Cancel</button>
</div>
</div>
</div>

<div class="review">
<div class="col-md-6">
<div class="review_bg_block">
  <h5>REVIEW</h5>
  <div class="reveiew_first">
  <div class="col-md-2">
    <img src="http://1ofdmq2n8tc36m6i46scovo2e.wpengine.netdna-cdn.com/wp-content/uploads/2014/04/Steven_Hallam-slide.jpg">
	<p class="user_name">George</p>
  </div>
  <div class="col-md-10">
   <h4>"Best Ever Bunmch In Pizza Parlour!"</h4>
   <p class="review_profile"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i><b>on Novemeber 6, 2015</b></p>
   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
   </div>
  </div>
  <div class="reveiew_first">
  <div class="col-md-2">
    <img src="http://1ofdmq2n8tc36m6i46scovo2e.wpengine.netdna-cdn.com/wp-content/uploads/2014/04/Steven_Hallam-slide.jpg">
	<p class="user_name">George</p>
  </div>
  <div class="col-md-10">
   <h4>"Best Ever Bunmch In Pizza Parlour!"</h4>
   <p class="review_profile"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i><b>on Novemeber 6, 2015</b></p>
   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
   </div>
  </div>
  
  <div class="reveiew_first" style="border-bottom:none">
  <div class="col-md-2">
    <img src="http://1ofdmq2n8tc36m6i46scovo2e.wpengine.netdna-cdn.com/wp-content/uploads/2014/04/Steven_Hallam-slide.jpg">
	<p class="user_name">George</p>
  </div>
  <div class="col-md-10">
   <h4>"Best Ever Bunmch In Pizza Parlour!"</h4>
   <p class="review_profile"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i><b>on Novemeber 6, 2015</b></p>
   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
   </div>
  </div>
</div>
</div>
<div class="col-md-6">
 <div class="review_bg_block">
  <h5 class="gallery_heading">GALLERY</h5>
  <span class="gallery_edit_ico"><img src="{!! URL::to('img/edit_gallery.png') !!}"></span>
    <div class="browse_gallery_btn">
      <button class="btn browse">Browse</button>
       <input type="file" class="browse_file">
	   <div class="gallery_submit">
	     <button class="btn save_btn">Save</button>
         <button class="btn save_btn">Cancel</button>
	   </div>
  </div>
  <div class="gallery">
  <ul>
  <li><div class="hovereffect">
	<img src="{!! URL::to('img/galery_img-1.jpg') !!}">
	<div class="overlay">
	  <a class="info" href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
	</div>
  </div>
  <span class="close_image"><i class="fa fa-times" aria-hidden="true"></i></span>
  </li>
     <li><div class="hovereffect">
        <img src="{!! URL::to('img/gallery_img-2.jpg') !!}">
        <div class="overlay">
          <a class="info" href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
        </div>
    </div>
	<span class="close_image"><i class="fa fa-times" aria-hidden="true"></i></span>
	</li>
     <li><div class="hovereffect">
        <img src="{!! URL::to('img/galery_img-1.jpg') !!}">
        <div class="overlay">
          <a class="info" href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
        </div>
    </div>
	<span class="close_image"><i class="fa fa-times" aria-hidden="true"></i></span>
	</li>
   <li><div class="hovereffect">
        <img src="{!! URL::to('img/gallery_img-3.jpg') !!}">
        <div class="overlay">
          <a class="info" href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
        </div>
    </div>
	<span class="close_image"><i class="fa fa-times" aria-hidden="true"></i></span>
	</li>
	 <li><div class="hovereffect">
        <img src="{!! URL::to('img/gallery_img-3.jpg') !!}">
        <div class="overlay">
          <a class="info" href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
        </div>
    </div>
	<span class="close_image"><i class="fa fa-times" aria-hidden="true"></i></span>
	</li>
	</ul>
   </div>
  </div>
  </div>
 </div>
</div>
</div>
</div>

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
 //window.onload = function() {
  //document.getElementById("test").onclick = function(event) {
$(".test").click(function(event){  
  var span, input, text;

    // Get the event (handle MS difference)
    event = event || window.event;

    // Get the root element of the event (handle MS difference)
    span = event.target || event.srcElement;

    // If it's a span...
    if (span && span.tagName.toUpperCase() === "SPAN") {
      // Hide it
      span.style.display = "none";
      
      // Get its text
      text = span.innerHTML;

      // Create an input
      input = document.createElement("input");
      input.type = "text";
      input.size = Math.max(text.length / 4 * 3, 4);
      span.parentNode.insertBefore(input, span);

      // Focus it, hook blur to undo
      input.focus();
      input.onblur = function() {
        // Remove the input
        span.parentNode.removeChild(input);

        // Update the span
        span.innerHTML = input.value;
           if(input.value==""){
		   span.innerHTML="Barbiq Nate";
		   }
        // Show the span again
        span.style.display = "";
      };
    }
	
  });
//};
</script>
<script>
 //window.onload = function() {
  //document.getElementById("test").onclick = function(event) {
$(".test1").click(function(event){  
  var span, input, text;

    // Get the event (handle MS difference)
    event = event || window.event;

    // Get the root element of the event (handle MS difference)
    span = event.target || event.srcElement;

    // If it's a span...
    if (span && span.tagName.toUpperCase() === "SPAN") {
      // Hide it
      span.style.display = "none";
      
      // Get its text
      text = span.innerHTML;

      // Create an input
      input = document.createElement("textarea");
      input.type = "text";
      input.size = Math.max(text.length / 4 * 3, 4);
      span.parentNode.insertBefore(input, span);

      // Focus it, hook blur to undo
      input.focus();
      input.onblur = function() {
        // Remove the input
        span.parentNode.removeChild(input);

        // Update the span
        span.innerHTML = input.value;
           if(input.value==""){
		   span.innerHTML="Lorem Ipsum is simply dummy text of the printing and typesetting industry.";
		   }
        // Show the span again
        span.style.display = "";
      };
    }
	
  });
//};
</script>


	@else

        <div class="dashboard_block">

            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('navs.frontend.dashboard') }}</div>

                <div class="panel-body">
                    <div role="tabpanel">

                        <!-- Nav tabs -->
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
                                        <td><img src="{{ $user->picture }}" class="user-profile-image" /></td>
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
                                            {{ link_to_route('frontend.user.profile.edit', trans('labels.frontend.user.profile.edit_information'), [], ['class' => 'btn btn-primary btn-xs']) }}

                                            @if ($user->canChangePassword())
                                                {{ link_to_route('auth.password.change', trans('navs.frontend.user.change_password'), [], ['class' => 'btn btn-warning btn-xs']) }}
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div><!--tab panel profile-->

                        </div><!--tab content-->

                    </div><!--tab panel-->

                </div><!--panel body-->

            </div><!-- panel -->

        </div><!-- col-md-10 -->
	@endif
    </div><!-- row -->
@endsection