<?php

/**
 * Frontend Controllers
 */
Route::get('/', 'FrontendController@index')->name('frontend.index');
Route::get('signup', 'FrontendController@signup')->name('frontend.macros');
Route::get('e-register', 'FrontendController@escortregister')->name('frontend.macros');
Route::post('e-register', 'FrontendController@postEscortregister')->name('e-register');
Route::get('faq', 'FrontendController@faq')->name('frontend.macros');

Route::get('cast/{username}', 'ProfileController@getProfile');
//Route::get('filterdata/{username?}', 'FrontendController@listFilter');
Route::get('filterdata/{query?}', 'FrontendController@getfilterdata1');
Route::get('getfilterdata/{username?}', 'FrontendController@getfilterdata');
Route::get('canton', 'FrontendController@getCanton')->name('getCanton');

Route::get('contactus', 'FrontendController@contactUs')->name('frontend.contactUs');
Route::post('postcontactus', 'FrontendController@postContactUs')->name('postContactUs');
Route::get('booking-reject', 'FrontendController@getBookingReject')->name('getBookingReject');
Route::get('setchatsession', 'FrontendController@getsetchatsession')->name('getsetchatsession');

/**
 * These frontend controllers require the user to be logged in
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User'], function() {
        Route::get('myprofile', 'DashboardController@index')->name('frontend.user.dashboard');
		
		# Ajex Function Management Start
        Route::get('user/profile/sliderImg', 'DashboardController@getUserProfileSliderImg')->name('getUserProfileSliderImg');
        Route::get('user/profile/edit', 'DashboardController@getUserProfileEdit')->name('getUserProfileEdit');
        Route::get('user/profile/edit/images', 'DashboardController@getUserProfileEditImages')->name('getUserProfileEditImages');
        Route::get('user/profile/edit/image', 'DashboardController@getUserProfileEditImage')->name('getUserProfileEditImage');
        Route::get('user/profile/edit/coverimage', 'DashboardController@getUserProfileEditCoverImage')->name('getUserProfileEditCoverImage');
        Route::get('user/profile/images/remove', 'DashboardController@getUserProfileImagesRemove')->name('getUserProfileImagesRemove');
        Route::get('user/profile/details', 'DashboardController@getUserProfileDetails')->name('getUserProfileDetails');
        Route::get('user/profile/detailsclient', 'DashboardController@getUserProfiledetailsclient')->name('getUserProfiledetailsclient');
        Route::get('user/profile/rates', 'DashboardController@getUserProfileRates')->name('getUserProfileRates');
        Route::get('user/profile/services', 'DashboardController@getUserProfileServices')->name('getUserProfileServices');
        Route::get('user/profile/languages', 'DashboardController@getUserProfileLanguages')->name('getUserProfileLanguages');
        Route::get('user/profile/edit/message', 'DashboardController@getUserProfileEditMessage')->name('getUserProfileEditMessage');
        # Ajex Function Management End
		
        Route::get('profile/edit', 'ProfileController@edit')->name('frontend.user.profile.edit');
        Route::patch('profile/update', 'ProfileController@update')->name('frontend.user.profile.update1');

        Route::get('user/booking', 'UserBookingController@userBooking')->name('user.booking');
        Route::post('user/setbooking', 'UserBookingController@setBooking')->name('user.booking.set');
        Route::get('user/booking/checkout', 'UserBookingController@checkout')->name('user.booking.checkout');
        Route::post('user/checkout/payment/process', 'UserBookingController@postCheckout')->name('user.booking.postcheckout');
       /* Route::post('user/escortRateUpdate', 'ProfileController@postescortRateUpdate')->name('escortRateUpdate');*/
        Route::get('user/changePrice', 'ProfileController@getChangePrice')->name('getChangePrice');
        
    });
    #New Booking Section Start
    Route::get('booking-escort/{username}', 'BookingController@getBookingEscort');
    Route::get('priceCalculate', 'BookingController@getPriceCalculate');
    Route::post('escortBooking', 'BookingController@postEscortBooking');
    Route::get('checkout', 'BookingController@getCheckout')->name('getCheckout');
    Route::post('checkout', 'BookingController@postCheckout')->name('postCheckout');
    Route::get('showescortprice', 'CalendarController@getShowEscortPrice')->name('getShowEscortPrice');
    
    Route::get('chnageBookingStatus', 'CalendarController@getCheckBookingStatus')->name('getCheckBookingStatus');
    
    #New Booking Section End

    Route::get('feedback', 'BookingController@getFeedback')->name('getFeedback');
    Route::get('savefeedback', 'BookingController@getSaveFeedback')->name('getSaveFeedback');


    Route::get('addgallery', 'FrontendController@addgallery')->name('frontend.user.profile.update');
	
	// start booking system management
	Route::get('/availability', 'BookingController@getAvailability')->name('frontend.user.dashboard.availability');;
	Route::get('booking/timeslot/{query?}', 'BookingController@getTimeSlot');
	Route::get('unavail/delete/{id}', 'BookingController@deleteUnAvail');
	Route::get('user/date_wise_availability/{seldate}', 'BookingController@getDateWiseAvailability');
	Route::post('user/setavail/', 'BookingController@postSetAvail');

    Route::get('calendar', 'CalendarController@index')->name('frontend.user.myprofile.calendar');
    Route::get('booking', 'CalendarController@getBooking')->name('frontend.user.myprofile.booking');
    Route::get('bookingpast', 'CalendarController@getBookingup')->name('frontend.user.myprofile.bookingup');
    
    Route::get('getfilterbooking/{query?}', 'CalendarController@getfilterupcomingbook');
    Route::get('getfilterbookingup/{query?}', 'CalendarController@getfilterbooks');
    Route::get('showbooking/{username?}', 'BookingController@getBookedmember')->name('frontend.user.getBookedmember');
    Route::get('bookinautocancel', 'BookingController@getBookingAutoCancel')->name('getBookingAutoCancel');
    Route::get('changebookstatus/{username?}', 'BookingController@changeBookStatus')->name('frontend.user.chnagebookstatus');
	
	Route::group(['prefix' => 'messages'], function () {
		Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
		Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
		Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
		Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
		Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
	});
});