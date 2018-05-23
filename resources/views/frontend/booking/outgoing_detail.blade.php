@extends('frontend.layouts.master')

@section('content')
<div class="row">
  <div class="dashboard_block faq_block">
    <div class="panel panel-default">
      <div class="panel-heading">My Friends</div>
      <div class="panel-body">
        <div role="tabpanel">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="{!!url('user/image')!!}">Tatoo Images</a></li>
            <li role="presentation" class="active"><a href="{!!url('dashboard')!!}">My Information</a></li>
            <li role="presentation" class="active"><a href="{!!url('user/myfriends')!!}" >Friends</a></li>
            <li role="presentation" class="active"><a href="{!!url('user/friendrequest')!!}">@include('frontend.user.notification-alert-friend')Friend Request</a></li>
            <li role="presentation" class="active"><a href="{!!url('user/booking')!!}">@include('frontend.user.notification-alert-booking')Booking</a></li>
            <li role="presentation" class="active"><a href="{!!url('auth/password/change')!!}">Change Password</a></li>
            <li role="presentation" class="active"><a href="{!!url('settings')!!}">Settings</a></li>
          @if ( Auth::user()->usertype != 'User') <li role="presentation" class="active"><a href="{!!url('user/availability')!!}">Availability</a></li>@endif
          </ul>
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="profile">
              <div class="conversion">
             		<div class="col-md-12 col-sm-12 message_inbox">
						<h1>Booking details: {!! ucwords($booking->subject) !!}</h1>
						<div class="state_name">
							<div class="friendfllow artist-box-ink ink_about pad-25 booking_link">
								<div class="detail_txt">
								  <label>Subject:</label> {!! ucwords($booking->subject) !!}
								</div>					
								<div class="detail_txt">
								  <label>Description:</label> {!! $booking->description !!}
								</div>
								<div class="detail_txt">
								 <label>Date Time:</label> {!! date("m/d/Y g:i A", strtotime($booking->datetime))  !!}
      				  </div>
                <li>
                    {!! link_to('user/booking_request_delete/'.$booking->id, 'Decline') !!}
                </li>
               
							 </div>
						</div>
					</div>
                
              </div>
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