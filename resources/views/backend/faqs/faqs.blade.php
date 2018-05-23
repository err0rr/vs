@extends ('backend.layouts.master')

@section ('title', trans('Faqs'))
@section('meta_description',trans('Faqs'))

@section ('breadcrumbs')
	<li><a href=""><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
	<li class="active"></li>
@stop 

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="hpanel">
            <div class="panel-heading">
	            <div class="panel-tools">
	            </div>
                {{ trans('FAQs Management') }}
                <button class="btn btn-xs btn-primary pull-right" id="add" value="0">Add New Faqs</button>
	        </div>            
	     	<div class="panel-body">
                <div class="table-responsive">
					<table id="example" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>{{ trans('S.No.') }}</th>
								<th>{{ trans('Question') }}</th>
								<th>{{ trans('Answer')}}</th>
								<th>{{ trans('Created') }}</th>
								<th>{{ trans('Status') }}</th>
								<th>{{ trans('Action') }}</th>
							</tr>
						</thead>
						<tbody id="serviceData">
							@if(!empty($faqs))
							@foreach($faqs as $key=>$vals)
								<tr>
									<td>{!! $key+1 !!}</td>
									<td>{!! substr($vals->question,'0','10') !!}..</td>
									<td>{!! substr($vals->answer,'0','20') !!}..</td>
									<td>{{ $vals->created_at }}</td>
									<td>
										@if($vals->is_active == 'N')
											<a class="btn btn-xs btn-danger" href="{!!url('admin/faqs/change/status')."/".$vals->id!!}">Inactive</a>
										@else
											<a class="btn btn-xs btn-primary" href="{!!url('admin/faqs/change/status')."/".$vals->id!!}">Active</a>
										@endif
									</td>
									<td>
                                        <a href="{{url('admin/faqs/view')."/".$vals->id}}" class="btn btn-success btn-xs"><i class="fa fa-eye" data-toggle="tooltip" data-palcement="top" title data-original-title="View"></i></a> 
                                        <button class="btn btn-warning btn-xs btn-detail open-modal" id="idsav" value="{{$vals->id}}">Edit</button>
										<a href="{{ url('admin/delete/faqs')."/".$vals->id}}" onclick="return confirm('Are you sure you want to delete this Faqs?')" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-palcement="top" title data-original-title="Delete"></i></a>

									</td>
								</tr>		
							@endforeach
                            @else
                                <center><td> Data not availeble </td></center>
                            @endif                            
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabeladd" disabled="disabled">Faqs Management Add</h4>
                <h4 class="modal-title" id="myModalLabeledit" disabled="disabled">Faqs Management Editor</h4>
            </div>
            <div class="modal-body">
                <form id="frmTasks" name="frmTasks" class="form-horizontal" novalidate="" file="true" enctype="multipart/form-data" >
                	<div class="form-group">
                    	{!! Form::label('Question', trans('Question'), ['class' => 'col-lg-2 control-label']) !!}
                    	<div class="col-lg-10">
                        	{!! Form::text('question', null, ['class' => 'input-control', 'id' => 'question', 'onblur' => 'validate()',  'placeholder' => trans('Enter Your Name')]) !!}
                    	</div>
                	</div><!--form control-->
					<div class="form-group">
						{!! Form::label('Answer', trans('Answer'), ['class' => 'col-lg-2 control-label']) !!}
						<div class="col-lg-10">
					
							{!! Form::textarea('answer', null, ['class' => 'form-control validate[required]', 'id'=>'answer',  'placeholder' => trans('Enter Your Answer')]) !!}
						</div>
					</div>
                	<div class="form-group">
                    	{!! Form::label('Active', trans('Active'), ['class' => 'col-lg-2 control-label']) !!}
                    	<div class="col-lg-10">
                        	<input type="checkbox" value="Y" id="is_status" name="confirmed" checked="checked" />
                    	</div>
                	</div><!--form control-->           
                </form>
            </div>
            <div class="modal-footer" id="save">
                <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close" id="cancel_sav"><span aria-hidden="true" >Cancel</span></button>
                <button type="button" class="btn btn-primary" id="btn-save" value="" disabled="disabled">Save</button>
            </div>                      
            <div class="modal-footer" id="update">
                <button type="button" class="btn btn-primary" id="cancel"><span aria-hidden="true">Cancel</span></button>
                <button type="button" class="btn btn-primary" id="btn-update" value="">Update</button>
                <input type="hidden" id="id" name="id" value="">
            </div>    
        </div>
    </div>
</div>

<meta name="_token" content="{!! csrf_token() !!}" />
<link href="{{ asset('css/backend/access/bootstrap.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/backend/access/jquery.min.js') }}"></script>
<script src="{{ asset('js/backend/access/bootstrap.min.js') }}"></script>
<script src="{{asset('js/ajax-crud.js')}}"></script>
<script>
$(document).ready(function() {
	$('input[type = checkbox]').change(function () {
    $('.' + this.value).toggle(self.checked);
});
});
</script>    
    <script type="text/javascript">
/* add open start */ 
       $(document).ready(function(){
            $('.pull-right').click(function(){
                $('#question').val('');
                $('#answer').val('');
                $('#description').val('');
                        $('#save').show();
                        $('#myModalLabeledit').hide();
                        $('#myModalLabeladd').show();
                        $('#update').hide();                
                        $('#myModal').modal('show');  
            })    
        });
/* add open end */
/* save start*/        
        $(document).ready(function(){     
            $('#btn-save').click(function(){
                var id = $(this).val();  
                var question = $('#question').val();
                var answer = $('#answer').val();
                var is_status = $('#is_status').is(':checked');
                //alert(is_status);
                
                $.ajax({
                    type: "post",
                    url : "{{ route('postFaqsSaveFirst')}}",
                    data : {id:id,question:question,answer:answer,is_status:is_status},
                    dataType: 'json',
                    success : function(data){
                    	if(data == 'false')
                    	{
                    		alert('question is already exits');

                        }else
                        {
                            $('#myModal').modal('hide');
                             
                            $('#serviceData').html('');
                            $('#serviceData').html(data);
                            alert(name+' Faqs Successfully Inserted ');

        $(document).ready(function(){
            $('.open-modal').click(function(){
                var id = $(this).val();  
                $.ajax({
                    type: "get",
                    url : "{{ route('getFaqsEditForm')}}",
                    data : {id:id},
                    dataType: 'json',
                    success : function(data){
                        console.log(data);
                        $('#id').val(data.id);
                        $('#question').val(data.question);
                        $('#answer').val(data.answer);
                        if (data.is_active == 'Y') {
                        	$('#is_status').is(':checked');
               
                    	}
                    	else{
                    		$('#is_status').attr('checked',false);
                    	}
                        
                         // $('#btn-save').val("update");
                        $('#save').hide();
                        $('#update').show();
                        $('#myModalLabeledit').show();
                        $('#myModalLabeladd').hide();
                        $('#myModal').modal('show');  
                    }
                });
            })
        });


                        }
                    }
                });
            })         
        });
/* save end*/
/* edit start */     
        $(document).ready(function(){
            $('.open-modal').click(function(){
                var id = $(this).val();  
                $.ajax({
                    type: "get",
                    url : "{{ route('getFaqsEditForm')}}",
                    data : {id:id},
                    dataType: 'json',
                    success : function(data){
                        console.log(data);
                        $('#id').val(data.id);
                        $('#question').val(data.question);
                        $('#answer').val(data.answer);
                        if (data.is_active == 'Y') {
                        	$('#is_status').is(':checked');
               
                    	}
                    	else{
                    		$('#is_status').attr('checked',false);
                    	}
                        
                         // $('#btn-save').val("update");
                        $('#save').hide();
                        $('#update').show();
                        $('#myModalLabeledit').show();
                        $('#myModalLabeladd').hide();
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
                var question = $('#question').val();
                var answer = $('#answer').val();
                var is_status = $('#is_status').is(':checked');
                $.ajax({
                    type: "post",
                    url : "{{ route('postFaqsSave')}}",
                    data : {id:id,question:question,answer:answer,is_status:is_status},
                    dataType: 'json',
                    success : function(data){

                        if(data == 'false')
                        {
                            alert('question is already exits');

                        }else
                        {

                            $('#myModal').modal('hide');
                             
                            $('#serviceData').html('');
                            $('#serviceData').html(data);
                            alert(name+' Faqs Successfully Updated ');

        $(document).ready(function(){
            $('.open-modal').click(function(){
                var id = $(this).val();  
                $.ajax({
                    type: "get",
                    url : "{{ route('getFaqsEditForm')}}",
                    data : {id:id},
                    dataType: 'json',
                    success : function(data){
                        console.log(data);
                        $('#id').val(data.id);
                        $('#question').val(data.question);
                        $('#answer').val(data.answer);
                        if (data.is_active == 'Y') {
                        	$('#is_status').is(':checked');
               
                    	}
                    	else{
                    		$('#is_status').attr('checked',false);
                    	}
                        
                         // $('#btn-save').val("update");
                        $('#save').hide();
                        $('#update').show();
                        $('#myModalLabeledit').show();
                        $('#myModalLabeladd').hide();
                        $('#myModal').modal('show');  
                    }
                });
            })
        });                            

                        }

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
/* cancel sav start */         
       $(document).ready(function(){
            $('#cancel_sav').click(function(){
                $('#myModal').modal('hide');
                //location.reload(true);        
            })     
        });       
/* cancel sav end */
/* close start */         
       $(document).ready(function(){
            $('.close').click(function(){
                $('#myModal').modal('hide');
                //location.reload(true);        
            })     
        });       
/* close end */
</script>



	<script>
   	$(document).ready(function() { 
	$(function() {
    $('#btn-save').attr('disabled', 'disabled');
	}); 
	$('#question').keyup(function() {    
    		if ($('#question').val() !='') {
        		$('#btn-save').removeAttr('disabled');
    		} 
    		else 
    		{
        		$('#btn-save').attr('disabled', 'disabled');
    		}
		});
    });
</script>
	
@stop