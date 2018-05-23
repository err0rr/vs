@if(count($get_all_escort)>0)
@foreach($get_all_escort as $k=>$escort)

<div class="col-md-4 col-sm-4">
	 
	<div class="hovereffect"><a href="{!! URL::to('cast/'.$escort->user_id.'-' .$escort->name)!!}">
		<img src="{!! URL::to('img/users/'.$escort->photo)!!}" onerror="this.src='{{ URL::to('img/noimage.jpg') }}';">
		<div class="text-border">
			<!-- <p class="icon_p1"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i></p>
			<p class="icon_p2"><i class="fa fa-heart-o" aria-hidden="true"></i>  <i class="fa fa-phone" aria-hidden="true"></i>  <i class="fa fa-comments-o" aria-hidden="true"></i></p> -->
		</div>
		<div class="overlay">
			<p>{{strtoupper($escort->name)}}</p>
			<p>{{strtoupper($escort->canton)}}</p>
			<p>AGE : {{$escort->age}}</p>
			<p>RATE : {{$escort->currency." ".$escort->rate_1h}}</p>
			<p class="icon_p1 mobile_star_rate">
			<?php
$data = App::make("App\Http\Controllers\Frontend\FrontendController")->escortRating($escort->user_id);
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
			<!-- <a class="info" href="{!! URL::to('cast/'.$escort->user_id.'-' .$escort->name)!!}"><i class="fa fa-arrow-right" aria-hidden="true"></i> </a>-->
		</div></a>
	</div>
	<div class="escort_detail_mobile">
					 <p>{{strtoupper($escort->name)}}</p>
					 <p>{{strtoupper($escort->canton)}} <span>{{strtoupper($escort->region)}}</span></p>
				  </div>
</div>
@endforeach
@else
<div class="noinfo">No More Record(S)</div>
@endif