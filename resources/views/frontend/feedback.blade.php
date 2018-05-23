@extends('frontend.layouts.master')
@section('content')
	<div class="">
		<div class="dashboard_block faq_block">
			<div class="panel panel-default">
				<div class="panel-heading">FeedBack</div>
				<div class="panel-body1">
					<div role="tabpanelfhfg">
						<div class="custom-box">
							@if(count($booked_data_arr)>0)
								@foreach($booked_data_arr as $k=>$vals)
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
												<li>${{$vals->rate}} CHF</li>
											</ul>
										</div>
										<div class="col-md-3 col-sm-3 user-info">
											<ul id="feedback{{$vals->id}}">
												<li>
													@if(Auth::user()->user_type == 'Escort')
													222
														@if($vals->escort_feedback == 'No')
															<button class="custom-bn btn btn-primary btn-sx" onclick="postfeedback({{$vals->id}},{{$vals->profile_id}},{{$vals->user_id}},'escort');">Feedback</button>
														@endif
													@else
														@if($vals->user_feedback == 'No')
															<button class="custom-bn btn btn-primary btn-sx" onclick="postfeedback({{$vals->id}},{{$vals->user_id}},{{$vals->profile_id}},'user');">Feedback</button>
														@endif
													@endif
												</li>
											</ul>
										</div>
									</div>
								@endforeach
							@else
								<p>Information not avaliable.</p>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="postFeedback" role="dialog">
		<div class="modal-dialog">
			<div class="table-responsive">
				<!-- Modal content-->
				<div class="modal-content assign_promocode_popup">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Feedback and Rating</h4>
					</div>
					<div class="main">
						<div class="modal-body">
							<input type="hidden" name="bid" id="bid" value="">
							<input type="hidden" name="from_id" id="from_id" value="">
							<input type="hidden" name="to_id" id="to_id" value="">
							<input type="hidden" name="type" id="type" value="">

							<?php /*?><div class="rat-rev">
							Rating : <input type="hidden" name="rating1" id="rating1" value="0"><br>
								<fieldset class="rating">
								    <input type="radio" id="star5" name="rating" value="5" /><label onclick="ratingclick('5');" class = "full" for="star5" title="Awesome - 5 stars"></label>
								    <input type="radio" id="star4half" name="rating" value="4 and a half" /><label onclick="ratingclick('4.5');" class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
								    <input type="radio" id="star4" name="rating" value="4" /><label onclick="ratingclick('4');" class = "full" for="star4" title="Pretty good - 4 stars"></label>
								    <input type="radio" id="star3half" name="rating" value="3 and a half" /><label onclick="ratingclick('3.5');" class="half" for="star3half" title="Meh - 3.5 stars"></label>
								    <input type="radio" id="star3" name="rating" value="3" /><label onclick="ratingclick('3');" class = "full" for="star3" title="Meh - 3 stars"></label>
								    <input type="radio" id="star2half" name="rating" value="2 and a half" /><label onclick="ratingclick('2.5');" class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
								    <input type="radio" id="star2" name="rating" value="2" /><label onclick="ratingclick('2');" class = "full" for="star2" title="Kinda bad - 2 stars"></label>
								    <input type="radio" id="star1half" name="rating" value="1 and a half" /><label onclick="ratingclick('1.5');" class="half" for="star1half" title="Meh - 1.5 stars"></label>
								    <input type="radio" id="star1" name="rating" value="1" /><label onclick="ratingclick('1');" class = "full" for="star1" title="Sucks big time - 1 star"></label>
								    <input type="radio" id="starhalf" name="rating" value="half" /><label  onclick="ratingclick('0.5');" class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
								</fieldset>
								</div><?php */?>



<!-- Rating Start -->
<div class="rat-rev">
	Accuracy : <input type="hidden" name="Accuracy" id="accuract_rating" value="0"><br>
	<fieldset class="rating">
	    <input type="radio" id="accuract_star5" name="accuract_rating" value="5" /><label onclick="accuract_rating('5');" class = "full" for="accuract_star5" title="Awesome - 5 stars"></label>
	    <input type="radio" id="accuract_star4half" name="accuract_rating" value="4 and a half" /><label onclick="accuract_rating('4.5');" class="half" for="accuract_star4half" title="Pretty good - 4.5 stars"></label>
	    <input type="radio" id="accuract_star4" name="accuract_rating" value="4" /><label onclick="accuract_rating('4');" class = "full" for="accuract_star4" title="Pretty good - 4 stars"></label>
	    <input type="radio" id="accuract_star3half" name="accuract_rating" value="3 and a half" /><label onclick="accuract_rating('3.5');" class="half" for="accuract_star3half" title="Meh - 3.5 stars"></label>
	    <input type="radio" id="accuract_star3" name="accuract_rating" value="3" /><label onclick="accuract_rating('3');" class = "full" for="accuract_star3" title="Meh - 3 stars"></label>
	    <input type="radio" id="accuract_star2half" name="accuract_rating" value="2 and a half" /><label onclick="accuract_rating('2.5');" class="half" for="accuract_star2half" title="Kinda bad - 2.5 stars"></label>
	    <input type="radio" id="accuract_star2" name="accuract_rating" value="2" /><label onclick="accuract_rating('2');" class = "full" for="accuract_star2" title="Kinda bad - 2 stars"></label>
	    <input type="radio" id="accuract_star1half" name="accuract_rating" value="1 and a half" /><label onclick="accuract_rating('1.5');" class="half" for="accuract_star1half" title="Meh - 1.5 stars"></label>
	    <input type="radio" id="accuract_star1" name="accuract_rating" value="1" /><label onclick="accuract_rating('1');" class = "full" for="accuract_star1" title="Sucks big time - 1 star"></label>
	    <input type="radio" id="accuract_starhalf" name="accuract_rating" value="half" /><label onclick="accuract_rating('0.5');" class="half" for="accuract_starhalf" title="Sucks big time - 0.5 stars"></label>
	</fieldset>
</div>

<div class="rat-rev">
	Communication : <input type="hidden" name="Communication" id="communication_rating" value="0"><br>
	<fieldset class="rating">
	    <input type="radio" id="communication_star5" name="communication_rating" value="5" /><label onclick="communication_rating('5');" class = "full" for="communication_star5" title="Awesome - 5 stars"></label>
	    <input type="radio" id="communication_star4half" name="communication_rating" value="4 and a half" /><label onclick="communication_rating('4.5');" class="half" for="communication_star4half" title="Pretty good - 4.5 stars"></label>
	    <input type="radio" id="communication_star4" name="communication_rating" value="4" /><label onclick="communication_rating('4');" class = "full" for="communication_star4" title="Pretty good - 4 stars"></label>
	    <input type="radio" id="communication_star3half" name="communication_rating" value="3 and a half" /><label onclick="communication_rating('3.5');" class="half" for="communication_star3half" title="Meh - 3.5 stars"></label>
	    <input type="radio" id="communication_star3" name="communication_rating" value="3" /><label onclick="communication_rating('3');" class = "full" for="communication_star3" title="Meh - 3 stars"></label>
	    <input type="radio" id="communication_star2half" name="communication_rating" value="2 and a half" /><label onclick="communication_rating('2.5');" class="half" for="communication_star2half" title="Kinda bad - 2.5 stars"></label>
	    <input type="radio" id="communication_star2" name="communication_rating" value="2" /><label onclick="communication_rating('2');" class = "full" for="communication_star2" title="Kinda bad - 2 stars"></label>
	    <input type="radio" id="communication_star1half" name="communication_rating" value="1 and a half" /><label onclick="communication_rating('1.5');" class="half" for="communication_star1half" title="Meh - 1.5 stars"></label>
	    <input type="radio" id="communication_star1" name="communication_rating" value="1" /><label onclick="communication_rating('1');" class = "full" for="communication_star1" title="Sucks big time - 1 star"></label>
	    <input type="radio" id="communication_starhalf" name="communication_rating" value="half" /><label onclick="communication_rating('0.5');" class="half" for="communication_starhalf" title="Sucks big time - 0.5 stars"></label>
	</fieldset>
</div>

<div class="rat-rev">
	Hygiene : <input type="hidden" name="Hygiene" id="hygiene_rating" value="0"><br>
	<fieldset class="rating">
	    <input type="radio" id="hygiene_star5" name="hygiene_rating" value="5" /><label onclick="hygiene_rating('5');" class = "full" for="hygiene_star5" title="Awesome - 5 stars"></label>
	    <input type="radio" id="hygiene_star4half" name="hygiene_rating" value="4 and a half" /><label onclick="hygiene_rating('4.5');" class="half" for="hygiene_star4half" title="Pretty good - 4.5 stars"></label>
	    <input type="radio" id="hygiene_star4" name="hygiene_rating" value="4" /><label onclick="hygiene_rating('4');" class = "full" for="hygiene_star4" title="Pretty good - 4 stars"></label>
	    <input type="radio" id="hygiene_star3half" name="hygiene_rating" value="3 and a half" /><label onclick="hygiene_rating('3.5');" class="half" for="hygiene_star3half" title="Meh - 3.5 stars"></label>
	    <input type="radio" id="hygiene_star3" name="hygiene_rating" value="3" /><label onclick="hygiene_rating('3');" class = "full" for="hygiene_star3" title="Meh - 3 stars"></label>
	    <input type="radio" id="hygiene_star2half" name="hygiene_rating" value="2 and a half" /><label onclick="hygiene_rating('2.5');" class="half" for="hygiene_star2half" title="Kinda bad - 2.5 stars"></label>
	    <input type="radio" id="hygiene_star2" name="hygiene_rating" value="2" /><label onclick="hygiene_rating('2');" class = "full" for="hygiene_star2" title="Kinda bad - 2 stars"></label>
	    <input type="radio" id="hygiene_star1half" name="hygiene_rating" value="1 and a half" /><label onclick="hygiene_rating('1.5');" class="half" for="hygiene_star1half" title="Meh - 1.5 stars"></label>
	    <input type="radio" id="hygiene_star1" name="hygiene_rating" value="1" /><label onclick="hygiene_rating('1');" class = "full" for="hygiene_star1" title="Sucks big time - 1 star"></label>
	    <input type="radio" id="hygiene_starhalf" name="hygiene_rating" value="half" /><label onclick="hygiene_rating('0.5');" class="half" for="hygiene_starhalf" title="Sucks big time - 0.5 stars"></label>
	</fieldset>
</div>


<div class="rat-rev">
	Friendliness : <input type="hidden" name="Friendliness" id="friendliness_rating" value="0"><br>
	<fieldset class="rating">
	    <input type="radio" id="friendliness_star5" name="friendliness_rating" value="5" /><label onclick="friendliness_rating('5');" class = "full" for="friendliness_star5" title="Awesome - 5 stars"></label>
	    <input type="radio" id="friendliness_star4half" name="friendliness_rating" value="4 and a half" /><label onclick="friendliness_rating('4.5');" class="half" for="friendliness_star4half" title="Pretty good - 4.5 stars"></label>
	    <input type="radio" id="friendliness_star4" name="friendliness_rating" value="4" /><label onclick="friendliness_rating('4');" class = "full" for="friendliness_star4" title="Pretty good - 4 stars"></label>
	    <input type="radio" id="friendliness_star3half" name="friendliness_rating" value="3 and a half" /><label onclick="friendliness_rating('3.5');" class="half" for="friendliness_star3half" title="Meh - 3.5 stars"></label>
	    <input type="radio" id="friendliness_star3" name="friendliness_rating" value="3" /><label onclick="friendliness_rating('3');" class = "full" for="friendliness_star3" title="Meh - 3 stars"></label>
	    <input type="radio" id="friendliness_star2half" name="friendliness_rating" value="2 and a half" /><label onclick="friendliness_rating('2.5');" class="half" for="friendliness_star2half" title="Kinda bad - 2.5 stars"></label>
	    <input type="radio" id="friendliness_star2" name="friendliness_rating" value="2" /><label onclick="friendliness_rating('2');" class = "full" for="friendliness_star2" title="Kinda bad - 2 stars"></label>
	    <input type="radio" id="friendliness_star1half" name="friendliness_rating" value="1 and a half" /><label onclick="friendliness_rating('1.5');" class="half" for="friendliness_star1half" title="Meh - 1.5 stars"></label>
	    <input type="radio" id="friendliness_star1" name="friendliness_rating" value="1" /><label onclick="friendliness_rating('1');" class = "full" for="friendliness_star1" title="Sucks big time - 1 star"></label>
	    <input type="radio" id="friendliness_starhalf" name="friendliness_rating" value="half" /><label onclick="friendliness_rating('0.5');" class="half" for="friendliness_starhalf" title="Sucks big time - 0.5 stars"></label>
	</fieldset>
</div>

<div class="rat-rev">
	Cleanliness : <input type="hidden" name="Cleanliness" id="cleanlines_rating" value="0"><br>
	<fieldset class="rating">
	    <input type="radio" id="cleanlines_star5" name="cleanlines_rating" value="5" /><label onclick="cleanlines_rating('5');" class = "full" for="cleanlines_star5" title="Awesome - 5 stars"></label>
	    <input type="radio" id="cleanlines_star4half" name="cleanlines_rating" value="4 and a half" /><label onclick="cleanlines_rating('4.5');" class="half" for="cleanlines_star4half" title="Pretty good - 4.5 stars"></label>
	    <input type="radio" id="cleanlines_star4" name="cleanlines_rating" value="4" /><label onclick="cleanlines_rating('4');" class = "full" for="cleanlines_star4" title="Pretty good - 4 stars"></label>
	    <input type="radio" id="cleanlines_star3half" name="cleanlines_rating" value="3 and a half" /><label onclick="cleanlines_rating('3.5');" class="half" for="cleanlines_star3half" title="Meh - 3.5 stars"></label>
	    <input type="radio" id="cleanlines_star3" name="cleanlines_rating" value="3" /><label onclick="cleanlines_rating('3');" class = "full" for="cleanlines_star3" title="Meh - 3 stars"></label>
	    <input type="radio" id="cleanlines_star2half" name="cleanlines_rating" value="2 and a half" /><label onclick="cleanlines_rating('2.5');" class="half" for="cleanlines_star2half" title="Kinda bad - 2.5 stars"></label>
	    <input type="radio" id="cleanlines_star2" name="cleanlines_rating" value="2" /><label onclick="cleanlines_rating('2');" class = "full" for="cleanlines_star2" title="Kinda bad - 2 stars"></label>
	    <input type="radio" id="cleanlines_star1half" name="cleanlines_rating" value="1 and a half" /><label onclick="cleanlines_rating('1.5');" class="half" for="cleanlines_star1half" title="Meh - 1.5 stars"></label>
	    <input type="radio" id="cleanlines_star1" name="cleanlines_rating" value="1" /><label onclick="cleanlines_rating('1');" class = "full" for="cleanlines_star1" title="Sucks big time - 1 star"></label>
	    <input type="radio" id="cleanlines_starhalf" name="cleanlines_rating" value="half" /><label onclick="cleanlines_rating('0.5');" class="half" for="cleanlines_starhalf" title="Sucks big time - 0.5 stars"></label>
	</fieldset>
</div>

<div class="rat-rev">
	Talent : <input type="hidden" name="Talent" id="talent_rating" value="0"><br>
	<fieldset class="rating">
	    <input type="radio" id="talent_star5" name="talent_rating" value="5" /><label onclick="talent_rating('5');" class = "full" for="talent_star5" title="Awesome - 5 stars"></label>
	    <input type="radio" id="talent_star4half" name="talent_rating" value="4 and a half" /><label onclick="talent_rating('4.5');" class="half" for="talent_star4half" title="Pretty good - 4.5 stars"></label>
	    <input type="radio" id="talent_star4" name="talent_rating" value="4" /><label onclick="talent_rating('4');" class = "full" for="talent_star4" title="Pretty good - 4 stars"></label>
	    <input type="radio" id="talent_star3half" name="talent_rating" value="3 and a half" /><label onclick="talent_rating('3.5');" class="half" for="talent_star3half" title="Meh - 3.5 stars"></label>
	    <input type="radio" id="talent_star3" name="talent_rating" value="3" /><label onclick="talent_rating('3');" class = "full" for="talent_star3" title="Meh - 3 stars"></label>
	    <input type="radio" id="talent_star2half" name="talent_rating" value="2 and a half" /><label onclick="talent_rating('2.5');" class="half" for="talent_star2half" title="Kinda bad - 2.5 stars"></label>
	    <input type="radio" id="talent_star2" name="talent_rating" value="2" /><label onclick="talent_rating('2');" class = "full" for="talent_star2" title="Kinda bad - 2 stars"></label>
	    <input type="radio" id="talent_star1half" name="talent_rating" value="1 and a half" /><label onclick="talent_rating('1.5');" class="half" for="talent_star1half" title="Meh - 1.5 stars"></label>
	    <input type="radio" id="talent_star1" name="talent_rating" value="1" /><label onclick="talent_rating('1');" class = "full" for="talent_star1" title="Sucks big time - 1 star"></label>
	    <input type="radio" id="talent_starhalf" name="talent_rating" value="half" /><label onclick="talent_rating('0.5');" class="half" for="talent_starhalf" title="Sucks big time - 0.5 stars"></label>
	</fieldset>
</div>
<!-- Rating End -->
				 				<div class="rat-rev">
											 Review : <br> <textarea name="review" id="review"></textarea>

											 <br>

								</div>
								<?php /*?><div class="rat-rev">
								 Review Type: <br>
									<select id="review_type" name="review_type">
										<option value="Accuracy">Accuracy</option>
										<option value="Communication">Communication</option>
										<option value="Hygiene">Hygiene</option>
										<option value="Friendliness">Friendliness</option>
										<option value="Cleanliness">Cleanliness</option>
										<option value="Talent">Talent</option>
									</select> 
								</div><?php */?>
						</div>
					</div>  
					<div class="modal-footer rat-rev">
						<input type="submit" value="Send" class="btn btn-default sendFeedback">
						<button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>    
	</div>
	<script type="text/javascript">
		function accuract_rating(val) {
			$("#accuract_rating").val(val);
		};
		function communication_rating(val) {
			$("#communication_rating").val(val);
		};friendliness_rating
		function hygiene_rating(val) {
			$("#hygiene_rating").val(val);
		};
		function friendliness_rating(val) {
			$("#friendliness_rating").val(val);
		};
		function cleanlines_rating(val) {
			$("#cleanlines_rating").val(val);
		};
		function talent_rating(val) {
			$("#talent_rating").val(val);
		};

		function postfeedback(id, from_id, to_id, type) {
			$('#postFeedback').modal('show');
			 $("#bid").val(id);
			 $("#from_id").val(from_id);
			 $("#to_id").val(to_id);
			 $("#type").val(type);
		};
	$(document).ready(function(){
		$(".sendFeedback").click(function() {
			var id = $("#bid").val();
			var from_id = $("#from_id").val();
			var to_id = $("#to_id").val();
			var type = $("#type").val();
			var review = $("#review").val();
			var accuract_rating = $("#accuract_rating").val();
			var communication_rating = $("#communication_rating").val();
			var hygiene_rating = $("#hygiene_rating").val();
			var friendliness_rating = $("#friendliness_rating").val();
			var cleanlines_rating = $("#cleanlines_rating").val();
			var talent_rating = $("#talent_rating").val();
			$.ajax({
				url: "{!! URL::to('/savefeedback') !!}",
				type: 'get',
				data: {id:id, from_id:from_id, to_id:to_id, type:type, review:review, accuract_rating:accuract_rating, communication_rating:communication_rating, hygiene_rating:hygiene_rating, friendliness_rating:friendliness_rating, cleanlines_rating:cleanlines_rating, talent_rating:talent_rating},
				success: function(data) {
					$('#postFeedback').modal('hide');
					$("#feedback"+id).hide();
					alert('Successfully Send your review and rating.');
				}
				/*$('#postFeedback').modal('hide');
				alert('Feedback not post please Try again.');*/
				/*	
			});*/
			});	

			});	
		});
	</script>

	<style type="text/css">
	/* Rating CSS*/
/****** Style Star Rating Widget *****/

.rating { 
  border: none;
  float: left;
}

.rating > input { display: none; } 
.rating > label:before { 
  margin: 5px;
  font-size: 1.25em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating > .half:before { 
  content: "\f089";
  position: absolute;
}

.rating > label { 
  color: #ddd; 
 float: right; 
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 
	/* Rating CSS*/
		ul{
			list-style: none
		}
		li:nth-child(2) {
			font-size: 10px;
		}
		ul li{
			padding: 5px;
		}
		li:nth-child(3) {
			font-size: 11px;
		}
		.box-upper {
			border-bottom: 1px dotted #ccc;
			margin-top: 10px;
			position: relative;
			display: inline-table;
		}
		.user-info {
			margin-top: 5px;
		}
		.custom-bn{
			margin: 2px;
			font-size: 10px;
		}
		.user-round-image{
			margin-top: 10px;
		}
		.custom-box > p {
			margin: 22px 9px 18px 22px;
			text-align: center;
			padding: 0px 5px 4px 6px;
		}
	</style>
@endsection