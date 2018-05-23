<div class="custom-box">
	<div class="booking-date"><?php echo date('D jS M Y',strtotime($sel_date));  ?></div>
	@if(count($booked_data_arr)>0)
	@foreach($booked_data_arr as $k=>$vals)
	<div class="box-upper right_cale_section">
		<div class="col-md-4 user-round-image">
			<img src="{!! URL::to('img/users/'.$vals->photo) !!}">
		</div>
		<div class="col-md-8 user-info">
										<ul>
											<li>{{$vals->name}}</li>
											<li>{{$vals->start_time." To " .$vals->end_time}}</li>		
										</ul>
										<ul id="actionlinks">
											@if($vals->invitation_accepted=="P")
												<li>
													<button class="custom-bn btn btn-primary btn-sx" onclick="chnagestatus({{$vals->id}},'Y');">Accept</button>
													<button class="custom-bn btn btn-primary btn-sx" onclick="chnagestatus({{$vals->id}},'R');">Decline</button>
												</li>
											@else
												@if($vals->invitation_accepted=='Y')
													<li class="approve_left">Accepted</li>
												@elseif($vals->invitation_accepted=='R')
													<li class="reject_right">Reject</li>
												@else
													<li class="reject_right">Cancel</li>
												@endif
											@endif
										</ul>
									</div>
	</div>
	@endforeach
	@else
		<p>Information not avaliable.</p>
	@endif
</div>