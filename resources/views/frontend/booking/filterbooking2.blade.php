
									
									<?php //echo '<pre>'; print_r($booked_data_arr); die;?>
										<?php $total= 0;//echo "<pre>"; print_r($booked_data_arr); die;?>
										@if(count($booked_data_arr)>0)
											@foreach($booked_data_arr as $k=>$vals)
											<?php if($vals->invitation_accepted =='Y')
											{
												$rs = str_replace(',','', $vals->rate);
												$total=$total+$rs;
											} ?>
												<div class="box-upper right_cale_section">
													<div class="col-md-2 col-sm-2 user-round-image">
														<img src="{!! URL::to('img/users/'.$vals->photo) !!}">
													</div>
													<div class="col-md-4 col-sm-4 user-round-image">
														<ul>
															<li>{{$vals->name}}</li>
															<li> Date : {!! date('D jS M Y',strtotime($vals->book_date)) !!}</li>
														</ul>
													</div>
													<div class="col-md-3 col-sm-3 user-round-image">
														<ul>
															<li>{{$vals->time_start." To " .$vals->time_end}}</li>
															<li>{{$vals->rate}} CHF</li>
														</ul>
													</div>
													<div class="col-md-3 col-sm-3 user-info">
														<ul id="actionlinks{{$vals->id}}">
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
								