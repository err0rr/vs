<table class="table table-striped table-bordered table-hover set_availity">
  <thead>
	<tr>
		<th class="select_all">
    Select All
	  <span style="top: 4px; position: relative;"><input type="checkbox" id="selecctall" style="width:auto" /><label for="selecctall"></label></th></span>
		  <!--<li><input id="selecctall" name="services" value="01"  type="checkbox"><label for="list01"></label></li>--></th>
		<th>Start Time</th>
		<th>End Time</th>
	</tr>
  </thead>
  <tbody>
	@foreach($availability_final_arr as $avail)


<tr>
		<td>
			@if($avail['available'] == 'yes')
			<!--{!! Form::checkbox('slot_id[]', $avail['id'],true,['class'=>'checkbox1']) !!}-->
				<li><input id="list{!! $avail['id'] !!}" name="slot_id[]" class='checkbox1' value="{!! $avail['id'] !!}"  type="checkbox"><label for="list{!! $avail['id'] !!}"></label></li>
			@else
				<li><input id="list{!! $avail['id'] !!}" name="slot_id[]" class='checkbox1' checked="checked" value="{!! $avail['id'] !!}" type="checkbox"><label for="list{!! $avail['id'] !!}"></label></li>
			@endif
		</td>
		<td>{!! date("g:i A", strtotime($avail['start_time']))  !!}</td>
		<td>{!! date("g:i A", strtotime($avail['end_time']))  !!}</td>
	</tr> 
	@endforeach
  </tbody>
</table>
<script language="javascript">
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
</script>