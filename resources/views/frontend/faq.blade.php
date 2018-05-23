@extends('frontend.layouts.master')

@section('content')
	<div class="">
		<div class="dashboard_block faq_block">
			<div class="panel panel-default">
				<div class="panel-heading">FAQ(Frequently asked questions)</div>
				<div class="panel-body">
					<!-- <h3>Frequently asked questions</h3> -->
					<div class="panel-group" id="accordion">
						<!-- @if(!empty($faq_arr))
							@foreach($faq_arr as $key=>$value)
								<div class="panel panel-default">
									<div class="faq_heading">
										<h4 class="panel-title faq_title">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne_{!! $key+1 !!}">
												{!! $key+1 !!} &nbsp; {!! $value->question !!}
											</a>
										</h4>
									</div>
									<div id="collapseOne_{!! $key+1 !!}" class="panel-collapse collapse <?php if($key == 0) { echo "in"; }?>">
										<div class="panel-body">
											{!! $value->answer !!}
										</div>
									</div>
								</div>
							@endforeach
						@endif -->
						<ul class="faq faq_ul">
								@if(isset($faq_arr))
									@foreach($faq_arr as $k=>$data)
										<li class="q"><img src="{!! url('img/arrow1.png') !!}">{{ ucfirst($data->question) }}?</li>
										<li class="a" @if($k == 0) style="display: list-item;" @endif>{{ ucfirst(nl2br($data->answer)) }}</li>
									@endforeach
								@else
									<p>{{ trans('Record Not Found') }}</p>
								@endif
							</ul>
					</div>
				</div>
			</div><!-- panel -->
		</div><!-- col-md-10 -->
	</div><!-- row -->
	<script>
		$(document).on('show','.accordion', function (e) {
			//$('.accordion-heading i').toggleClass(' ');
			$(e.target).prev('.accordion-heading').addClass('accordion-opened');
		});
		
		$(document).on('hide','.accordion', function (e) {
			$(this).find('.accordion-heading').not($(e.target)).removeClass('accordion-opened');
			//$('.accordion-heading i').toggleClass('fa-chevron-right fa-chevron-down');
		});
	</script>
	<script type="text/javascript">
    //Accordian Action
var action = 'click';
var speed = "500";
//Document.Ready
$(document).ready(function(){
  //Question handler
    $('li.q').on(action, function(){
    //gets next element
    //opens .a of selected question
    $(this).next().slideToggle(speed)
      //selects all other answers and slides up any open answer
      .siblings('li.a').slideUp();
    
    //Grab img from clicked question
    var img = $(this).children('img');
    //Remove Rotate class from all images except the active
    $('img').not(img).removeClass('rotate');
    //toggle rotate class
    img.toggleClass('rotate');
  });//End on click
});//End Ready
</script>
<style type="text/css">
    
ul, li { list-style: none; }

.faq li { padding: 20px; }

.faq li.q {
  background: #f5f5f5;
  font-weight: bold;
  font-size: 120%;
  border-bottom: 1px #ddd solid;
  cursor: pointer;
}

.faq li.a {
  background: #ffffff;
  display: none;
  color:#000;
   border:1px solid #ccc;
}

.rotate {
  -moz-transform: rotate(90deg);
  -webkit-transform: rotate(90deg);
  transform: rotate(90deg);
}
@media (max-width:800px) {
#container { width: 90%; }
}
.faq_ul {
    padding:0px;
}
.faq_ul li img {
    margin-right: 5px;
    margin-top: -4px;
}

</style>
@endsection