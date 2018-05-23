<div id="SetAvaility" class="modal fade">
   <div class="modal-dialog">
        <div class="modal-content search_form_height bio_form">
              <div class="modal-header">
                <span class="search_pop_header_title"><i>Set your availability for booking  <span class="modal-body" id='datetime'>Date:-<input tyle="text" id="datetime" readonly class="booking_model_date"/>  </span></i></span>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              </div>
              {!! Form::open(array('url' => 'user/setavail', 'files'=> true, 'method'=>'POST', 'id'=> 'form_validation')) !!}     
              <div class="modal-body">
               {!! Form::input('hidden', 'datetime', '', ['id="datetime"']) !!}   
              </div>  
                  @if(count($availability) >0)
				  <div class="content-6">
                          <div class="table-responsive" id="selected_date_data">
                            <table class="table table-striped table-bordered table-hover set_availity">
                                  <thead>
                                    <tr>
                                        <th class="select_all">
                                          <span style="top: 4px; position: relative;"><input type="checkbox" id="selecctall" checked style="width:auto"/></span> Select All</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                    </tr>
                                  </thead>
                                  <tbody>                                      
									                      @foreach($availability as $avail)
                                          <tr>
                                              <td><li><input name="services" value="1" type="checkbox"><label for="list1"><span>CUM ON BODY</span></label></li></td>
                                              <td>{!! date("g:i A", strtotime($avail->start_time))  !!}</td>
                                              <td>{!! date("g:i A", strtotime($avail->end_time))  !!}</td>
                                          </tr>
                                        @endforeach
                                  </tbody>
                              </table>
                            </div>
                            </div>
                            <div class="report-submit manage_model">
                              <?php /*  {!! Form::button(trans('update'), array('class' => 'btn btn-primary','id'=>"set_avail")) !!} */ ?>
                              {!! Form::submit(trans('Save'), array('class' => 'btn save_btn')) !!} 
                              </div>
                              {!! Form::close() !!}
                    @else
                    <p style="color:red;font-size:20px;"><i>Sorry, no availity..</i></p>
                  @endif     
      </div>
   </div>
</div>

{!! Html::style('css/jquery.mCustomScrollbar.css') !!}
{!! Html::script('js/vendor/jquery/jquery.mCustomScrollbar.concat.min.js') !!}
			<script>
				(function($){
					$(window).load(function(){
						 $(".content-6").mCustomScrollbar({
							scrollButtons:{enable:true},
							theme:"3d-thick"
						});
					});
				})(jQuery);
			</script>
<script>
$(document).on("click", "#editavailability", function () {
	var datetime = $(this).data('id');
	$(".modal-body #datetime").val( datetime );
	 
	$.ajax({
		type: "get",
		url: "{!!URL::to('user/date_wise_availability')!!}"+'/'+datetime,
		data: '',
		success: function(data) {
			$("#selected_date_data").html(data);
		}
	});
	 
});
</script>

<SCRIPT language="javascript">
$(document).ready(function() {
	$('#selecctall').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });        
        }
    });
  $(".checkbox1").click(function(){

    if($(".checkbox1").length == $(".checkbox1:checked").length) {
      $("#selecctall").attr("checked", "checked");
    } else {
      $("#selecctall").removeAttr("checked");
    }

  });
   
});
</SCRIPT>