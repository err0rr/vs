@extends('frontend.layouts.master')
@section('content')
	<?php
	/* $name="";
	if(isset($_REQUEST['name']) && $_REQUEST['name']!=""){
		$name=$_REQUEST['name'];
	}*/
	$canton="";
	if(isset($_REQUEST['canton']) && $_REQUEST['canton']!=""){
		$canton=$_REQUEST['canton'];
		//echo $canton; die;
	}
	$region="";
	if(isset($_REQUEST['region']) && $_REQUEST['region']!=""){
		$region=$_REQUEST['region'];
		//echo $region; die;
	}
	$ages="";
	if(isset($_REQUEST['age']) && $_REQUEST['age']!=""){
		$ages=$_REQUEST['age'];
	}
	/*$nationalities="";
	if(isset($_REQUEST['nationality']) && $_REQUEST['nationality']!=""){
		$nationalities=$_REQUEST['nationality'];
	} */
	$sexuality="";
	if(isset($_REQUEST['sexuality']) && $_REQUEST['sexuality']!=""){
		$sexualitys=$_REQUEST['sexuality'];
		//echo $sexualitys; die;
	} 
	?>
    <div class="container">
		<div class="row">
			<div class="fiter_box">
				<h2>GET BY YOUR CHOICE</h2>
				<?php /* <div class="col-md-3 col-sm-3">
					<input class="form-control select_box" type="text" name="name" placeholder="Search by Name" id="name" value="{!! $name !!}" onkeyup="filterdata();">
				</div>
				 */?>
				 <div class="col-md-3 col-sm-3">
					<select class="form-control select_box target" name="canton" id="canton" onchange="canton(this);">
						<option value="0">All Canton</option>
						@foreach($canton1 as $v)
							<option value="{{$v->name}}" <?php if($canton == $v->name) { echo "selected=selected"; } ?>>{{$v->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-3 col-sm-3" id="regionlist">
				       <select class="form-control select_box target" name="region" id="region">
		                   <option value="">All Region</option>
		               </select>
				</div>
				<div class="col-md-3 col-sm-3">
					<select class="form-control select_box target" name="age" id="age">
						<option value="0">Age</option>
						@foreach($age as $v)
						<option value="{{$v}}" <?php if($ages == $v) { echo "selected=selected"; } ?> >{{$v}}</option>
						@endforeach
					</select>
				</div>
				<?PHP /*<div class="col-md-3 col-sm-3">
					<select class="form-control select_box target" name="nationality" id="nationality">
						<option value="0">Nationality</option>
						@foreach($country as $v)
						<option value="{{$v->countryName}}" <?php if($nationalities == $v->countryName) { echo "selected=selected"; } ?>>{{$v->countryName}}</option>
						@endforeach
					</select>
				</div>*/ ?>
				<div class="col-md-3 col-sm-3">
					<select class="form-control select_box target" name="sexuality" id="sexuality">
						<option value="0">Sexuality type</option>
						<option value="Gay" <?php if($sexualitys == 'Gay') { echo "selected=selected"; } ?>>Gay</option>
						<option value="Straight"  <?php if($sexualitys == 'Straight') { echo "selected=selected"; } ?>>Straight</option>
						<option value="Trans"  <?php if($sexualitys == 'Trans') { echo "selected=selected"; } ?>>Trans</option>
						<option value="Other"  <?php if($sexualitys == 'Other') { echo "selected=selected"; } ?>>Other</option>
					</select>
				</div>
			</div>

			<div class="image-box" id="getdata">
				<h1>MOST POPULAR</h1>
				@if(count($get_all_escort)>0)
				@foreach($get_all_escort as $k=>$escort)

				<div class="col-md-4 col-sm-4">
					<div class="hovereffect">
						<img src="{!! URL::to('img/users/'.$escort->photo)!!}" onerror="this.src='{{ URL::to('img/noimage.jpg') }}';">
						<?php $data = App::make("App\Http\Controllers\Frontend\FrontendController")->escortRating($escort->user_id); 
						//print_r($data); ?>
						<div class="text-border">
							<p class="icon_p1"><!-- <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> -->
							<?php //print_r($data['user_rating_sum']->sum);; die; 
								$counts = count($data['user_review_arr']); ?>
								@if($counts>0)
									<?php $avg_rat =  $data['user_rating_sum']->sum/$counts;
									$avg_rating =  number_format($avg_rat); ?>
									@for($i=1; $i<=$avg_rating; $i++)
										<i class="fa fa-star" aria-hidden="true"></i>
									@endfor
									@for($i=$avg_rating; $i<5; $i++)
										<i class="fa fa-star-o" aria-hidden="true"></i>
									@endfor
									<!-- ({!! number_format($avg_rat,'1') !!}) -->
								@else
									<i class="fa fa-star-o" aria-hidden="true"></i> 
									<i class="fa fa-star-o" aria-hidden="true"></i> 
									<i class="fa fa-star-o" aria-hidden="true"></i> 
									<i class="fa fa-star-o" aria-hidden="true"></i> 
									<i class="fa fa-star-o" aria-hidden="true"></i>
								@endif
							</p>
							<p class="icon_p2"><i class="fa fa-heart-o" aria-hidden="true"></i>  <i class="fa fa-phone" aria-hidden="true"></i>  <i class="fa fa-comments-o" aria-hidden="true"></i></p>
						</div>
						<div class="overlay">
							<p>{{strtoupper($escort->name)}}</p>
							<p>{{strtoupper($escort->canton)}}</p>
							<p>AGE : {{$escort->age}}</p>
							<p>RATE : {{$escort->currency." ".$escort->minimum_rate}}</p>
							<a class="info" href="{!! URL::to('cast/'.$escort->user_id.'-' .$escort->name)!!}"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
						</div>
					</div>
				</div>
				@endforeach
				@else
				<p>No More Record(S)</p>
				@endif


				<?php /*?><div class="col-md-4 col-sm-4">
					<div class="hovereffect">
						<img src="{!! URL::to('img/model-2.jpg')!!}">
						<div class="text-border">
							<p class="icon_p1"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i></p>
							<p class="icon_p2"><i class="fa fa-heart-o" aria-hidden="true"></i>  <i class="fa fa-phone" aria-hidden="true"></i>  <i class="fa fa-comments-o" aria-hidden="true"></i></p>
						</div>
						<div class="overlay">
							<p>LEWKIE BEFR</p>
							<p>MADFNFG . QUIEDR</p>
							<p>AGE : 23</p>
							<p>RATE : 120$/hr</p>
							<a class="info" href="{!! URL::to('cast/xyz')!!}"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
						</div>
					</div>
				</div><?php */?>	
					
			</div>
		</div>
	</div>
	<input type="hidden" name ="gropcount" id="gropcount" value="">
       <div class="animation_image" style="display:none;" align="center"><img src="{{ asset('img/I4RPc.gif') }}"></div>
	<div class="buttontotop">
		<div class="col-md-12">
			<a href="javascript:;" class="view_more" id="viewmoredate">VIEW MORE</a>
			<!--<a href="javascript:;" class="view_more_img"><img src="{!! URL::to('img/arrow.png')!!}"></a>-->
		</div>
	</div>
<?php $total_groups= ceil($total/10);?>
<script>
	function canton(name)
	{ 
		//alert(name);
		$.ajax({                   
            url: '{{ route('getCanton') }}',     
            type: 'get', 
            data: {name:name.value},
            dataType: 'json', 
            success: function(data)         
            { 
            	//alert(data);
            	$('#regionlist').html();
            	$('#regionlist').html(data);
            	$('#regionlist').show();
            } 
        });
	} 
</script>
<script>
var track_load = 1; 
var loading  = false; 
var total_groups = <?php echo $total_groups;?>;	
function filterdata()
{
	var canton=$('#canton option:selected').val(); 
	//var name=$('#name').val(); 
	var region=$('#region option:selected').val(); 
	var age=$('#age option:selected').val(); 
	alert(age);
	// var nationality=$('#nationality option:selected').val(); 
	var sexuality=$('#sexuality option:selected').val(); 
	//var dataString = 'name='+name+'&region='+region+'&age='+age+'&nationality='+nationality;
	var dataString = 'canton='+canton+'&region='+region+'&age='+age+'&sexuality='+sexuality;
	window.location.href = app_url+"/filterdata?"+dataString;			
}
$(".target" ).change(function() {
	var canton=$('#canton option:selected').val();
	//var name=$('#name').val(); 
	var region=$('#region option:selected').val(); 
	var age=$('#age option:selected').val(); 
	alert(age);
	//var nationality=$('#nationality option:selected').val(); 
	var sexuality=$('#sexuality option:selected').val(); 
	//var dataString = 'name='+name+'&region='+region+'&age='+age+'&nationality='+nationality;
	var dataString = 'canton='+canton+'&region='+region+'&age='+age+'&sexuality='+sexuality;
	window.location.href = app_url+"/filterdata?"+dataString;			
});
$(document).ready(function() {
	var canton = "<?php echo $canton;?>";
	var region = "<?php echo $region;?>";
	alert(canton);
	$.ajax({
		type:"get",
		url: app_url+"/canton",
		data: {canton:canton, region:region},
		success:function(data)
		{
			$('#region').html('');
			$('#region').html(data);
		}			
	});
	$('#viewmoredate').click(function() {
	var gropcount =$("#gropcount").val();
		if(gropcount)
	    {
	        total_groups= parseInt(gropcount);
	    }
	    if($(window).scrollTop() + $(window).height() == $(document).height()) 
	    {
	    console.log(total_groups);
	        if(track_load <= total_groups && loading==false) 
	        {       
	            loading = true; 
	            $('.animation_image').show();            
	            $.get("{!!URL::to('getfilterdata')!!}",{'group_no': track_load}, function(data){
	                $("#getdata").append(data); 
	                $('.animation_image').hide(); 
	                track_load++; 
	                loading = false;
	            }).fail(function(xhr, ajaxOptions, thrownError) { 
	                alert(thrownError); 
	                $('.animation_image').hide();
	                loading = false;
	            });
	        }
	    }
	});
});
</script>

 
<style>
.fiter_box{
	margin-top: 80px;
}
.slider{
	display:none;
}
</style>
@endsection