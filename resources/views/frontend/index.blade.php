
@extends('frontend.layouts.master')

@section('content')
<style type="text/css">
	#loadinggif{
position: absolute;
z-index: 2;
width: 90px;
left: 0;
right: 0;
margin: auto;
}

#loadinggif img{width: 90px;}
</style>
    <div class="container">
		<div class="row">
			<div id="loadinggif" style="display: none;">
				<img src="{!! URL::to('/img/giphy.gif') !!}">
			</div>
			<div class="fiter_box">
				<h2>GET BY YOUR CHOICE</h2>
				<?php /*<!-- <div class="col-md-3 col-sm-3">
					<input class="form-control select_box" type="text" name="name" placeholder="Search by Name" id="name" onkeyup="filterdata();">
				</div> */?>
				<div class="col-md-3 col-sm-3">
					<select class="form-control select_box target" name="canton" id="canton" onchange="canton(this);">
						<option value="0">All Canton</option>
							
							@foreach($canton as $v)
								<option value="{{$v->name}}">{{$v->name}}</option>
							@endforeach
					</select>
				</div>
				
				<div class="col-md-3 col-sm-3" id="regionlist">
				       <select class="form-control select_box target" name="region" id="region">
		                   <option value="0">All Region</option>
		               </select>
				</div>
				<div class="col-md-3 col-sm-3">
					<select class="form-control select_box target" name="age" id="age">
						<option value="0">Age</option>
						@foreach($age as $v)
						<option value="{{$v}}">{{$v}}</option>
						@endforeach
					</select>
				</div>
				<?php /*<div class="col-md-3 col-sm-3">
					<select class="form-control select_box target" name="nationality" id="nationality">
						<option value="0">Nationality</option>
						@foreach($country as $v)
						<option value="{{$v->countryName}}">{{$v->countryName}}</option>
						@endforeach
					</select>
				</div> */?>
				<div class="col-md-3 col-sm-3">
					<select class="form-control select_box target" name="sexuality" id="sexuality">
						<option value="0">Sexuality type</option>
						<option value="Gay">Gay</option>
						<option value="Straight">Straight</option>
						<option value="Trans">Trans</option>
						<option value="Other">Other</option>
					</select>
				</div>

			</div>

			<div class="image-box" id="getdata">
				<h1>MOST POPULAR</h1>
				@if(count($get_all_escort)>0)
				@foreach($get_all_escort as $k=>$escort)

				<div class="col-md-4 col-sm-4 popular_list">
				  <a href="{!! URL::to('cast/'.$escort->user_id.'-' .$escort->name)!!}">
					<div class="hovereffect">
						<img src="{!! URL::to('img/users/'.$escort->photo)!!}" onerror="this.src='{{ URL::to('img/noimage.jpg') }}';">
						<?php $data = App::make("App\Http\Controllers\Frontend\FrontendController")->escortRating($escort->user_id); 
						//print_r($data); ?>
						<div class="text-border">
							<!--<p class="icon_p1"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> -->
							<?php //print_r($data['user_rating_sum']->sum);; die; 
							/*	$counts = count($data['user_review_arr']); ?>
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
							</p><?php */?>
							<!-- <p class="icon_p2"><i class="fa fa-heart-o" aria-hidden="true"></i>  <i class="fa fa-phone" aria-hidden="true"></i>  <i class="fa fa-comments-o" aria-hidden="true"></i>
							</p> -->
						</div>

						<div class="overlay">
							<p>{{strtoupper($escort->name)}} <!-- <img src="{!! URL::to('img/chat.svg') !!}" alt="" title="" style="height: 30px; width: 30px;"> --> </p>
							<p>{{strtoupper($escort->canton)}} </p>
							<p>AGE : {{$escort->age}}</p>
							<p>RATE : {{$escort->currency." ".$escort->rate_1h}}CHF</p>
							<p class="icon_p1 mobile_star_rate"><!-- <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i>-->
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
							<!-- <span class="info"><i class="fa fa-arrow-right" aria-hidden="true"></i></span> -->
						</div>
					</div>
					</a>
					<div class="escort_detail_mobile">
					 <p>{{strtoupper($escort->name)}}</p>
					 <p>{{strtoupper($escort->canton)}} <span>{{strtoupper($escort->region)}}</span></p>
				  </div>
				</div>
				@endforeach
				@else
				<p>No More Record(S)</p>
				@endif

				<?php /*?>
				<div class="col-md-4 col-sm-4">
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
							<a class="info" href="{!! URL::to('cast/16-jhon')!!}"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
						</div>
					</div>
				</div><?php */?>

			</div>
		</div>
	</div>
	<input type="hidden" name ="gropcount" id="gropcount" value="">
       <div class="animation_image" style="display:none" align="center"><img src="{{ asset('img/ajax-loader.gif') }}"></div>
	<!-- <div class="buttontotop">
		<div class="col-md-12">
			<a href="javascript:;" class="view_more" id="viewmoredate">VIEW MORE</a>
			
		</div>
	</div> -->
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
	var track_load = 1; //total loaded record group(s)
    var loading  = false; //to prevents multipal ajax loads
	var total_groups = <?php echo $total_groups;?>;
		function filterdata()
		{
			//var name=$('#name').val(); 
			var canton=$('#canton').val()
			var region=$('#region').val(); 
			var age=$('#age').val(); 
			alert(canton);
			//alert(region);
			//var nationality=$('#nationality').val(); 
			var sexuality=$('#sexuality option:selected').val(); 
			//var dataString = 'name='+name+'&region='+region+'&age='+age+'&nationality='+nationality;
			var dataString = 'canton='+canton+'&region='+region+'&age='+age+'&sexuality='+sexuality;
			window.location.href = app_url+"/filterdata?"+dataString;
			/*$.ajax({
				type:"get",
				url: app_url+"/filterdata",
				data: dataString,
				success:function(data)
				{
					$("#data").html(data);
					loading.hide();	
					$(document).ready(function(){ 
						$( "#dialog-message" ).dialog({
							modal: true,
							buttons: {
								Ok: function() {
									window.location.reload();
								}
							}
						});
					});
					
				}
			getdata}); */
		}
		$(document).on('change','.target',function() {
		//$(".target" ).change(function() {
			//alert('hii');
			$('#loadinggif').show();
			//alert('fas');
			var canton=$('#canton option:selected').val()
			//var name=$('#name').val(); 
			var region=$('#region option:selected').val(); 
			var age=$('#age option:selected').val(); 
			//alert(region);
			//var nationality=$('#nationality option:selected').val(); 
			var sexuality=$('#sexuality option:selected').val(); 
			//var dataString = 'name='+name+'&region='+region+'&age='+age+'&nationality='+nationality;
			//var dataString = 'canton='+canton+'&region='+region+'&age='+age+'&sexuality='+sexuality;
			var dataString = 'canton='+canton+'&region='+region+'&age='+age+'&sexuality='+sexuality;
			//window.location.href = app_url+"/filterdata?"+dataString;	
			//alert(canton);
			//alert(region);
			$.ajax({
				type:"get",
				url: app_url+"/filterdata?"+dataString,
				//data: dataString,
				success:function(data)
				{
					$("#getdata").html(data);
					$('#loadinggif').hide();
					loading.hide();	
					$(document).ready(function(){ 
						$( "#dialog-message" ).dialog({
							modal: true,
							buttons: {
								Ok: function() {
									window.location.reload();
								}
							}
						});
					});
					
				}
			});		
		});
		$(document).ready(function() {
//total record group(s)
//$('#results').load("autoload_process.php", {'group_no':track_load}, function() {track_load++;}); //load first group
$('#viewmoredate').click(function() {//detect page scroll
var gropcount =$("#gropcount").val();
        if(gropcount)
            {
                total_groups= parseInt(gropcount);
            }
    if($(window).scrollTop() + $(window).height() == $(document).height())  //user scrolled to bottom of the page?
    {
    console.log(total_groups);
        if(track_load <= total_groups && loading==false) //there's more data to load
        {       
            loading = true; //prevent further ajax loading
            $('.animation_image').show(); //show loading image
            //load data from the server using a HTTP POST request
            $.get("{!!URL::to('getfilterdata')!!}",{'group_no': track_load}, function(data){
                $("#getdata").append(data); //append received data into the element
                //hide loading image
                $('.animation_image').hide(); //hide loading image once data is received
                track_load++; //loaded group increment
                loading = false;
            }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
                alert(thrownError); //alert with HTTP error
                $('.animation_image').hide(); //hide loading image
                loading = false;
            });
        }
    }
});
});
	</script>
	 
@endsection