@extends ('backend.layouts.master')

@section ('title', trans('View review'))
@section('meta_description',trans('View review Details'))

@section('content')

	<div class="row">
		<div class="col-md-12">
			<div class="hpanel">
				<div class="panel-heading">
					<div class="panel-tools"></div>
					{{ trans('View review') }}
				</div>
				<div class="panel-body">
				<table id="example" class="table table-striped table-bordered table-hover">		
					<thead>
							<tr>
								<th>{{ trans('S.No.') }}</th>
								<th>{{ trans('UserName') }}</th>
								<th>{{ trans('Total Rating') }}</th>
								<th>{{ trans('Reviewcontent') }}</th>
								<th>{{ trans('Postdate') }}</th>
								<th>{{ trans('Action') }}</th>
							</tr>
						</thead>
						<tbody id="reviewData">							
							@if(!empty($reviews))
							@foreach($reviews as $key=>$vals)
							<tr>
								<td>{!! $key+1 !!}</td>							
								<td>{!! ucfirst($vals->name) !!}</td>
								<td>{!! ucfirst($vals->rating) !!}</td>
								<td>{!! $vals->description !!}</td>
								<td>{!! ucfirst($vals->created_at) !!}</td>
								<td><!-- <button class="btn btn-warning btn-xs btn-detail open-modal" id="idsav" value="{{$vals->id}}">Edit</button> -->

                                   <button class="custom-bn btn btn-primary btn-sx" onclick="postfeedback({{$vals->id}},{{$vals->user_id}},{{$vals->profile_id}},'user');">Edit</button> 

                                </td>

							</tr>
							@endforeach
							@endif
						</tbody>
						</table>
				</div>
			</div>
		</div>
	</div>
	<div class="well">
		<div class="pull-left">
			<a href="{{ URL::previous() }}" class="btn btn-primary btn-xs">{{ trans('Back') }}</a>
		</div>
		<div class="clearfix"></div>
	</div><!--well-->

<?php /*<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabeledit" disabled="disabled">Review Editor</h4>
            </div>
            <div class="modal-body">
                <form id="frmTasks" name="frmTasks" class="form-horizontal" novalidate="" file="true" enctype="multipart/form-data" >
                	<div class="form-group">
                    	{!! Form::label('Description', trans('Description'), ['class' => 'col-lg-2 control-label']) !!}
                    	<div class="col-lg-10">
                        	{!! Form::textarea('description', null, ['class' => 'form-control validate[required]', 'id'=>'description',  'placeholder' => trans('Enter Your Answer')]) !!}
                    	</div>
                	</div><!--form control-->           
                </form>
            </div>                      
            <div class="modal-footer" id="update">
                <button type="button" class="btn btn-primary" id="cancel"><span aria-hidden="true">Cancel</span></button>
                <button type="button" class="btn btn-primary" id="btn-update" value="">Update</button>
                <input type="hidden" id="id" name="id" value="">
            </div>    
        </div>
    </div>
</div> */?>


<div class="modal fade" id="postFeedback" role="dialog">
        <div class="modal-dialog">
            <div class="table-responsive">
                <!-- Modal content-->
                <div class="modal-content assign_promocode_popup">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Review Editor</h4>
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
</div></br></br></br>

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
</div></br></br></br>

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
</div></br></br></br>


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
</div></br></br></br>

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
</div></br></br></br>

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
</div></br></br></br>
<!-- Rating End -->
                                <div class="rat-rev">
                                             Review : <br> <textarea name="description" value="" id="description" style="width: 550px; height: 100px;"></textarea>
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




<meta name="_token" content="{!! csrf_token() !!}" />
<link href="{{ asset('css/backend/access/bootstrap.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/backend/access/jquery.min.js') }}"></script>
<script src="{{ asset('js/backend/access/bootstrap.min.js') }}"></script>
<script src="{{asset('js/ajax-crud.js')}}"></script>

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
            
             //var id = $(this).val();
                $("#accuract_rating").html('');  
                $.ajax({
                    type: "get",
                    url : "{{ route('getReviewEditForm')}}",
                    data : {id:id},
                    dataType: 'json',
                    success : function(data){
                        console.log(data);
                        $('#id').val(data.id);
                        $('#description').val(data.description);
                        $("#bid").val(data.id);
                        $("#from_id").val(data.user_id);
                        $("#to_id").val(data.profile_id);
                        $("#type").val(data.type);
                        $("#accuract_rating").val(data.accuract_rating); 

                        $('#postFeedback').modal('show');
             
                    }
                });





        };
    $(document).ready(function(){
        $(".sendFeedback").click(function() {
            var id = $("#bid").val();
            var from_id = $("#from_id").val();
            var to_id = $("#to_id").val();
            var type = $("#type").val();
            var description = $("#description").val();
            var accuract_rating = $("#accuract_rating").val();
            var communication_rating = $("#communication_rating").val();
            var hygiene_rating = $("#hygiene_rating").val();
            var friendliness_rating = $("#friendliness_rating").val();
            var cleanlines_rating = $("#cleanlines_rating").val();
            var talent_rating = $("#talent_rating").val();
            $.ajax({
                url: "{!! URL::to('admin/savefeedback') !!}",
                type: 'get',
                data: {id:id, from_id:from_id, to_id:to_id, type:type, description:description, accuract_rating:accuract_rating, communication_rating:communication_rating, hygiene_rating:hygiene_rating, friendliness_rating:friendliness_rating, cleanlines_rating:cleanlines_rating, talent_rating:talent_rating},
                dataType: 'json',
                success: function(data) {
                    $('#postFeedback').modal('hide');
                    $('#reviewData').html('');
                    $('#reviewData').html(data);
                    
                    alert('Review content Successfully Updated ');


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





	<script>
		/* edit start */     
        $(document).ready(function(){
            $('.open-modal').click(function(){
                var id = $(this).val();  
                $.ajax({
                    type: "get",
                    url : "{{ route('getReviewEditForm')}}",
                    data : {id:id},
                    dataType: 'json',
                    success : function(data){
                        console.log(data);
                        $('#id').val(data.id);
                        $('#description').val(data.description);
                        $('#update').show();
                        $('#myModalLabeledit').show();
                        $('#myModal').modal('show');  
                    }
                });
            })
        });
/* edit end */
/* update start*/        
        $(document).ready(function(){     
            $('#btn-update').click(function(){
                var id = $('#id').val();  
                var description = $('#description').val();
                $.ajax({
                    type: "post",
                    url : "{{ route('postReviewSave')}}",
                    data : {id:id,description:description},
                    dataType: 'json',
                    success : function(data){
                            $('#myModal').modal('hide');                             
                            $('#reviewData').html('');
                            $('#reviewData').html(data);
                            alert('Review content Successfully Updated ');
                    }
                })         
            });
        });    
/* update end*/ 
/* cancel start */         
       $(document).ready(function(){
            $('#cancel').click(function(){
                $('#myModal').modal('hide');
                //location.reload(true);        
            })     
        });       
/* cancel end */
	</script>
@stop