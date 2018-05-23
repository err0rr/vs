<?php

Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');

/*contactus start........*/
Route::get('contact/us', 'ContactusController@contactUs')->name('contactUs');
/*contactus end*/

/*Faqs start*/
Route::get('faqs', 'FaqsController@faqs')->name('faqs');
Route::get('faqs/change/status/{id}', 'FaqsController@changeStatus')->name('changeStatus');
Route::get('faqs/add', 'FaqsController@getFaqsAdd')->name('getFaqsAdd');
Route::post('faqs/store', 'FaqsController@postFaqsAdd')->name('postFaqsAdd');
Route::get('faqs/view/{id}', 'FaqsController@faqsView')->name('faqsView');
Route::get('edit/faqs/{id}', 'FaqsController@faqsEdit')->name('faqsEdit');
Route::post('edit/faqs/store/{id}', 'FaqsController@faqsEditStore')->name('faqsEditStore');
Route::get('delete/faqs/{id}', 'FaqsController@FaqsDelete')->name('FaqsDelete');


Route::post('faqs/save', 'FaqsController@postFaqsSaveFirst')->name('postFaqsSaveFirst');
Route::get('faqs/edit/form', 'FaqsController@getFaqsEditForm')->name('getFaqsEditForm');
Route::post('faqs/edit/save', 'FaqsController@postFaqsSave')->name('postFaqsSave');
/* faqs end*/
/* language start*/
/* language start*/
Route::get('language', 'LanguagesController@language')->name('language');
Route::get('language/change/status/{id}', 'LanguagesController@changeStatus')->name('changeStatus');
Route::get('language/view/{id}', 'LanguagesController@languageView')->name('languageView');
Route::get('delete/language/{id}', 'LanguagesController@languageDelete')->name('languageDelete');
Route::post('language/save', 'LanguagesController@postLanguageSaveFirst')->name('postLanguageSaveFirst');
Route::get('language/edit/form', 'LanguagesController@getLanguageEditForm')->name('getLanguageEditForm');
Route::post('language/edit/save', 'LanguagesController@postLanguageSave')->name('postLanguageSave');
/* language End */



				# Service Start
Route::get('services', 'ServicesController@getServices')->name('getServices');
Route::get('services/change/status/{id}', 'ServicesController@getChangeStatus')->name('getChangeStatus');
Route::get('services/delete/{id}', 'ServicesController@getServicesDelete')->name('getServicesDelete');
Route::post('service/save', 'ServicesController@postServiceSaveFirst')->name('postServiceSaveFirst');
Route::get('service/editform', 'ServicesController@getServiceEditForm')->name('getServiceEditForm');
Route::post('service/edit/save', 'ServicesController@postServiceSave')->name('postServiceSave');
				# Service End	
				# Seliders Start
Route::get('sliders', 'SlidersController@getSliders')->name('getSliders');
Route::get('sliders/status/{id}', 'SlidersController@getSlidersStatus')->name('getSlidersStatus');
Route::get('sliders/delete/{id}', 'SlidersController@getSlidersDelete')->name('getSlidersDelete');
Route::post('slider/save', 'SlidersController@postSliderSaveFirst')->name('postSliderSaveFirst');
Route::get('slider/edit/form', 'SlidersController@getSliderEditForm')->name('getSliderEditForm');
Route::post('slider/edit/save', 'SlidersController@postSliderSave')->name('postSliderSave');
				# Seliders End
Route::get('review', 'reviewController@review')->name('review');
Route::get('review/view/{id}', 'reviewController@reviewView')->name('reviewView');
Route::get('review/edit/form', 'reviewController@getReviewEditForm')->name('getReviewEditForm');
Route::post('review/edit/save', 'reviewController@postReviewSave')->name('postReviewSave');

 Route::get('savefeedback', 'reviewController@getSaveFeedback')->name('getSaveFeedback');


Route::get('add/timeslot', 'TimeslotController@addtimeslot')->name('addAvailableTimeSlot');
Route::post('store_available_time_slot', 'TimeslotController@storetimeslot')->name('storeAvailableTimeSlot');
Route::get('listtimeslot', 'TimeslotController@listtimeslot')->name('listtimeslot');
Route::get('timeslot/change/status/{id}', 'TimeslotController@changeStatus')->name('changeStatustimeslot');
Route::get('delete/timeslot/{id}', 'TimeslotController@timeslotDelete')->name('timeslotDelete');
Route::get('edit/timeslot/{id}', 'TimeslotController@edittimeslot')->name('editAvailableTimeSlot');
Route::post('enter/timeslot/{id}', 'TimeslotController@entertimeslot')->name('enterAvailableTimeSlot');





