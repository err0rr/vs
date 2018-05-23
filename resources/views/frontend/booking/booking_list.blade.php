@extends('frontend.layouts.master')

@section('content')
<div class="">
  <div class="dashboard_block faq_block">
    <div class="panel panel-default">
      <div class="panel-heading">Booking</div>
      <div class="panel-body">
        <div role="tabpanel">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="{!!url('user/image')!!}">Tattoo Images</a></li>
            <li role="presentation" class="active"><a href="{!!url('dashboard')!!}">My Information</a></li>
            <?php /*  <li role="presentation" class="active"><a href="{!!url('user/myfriends')!!}"> @include('frontend.user.notification-alert-myfriends') {!! env('FRIEND_LIST') !!}</a></li>*/ ?>
            <li role="presentation" class="active"><a href="{!!url('user/friendrequest')!!}">@include('frontend.user.notification-alert-friend'){!! env('FRIEND_LIST') !!} Request</a></li>
            <li role="presentation" class="active"><a href="{!!url('user/booking')!!}"  id="selected">Booking @if ( Auth::user()->usertype == 'User') <span class="badge">{!! count($booking_accept_arr) !!}</span> @else @include('frontend.user.notification-alert-booking') @endif</a></li>
             <?php /* <li role="presentation" class="active"><a href="{!!url('auth/password/change')!!}">Change Password</a></li> */ ?>
            <li role="presentation" class="active"><a href="{!!url('settings')!!}">Settings</a></li>
         @if ( Auth::user()->usertype != 'User') <li role="presentation" class="active"><a href="{!!url('user/availability')!!}">Availability</a></li>@endif
          </ul>
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="profile">
              @if ( Auth::user()->usertype == 'User')
                  <div class="conversion">
              @else
                  <div class="conversion conversion-left">
              @endif
                    <h3>Booking <span class="badge">{!! count($booking_accept_arr) !!}</span></h3>
                    @if (count($booking_accept_arr) > 0 || count($booking_outgoing_request_arr) > 0 )
                        @foreach($booking_accept_arr as $booking)
                          <div class="media"> <span> <a href="{{URL::to('/'.$booking->username)}}" data-toggle='tooltip' title data-original-title="{!! $booking->name !!}"> {!! HTML::image('/img/frontend/users/'.$booking->profile_pic,'',array("class"=>"")) !!} </a> </span>
                              <p class="username">{!! link_to('/' . $booking->username, ucwords($booking->firstname.' '.$booking->lastname)) !!}</p>
                    					<p>{!! date("m/d/Y g:i A", strtotime($booking->datetime))  !!}</p>
                            <div class="dropup">
                  						<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Booked <span class="caret"></span> </button><ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                  						  <li>{!! link_to('user/booking_details/'.$booking->id, 'Show Details') !!}</li>
                  						</ul>
                  			</div>
                          </div>
                        @endforeach
                   <?php /* This loop use for sending booking request by Auth user   */ ?>
                      @foreach($booking_outgoing_request_arr as $booking)
                        <div class="media"> <span> <a href="{{URL::to('/'.$booking->username)}}" data-toggle='tooltip' title data-original-title="{!! $booking->name !!}"> {!! HTML::image('/img/frontend/users/'.$booking->profile_pic,'',array("class"=>"")) !!} </a> </span>
                            <p class="username">{!! link_to('/' . $booking->username, ucwords($booking->firstname.' '.$booking->lastname)) !!}</p>
                            <p>{!! date("m/d/Y g:i A", strtotime($booking->datetime))  !!}</p>
                          <div class="dropup">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Pending outgoing Request <span class="caret"></span> </button><ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                              <li>{!! link_to('user/booking_request_delete/'.$booking->id, 'Cancel') !!}</li>
                              <li>{!! link_to('user/booking_details/'.$booking->id, 'Show Details') !!}</li>
                            </ul>
                          </div>
                        </div>
                      @endforeach
                    @else
                        <p style="color:red;font-size:15px;text-align:center;"><i>Sorry, No Booking !!.</i></p>
                    @endif 
              </div><!--conversion conversion-left-->

        @if ( Auth::user()->usertype != 'User')
              <div class="conversion-right" style="width:48%; float:left; padding-right:10px;">
                    <h3>Booking Request  <span class="badge">{!! count($booking_incoming_request_arr) !!}</span></h3>
                    @if (count($booking_incoming_request_arr) > 0)
                      @foreach($booking_incoming_request_arr as $booking)
                        <div class="media"> <span> <a href="{{URL::to('/'.$booking->username)}}" data-toggle='tooltip' title data-original-title="{!! $booking->name !!}"> {!! HTML::image('/img/frontend/users/'.$booking->profile_pic,'',array("class"=>"")) !!} </a> </span>
                            <p class="username">{!! link_to('/' . $booking->username, ucwords($booking->firstname.' '.$booking->lastname)) !!}</p>
                            <p>{!! date("m/d/y g:i A", strtotime($booking->datetime))  !!}</p>
                          <div class="dropup">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Pending Incoming Request <span class="caret"></span> </button><ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                              <li>{!! link_to('user/booking_request_response/'.$booking->confirmation_code, 'Accept') !!}</li>
                              <li>{!! link_to('user/booking_request_delete/'.$booking->id, 'Decline') !!}</li>
                              <li>{!! link_to('user/booking_details/'.$booking->id, 'Show Details') !!}</li>
                            </ul>
                          </div>
                        </div>
                      @endforeach
                    @else
                         <p style="color:red;font-size:15px;text-align:center;"><i>Sorry, No booking Incoming Request found!.</i></p>
                    @endif 
              </div>
          @endif
            </div>
            <!--tab panel profile-->
          </div>
          <!--tab content-->
        </div>
        <!--tab panel-->
      </div>
      <!--panel body-->
    </div>
    <!-- panel -->
  </div>
  <!-- col-md-10 -->
</div>
<!-- row -->
@endsection