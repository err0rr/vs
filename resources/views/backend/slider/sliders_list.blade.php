@extends ('backend.layouts.master')

@section ('title', trans('Slider Management'))
@section('meta_description',trans('Slider Management'))

@section('page-header')
	<h1>
		{{ trans('Slider Management') }}
		<small>{{ trans('Active Slider') }}</small>
	</h1>
@endsection

@section('content')
	<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title">{{ trans('Slider list') }}</h3>
			<div class="box-tools pull-right">
				
					<button class="btn btn-xs btn-primary pull-right" id="add" value="0">Add New Slider</button>
				
			</div>
		</div>
	</div>
	<table id="example" class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>{{ trans('S.No.') }}</th>
				<th>{{ trans('Title') }}</th>
				<th class="visible-lg">{{ trans('Page Name') }}</th>
				<th class="visible-lg">{{ trans('Updated') }}</th>
				<!-- <th>{{ trans('Status') }}</th> -->
				<th style="width:100px;">{{ trans('Actions') }}</th>
			</tr>
		</thead>
		<tbody id="serviceData">
			@if(!empty($slider))
				@foreach($slider as $slider)
					<tr>
						<td>{!! $slider->id !!}</td>
						<td>{!! $slider->title !!}</td>
						<td>{!! ucfirst($slider->flag) !!}</td>
						<td>{!! $slider->updated_at!!}</td>
<!-- 						<td>
	 						@if($slider->is_active=="N")
								<a class="btn btn-xs btn-danger" href="{!!url('admin/sliders/status')."/".$slider->id!!}">Inactive</a>
							@else
								<a class="btn btn-xs btn-primary" href="{!!url('admin/sliders/status')."/".$slider->id!!}">Active</a>
							@endif 
						</td> -->
						<td>
							<button class="btn btn-warning btn-xs btn-detail open-modal" id="idsav" value="{{$slider->id}}">Edit</button>	                           
                            <?php /*?><a href="{!!url('admin/sliders/delete')."/".$slider->id!!}" onclick="return confirm('Are you sure you want to delete this Page?')" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-palcement="top" title data-original-title="Delete"></i></a> <?php */?>
						</td>
					</tr>
				@endforeach
			@else
			<center><td> Data not availeble </td></center>	
			@endif	
		</tbody>
	</table>
<!-- Load Bootstrap CSS -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabeladd" disabled="disabled">Sliders Management Add</h4>
                <h4 class="modal-title" id="myModalLabeledit" disabled="disabled">Sliders Management Editor</h4>
            </div>
            <div class="modal-body">
                <form id="frmTasks" name="frmTasks" class="form-horizontal" novalidate="" file="true" enctype="multipart/form-data" >
				  	<div class="form-group">
						{!! Form::label('Title', trans('Title'), ['class' => 'col-lg-2 control-label']) !!}
						<div class="col-lg-10">
							{!! Form::text('title', null, ['class' => 'form-control validate[required]', 'id'=>'title', 'placeholder' => trans('Enter Slider title')]) !!}
						</div>
					</div><!--form control-->

					<div class="form-group">
						{!! Form::label('Description', trans('Description'), ['class' => 'col-lg-2 control-label']) !!}
						<div class="col-lg-10">
							{!! Form::textarea('description', null, ['class' => 'form-control validate[required]', 'id'=>'description', 'placeholder' => trans('Enter your Description')]) !!}
						</div>
					</div><!--form control-->

					<div class="form-group">
						{!! Form::label('Url', trans('Url'), ['class' => 'col-lg-2 control-label']) !!}
						<div class="col-lg-10">
							{!! Form::text('youtube_url', null, ['class' => 'form-control', 'id'=>'youtube_url', 'placeholder' => trans('Enter your Youtube Url')]) !!}
						</div>
					</div><!--form control-->
                    <div class="form-group">
                        {!! Form::label('Image', trans('Image'), ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-lg-10">
                            <div id="imgArea" disabled="disabled">
                                <img style='height: 100px;width: 100px;' src="" >
                            </div>
                            <input type="file" name="file" id="file" required />
                        </div>
                    </div>
<!--                 	<div class="form-group">
                    	{!! Form::label('Active', trans('Active'), ['class' => 'col-lg-2 control-label']) !!}
                    	<div class="col-lg-10">
                        	<input type="checkbox" value="Y" id="is_status" name="confirmed" checked="checked" />
                    	</div>
                	</div> --><!--form control-->           
                </form>
            </div>
            <div class="modal-footer" id="save">
                <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close" id="cancel_sav"><span aria-hidden="true" >Cancel</span></button>
                <button type="button" class="btn btn-primary" name="btnSubmit" id="btnSubmit" disabled="disabled"> Submit </button>
            </div>                      
            <div class="modal-footer" id="update">
                <button type="button" class="btn btn-primary" id="cancel"><span aria-hidden="true">Cancel</span></button>
                <button type="button" name="btnUpdate" class="btn btn-primary" id="btnUpdate"> Update </button>
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
                $('#title').val('');
                $('#description').val('');
                $('#youtube_url').val('');
                $('#file').val('');                
                        $('#save').show();
                        $('#myModalLabeledit').hide();
                        $('#myModalLabeladd').show();
                        $('#update').hide();
                        $('#imgArea').hide();                
                        $('#myModal').modal('show');

            })    
        });
/* add open end */
/* save start*/
$(document).ready(function () {    
    $("#btnSubmit").click(function(){
        var dataimg = new FormData();
        dataimg.append('title', $("#title").val());
        dataimg.append('description', $("#description").val());
        dataimg.append('youtube_url', $("#youtube_url").val());
        dataimg.append('confirmed', $("#is_status").is(':checked'));
        dataimg.append('file', $("#file")[0].files[0]);
        $.ajax({
            url: "{{ route('postSliderSaveFirst') }}",
            type: "POST", 
            contentType: false,
            cache: false,
            processData:false, 
            data: dataimg,
            dataType: 'json',
            success: function(data)
            {
                if(data == 'false')
                {
                    alert('Slider name is already exits');
                }else
                {
                    
                    $('#myModal').modal('hide');
                    $('#serviceData').html('');
                    $('#serviceData').html(data);
                    alert(name+' Slider Successfully Inserted ');
                    $(document).ready(function(){
                        $('.open-modal').click(function(){
                            var id = $(this).val();  
                            $.ajax({
                                type: "get",
                                url : "{{ route('getSliderEditForm')}}",
                                data : {id:id},
                                dataType: 'json',
                                success : function(data){
                                    console.log(data);
                                    $('#id').val(data.id);
                                    $('#title').val(data.title);
                                    $('#description').val(data.description);
                                    $('#youtube_url').val(data.url);
                                    if(data.image !== ''){
                                        $('#imgArea>img').prop('src',"{{ asset('img/slider')}}"+'/'+data.image);
                                    }
                                    else{
                                        $('#imgArea>img').prop('src',"{{ asset('img/slider/no-image.png')}}");
                                    }                       
                                    if (data.is_active == 'Y') {
                                        
                                        $('#is_status').is(':checked');

                                    }
                                    else{ 
                                     
                                        $('#is_status').attr('checked',false);
                                    }
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
                 window.location.reload();               
            }
        });
    });
});        

/* save end*/
/* edit start */
        $(document).ready(function(){
            $('.open-modal').click(function(){
                var id = $(this).val();  
                //alert("asa");
                $.ajax({
                    type: "get",
                    url : "{{ route('getSliderEditForm')}}",
                    data : {id:id},
                    dataType: 'json',
                    success : function(data){
                        console.log(data);
                        $('#id').val(data.id);
                        $('#title').val(data.title);
                        $('#description').val(data.description);
                        $('#youtube_url').val(data.url);
                        if(data.image !== ''){
                            $('#imgArea>img').prop('src',"{{ asset('img/slider')}}"+'/'+data.image);
                        }
                        else{
                            $('#imgArea>img').prop('src',"{{ asset('img/slider/no-image.png')}}");
                        }                       
                        if (data.is_active == 'Y') {
                            
                            $('#is_status').is(':checked');

                        }
                        else{ 
                         
                            $('#is_status').attr('checked',false);
                        }
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
$(document).ready(function () {    
    $("#btnUpdate").click(function(){
       // alert("update");
        var dataimg = new FormData();
        dataimg.append('id', $("#id").val());
        dataimg.append('title', $("#title").val());
        dataimg.append('description', $("#description").val());
        dataimg.append('youtube_url', $("#youtube_url").val());
        dataimg.append('confirmed', $("#is_status").is(':checked'));
        dataimg.append('file', $("#file")[0].files[0]);
        $.ajax({
            url: "{{ route('postSliderSave') }}",
            type: "POST", 
            contentType: false,
            cache: false,
            processData:false, 
            data: dataimg,
            dataType: 'json',
            success: function(data)
            {
                if(data == 'false')
                {
                    alert('slider name is already exits');
                      
                }else
                {
                    $('#myModal').modal('hide');
                    $('#serviceData').html('');
                    $('#serviceData').append(data);
                    alert(name+' Slider Successfully Update ');
                    $(document).ready(function(){
                        $('.open-modal').click(function(){
                            var id = $(this).val();  
                            $.ajax({
                                type: "get",
                                url : "{{ route('getSliderEditForm')}}",
                                data : {id:id},
                                dataType: 'json',
                                success : function(data){
                                    console.log(data);
                                    $('#id').val(data.id);
                                    $('#title').val(data.title);
                                    $('#description').val(data.description);
                                    $('#youtube_url').val(data.url);
                                    if(data.image !== ''){
                                        $('#imgArea>img').prop('src',"{{ asset('img/slider')}}"+'/'+data.image);
                                    }
                                    else{
                                        $('#imgArea>img').prop('src',"{{ asset('img/slider/no-image.png')}}");
                                    }                       
                                    if (data.is_active == 'Y') {
                                        
                                        $('#is_status').is(':checked');

                                    }
                                    else{ 
                                     
                                        $('#is_status').attr('checked',false);
                                    }
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
                window.location.reload();               
            }
        });
         return false;
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
            })     
        });       
/* close end */
	</script>
<script>
   	$(document).ready(function() { 
	$(function() {
    $('#btnSubmit').attr('disabled', 'disabled');
	}); 
	$('#title').keyup(function() {    
    		if ($('#title').val() !='') {
        		$('#btnSubmit').removeAttr('disabled');
    		} 
    		else 
    		{
        		$('#btnSubmit').attr('disabled', 'disabled');
    		}
		});
    });
</script>	 	
@stop
