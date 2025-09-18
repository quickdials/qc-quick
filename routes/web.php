<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
 
Route::auth();	
Auth::routes(); 
 
 
 //Clear Cache facade value:
Route::get('/cache-clear/', function() {

	$exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');    
    $exitCode = Artisan::call('cache:clear');    
   //$exitCode = Artisan::call('route:cache');
 Artisan::call('optimize:clear');
 
   // $exitCode = Artisan::call('optimize');
	 
    return '<h1>Cache facade value cleared</h1>';
});



 Route::post('/developer/login',[App\Http\Controllers\Auth\AuthController::class,'authenticate']);
Route::get('/developer/login',[App\Http\Controllers\Auth\AuthController::class,'showLoginForm'])->name('developer.login');
Route::get('/cities/getajaxcities',[App\Http\Controllers\CitiesController::class, 'getAjaxCities']);

 
 Route::prefix('developer')->name('developer.')->middleware(['auth:developer'])->as('developer.')->group(function () {
    require __DIR__.'/developer.php';
});
 use App\Http\Controllers\Business\BusinessController;
 use App\Http\Controllers\Business\EnquiryController;
Route::middleware('auth:clients')->group(function () {
 Auth::routes();

Route::get('/business/dashboard',[App\Http\Controllers\Business\BusinessDashboardController::class, 'dashboard'])->name('business.dashboard');
Route::get('/business-owners/get-leads',[EnquiryController::class, 'getLeads']);
Route::get('/business/enquiry',[EnquiryController::class,'enquiry']);
Route::get('/business/new-enquiry',[EnquiryController::class,'newEnquiry']);
Route::get('/business/myLead',[EnquiryController::class,'myLead']);
Route::get('/business/favorite-enquiry',[EnquiryController::class,'favoriteEnquiry']);
Route::get('/business/manage-enquiry',[EnquiryController::class,'manageEnquiry']);
Route::get('/business-owners/get-Discussion',[App\Http\Controllers\Business\BusinessDiscussionController::class, 'getDiscussion']);
Route::get('/business-owners/get-paginated-assigned-keywords',[App\Http\Controllers\Business\BusinessKeywordController::class, 'getPaginatedAssignedKeywords']);

//Route::get('/business-owners/get-paginated-payment-history',[App\Http\Controllers\Business\BusinessOwnerController::class, 'getPaginatedPaymentHistory']);

Route::post('/business-owners/export-excel',[App\Http\Controllers\Business\EnquiryController::class, 'getLeadsExcel']);

//Route::post('/business-owners/discussion',[App\Http\Controllers\Client\BusinessDiscussionController::class, 'discussion']);

Route::get('/business/personal-details',[App\Http\Controllers\Business\PersonalDetailsController::class, 'personalDetails']);
Route::get('/business/profileInfo',[App\Http\Controllers\Business\ProfileController::class, 'profileInfo']);
Route::post('/business/saveProfileInfo/{id}',[App\Http\Controllers\Business\ProfileController::class, 'saveProfileInfo']);
Route::post('/business/saveBusinessLocation/{id}',[App\Http\Controllers\Business\ProfileController::class, 'saveBusinessLocation']);
Route::post('/business/savePersonalDetails/{id}',[App\Http\Controllers\Business\PersonalDetailsController::class, 'savePersonalDetails']);

Route::get('/business/profile-logo',[App\Http\Controllers\Business\BusinessLogoController::class, 'profileLogo']);
Route::post('/business/saveProfileLogo/{id}',[App\Http\Controllers\Business\BusinessLogoController::class, 'saveProfileLogo']);
Route::get('/business/profileLogo/logoDel/{id}',[App\Http\Controllers\Business\BusinessLogoController::class, 'logoDel']);
Route::get('/business/profileLogo/profilePicDel/{id}',[App\Http\Controllers\Business\BusinessLogoController::class, 'profilePicDel']);

Route::get('/business/gallery-pictures',[App\Http\Controllers\Business\BusinessLogoController::class, 'uploadPictures']);

Route::post('/business/saveGallary',[App\Http\Controllers\Business\BusinessLogoController::class,'saveGallary']); 

Route::get('/business/location-information',[App\Http\Controllers\Business\BusinessLocationController::class, 'locationInformation']);
Route::post('/business/saveLocationInformation',[App\Http\Controllers\Business\BusinessLocationController::class, 'saveLocationInformation']);


Route::post('/business/pauseLead',[App\Http\Controllers\Business\EnquiryController::class, 'pauseLead']);
Route::post('/business/scrapLead',[App\Http\Controllers\Business\EnquiryController::class, 'scrapLead']);
Route::post('/business/readLead',[App\Http\Controllers\Business\EnquiryController::class, 'readLead']);
Route::post('/business/favoritleads',[App\Http\Controllers\Business\EnquiryController::class, 'favoritleads']);

Route::post('/business/cities/getajaxcities',[App\Http\Controllers\Client\BusinessController::class, 'getAjaxCities']);
Route::post('/business/state/getAjaxSate',[App\Http\Controllers\Client\BusinessController::class, 'getAjaxSate']);
Route::post('/business/zone/getAjaxZone',[App\Http\Controllers\Client\BusinessController::class, 'getAjaxZone']);
Route::get('/business/get-assigned-zones',[App\Http\Controllers\Client\BusinessController::class, 'getAssignedZonesPagination']);
Route::get('/business/assignZone/delete/{id}',[App\Http\Controllers\Client\BusinessController::class, 'assignZoneDelete']);
Route::post('/business/assignLocation/selectAssignZoneDelete',[App\Http\Controllers\Client\BusinessController::class, 'selectAssignZoneDelete']);


Route::get('/business/package',[App\Http\Controllers\Business\AccountController::class, 'package']);
Route::get('/business/account-settings',[App\Http\Controllers\Business\AccountController::class, 'accountSettings']);
Route::get('/business/business-location',[App\Http\Controllers\Business\BusinessLocationController::class, 'businessLocation']);

Route::get('/business/buy-package',[App\Http\Controllers\Business\AccountController::class, 'buyPackage']);

Route::get('/business/billing-history',[App\Http\Controllers\Business\InvoiceController::class, 'billingHistory']);

Route::get('/business/get-billing-history',[App\Http\Controllers\Business\InvoiceController::class, 'getBillingHistory']);

Route::get('/business/getinvoiceBillingPrintPdf',[App\Http\Controllers\Business\InvoiceController::class, 'getinvoiceBillingPrintPdf']);

Route::get('/business/coinsHistory',[App\Http\Controllers\Business\InvoiceController::class, 'coinsHistory']);

Route::get('/business/get-paginated-payment-history',[App\Http\Controllers\Business\InvoiceController::class, 'getPaginatedPaymentHistory']);


 Route::get('/business/help',[App\Http\Controllers\Client\BusinessController::class,'help']);
 Route::get('/business/businessActiveStatus/{id}/{val}',[App\Http\Controllers\Client\BusinessController::class,'businessActiveStatus']);
 
 Route::get('/business/get-enquiry',[App\Http\Controllers\Business\EnquiryController::class,'getEnquiry']);
 Route::get('/business/enquiry/follow-up/{id}',[App\Http\Controllers\Business\EnquiryController::class,'followUp']);
 Route::post('/business/enquiry/store-follow-up/{id}',[App\Http\Controllers\Business\EnquiryController::class,'storeFollowUp']);
 Route::get('/business/enquiry/getfollowups/{id}',[App\Http\Controllers\Business\EnquiryController::class,'getFollowUps']);  


 Route::get('/business/keywords',[App\Http\Controllers\Business\BusinessKeywordController::class,'keywords']); 


 Route::post('/business/saveKeywordAssign/{id}',[App\Http\Controllers\Business\BusinessKeywordController::class,'saveKeywordAssign']); 
 Route::get('/business/assignKeyword/delete/{id}',[App\Http\Controllers\Business\BusinessKeywordController::class, 'assignKeywordDelete']);
Route::get('/business/get-paginated-assigned-keywords',[App\Http\Controllers\Business\BusinessKeywordController::class, 'getPaginatedAssignedKeywords']);


 Route::get('/business/coins-history',[App\Http\Controllers\Business\InvoiceController::class,'coinsHistory']);
 


/* Change Password - CLIENT */
	Route::get('/business-owners/changepassword',[App\Http\Controllers\Client\ChangePasswordController::class, 'create']);
	Route::post('/business-owners/changepassword',[App\Http\Controllers\Client\ChangePasswordController::class, 'store']);
/* Change Password - CLIENT */

/* Change Password - CLIENT */
 Route::get('/business/pay-deposit',[App\Http\Controllers\Client\razorpayController::class,'payDeposit']);
 Route::get('/business/subscribe-free',[App\Http\Controllers\Client\razorpayController::class,'subscribeFree']);
 Route::post('/business/saveSubscribeFree/{id}',[App\Http\Controllers\Client\razorpayController::class,'saveSubscribeFree']);
 Route::post('/business/razorPayCheckout',[App\Http\Controllers\Client\razorpayController::class,'razorPayCheckout']);
 Route::post('/business/save-processing',[App\Http\Controllers\Client\razorpayController::class,'saveProcessing']);
 Route::get('/business/success',[App\Http\Controllers\Client\razorpayController::class,'success']);
 Route::get('/business/failed',[App\Http\Controllers\Client\razorpayController::class,'failed']);

	
	 
/* Reset Password - CLIENT */
	Route::get('/resetp', [App\Http\Controllers\Client\ChangePasswordController::class, 'forgotPassword']);
/* Reset Password - CLIENT */
});
 
	Route::post('/register',[App\Http\Controllers\Auth\AuthController::class,'register']);
	
	//businees
	Route::get('/business-owners',[App\Http\Controllers\Client\BusinessOwnerController::class, 'index'])->name('login');
	Route::post('/business-owners',[App\Http\Controllers\Client\BusinessOwnerController::class, 'store']);
	
  	Route::get('/sitemap', [App\Http\Controllers\SitemapsController::class, 'index']);
  	
  	Route::get('/sitemap-noida',[App\Http\Controllers\SitemapsController::class, 'noida']);
	Route::get('/sitemap-delhi',[App\Http\Controllers\SitemapsController::class, 'delhi']);
    Route::get('/sitemap-gurgaon',[App\Http\Controllers\SitemapsController::class, 'gurgaon']);
    Route::get('/sitemap-faridabad',[App\Http\Controllers\SitemapsController::class, 'faridabad']);
    Route::get('/sitemap-ghaziabad',[App\Http\Controllers\SitemapsController::class, 'ghaziabad']);
    Route::get('/sitemap-mumbai',[App\Http\Controllers\SitemapsController::class, 'mumbai']);
    Route::get('/sitemap-pune',[App\Http\Controllers\SitemapsController::class, 'pune']);				
	Route::get('/sitemap-greaterNoida',[App\Http\Controllers\SitemapsController::class, 'greaterNoida']);
    Route::get('/sitemap-chandigarh',[App\Http\Controllers\SitemapsController::class, 'chandigarh']);
    Route::get('/sitemap-meerut',[App\Http\Controllers\SitemapsController::class, 'meerut']);
    Route::get('/sitemap-bangalore',[App\Http\Controllers\SitemapsController::class, 'bangalore']);
    Route::get('/sitemap-ahmedabad',[App\Http\Controllers\SitemapsController::class, 'ahmedabad']);
    Route::get('/sitemap-patna',[App\Http\Controllers\SitemapsController::class, 'patna']);
    Route::get('/sitemap-chennai',[App\Http\Controllers\SitemapsController::class, 'chennai']);
  			
  	Route::get('/sitemap-moradabad', function () {
		return response()->view('client.sitemap-common',['city'=>'moradabad'])->header('Content-Type', 'text/xml');
	});
	
  	Route::get('/sitemap-kochi', function () {
		return response()->view('client.sitemap-common',['city'=>'kochi'])->header('Content-Type', 'text/xml');
	});

	Route::get('/sitemap-jaipur', function () {
		return response()->view('client.sitemap-common',['city'=>'jaipur'])->header('Content-Type', 'text/xml');
	});
	Route::get('/sitemap-kolkata', function () {
		return response()->view('client.sitemap-common',['city'=>'kolkata'])->header('Content-Type', 'text/xml');
	});
  	Route::get('/sitemap-ballia', function () {
		return response()->view('client.sitemap-common',['city'=>'ballia'])->header('Content-Type', 'text/xml');
	});

  	Route::get('/sitemap-agra', function () {
		return response()->view('client.sitemap-common',['city'=>'agra'])->header('Content-Type', 'text/xml');
	});
	
  	Route::get('/sitemap-amritsar', function () {
		return response()->view('client.sitemap-common',['city'=>'amritsar'])->header('Content-Type', 'text/xml');
	});
	
  	Route::get('/sitemap-aurangabad', function () {
		return response()->view('client.sitemap-common',['city'=>'aurangabad'])->header('Content-Type', 'text/xml');
	});
	
  	Route::get('/sitemap-bhopal', function () {
		return response()->view('client.sitemap-common',['city'=>'bhopal'])->header('Content-Type', 'text/xml');
	});
	
  	Route::get('/sitemap-ludhiana', function () {
		return response()->view('client.sitemap-common',['city'=>'ludhiana'])->header('Content-Type', 'text/xml');
	});
	
  	Route::get('/sitemap-bhubaneswar', function () {
		return response()->view('client.sitemap-common',['city'=>'bhubaneswar'])->header('Content-Type', 'text/xml');
	});
  	Route::get('/sitemap-madurai', function () {
		return response()->view('client.sitemap-common',['city'=>'madurai'])->header('Content-Type', 'text/xml');
	});

  	Route::get('/sitemap-coimbatore', function () {
		return response()->view('client.sitemap-common',['city'=>'coimbatore'])->header('Content-Type', 'text/xml');
	});

  	Route::get('/sitemap-dhanbad', function () {
		return response()->view('client.sitemap-common',['city'=>'dhanbad'])->header('Content-Type', 'text/xml');
	});

  	Route::get('/sitemap-prayagraj', function () {
		return response()->view('client.sitemap-common',['city'=>'prayagraj'])->header('Content-Type', 'text/xml');
	});
	
  	Route::get('/sitemap-raipur', function () {
		return response()->view('client.sitemap-common',['city'=>'raipur'])->header('Content-Type', 'text/xml');
	});

   	Route::get('/sitemap-rajkot', function () {
		return response()->view('client.sitemap-common',['city'=>'rajkot'])->header('Content-Type', 'text/xml');
	});

   	Route::get('/sitemap-kota', function () {
		return response()->view('client.sitemap-common',['city'=>'kota'])->header('Content-Type', 'text/xml');
	});
	
   	Route::get('/sitemap-kanpur', function () {
		return response()->view('client.sitemap-common',['city'=>'kanpur'])->header('Content-Type', 'text/xml');
	});

   	Route::get('/sitemap-jodhpur', function () {
		return response()->view('client.sitemap-common',['city'=>'jodhpur'])->header('Content-Type', 'text/xml');
	});

   	Route::get('/sitemap-jhansi', function () {
		return response()->view('client.sitemap-common',['city'=>'jhansi'])->header('Content-Type', 'text/xml');
	});
 
	Route::get('/sitemap-ranchi', function () {
		return response()->view('client.sitemap-common',['city'=>'ranchi'])->header('Content-Type', 'text/xml');
	});
 
 
	Route::get('/sitemap-srinagar', function () {
		return response()->view('client.sitemap-common',['city'=>'srinagar'])->header('Content-Type', 'text/xml');
	});
 
 
	Route::get('/sitemap-surat', function () {
		return response()->view('client.sitemap-common',['city'=>'surat'])->header('Content-Type', 'text/xml');
	});
 
 
	Route::get('/sitemap-thane', function () {
		return response()->view('client.sitemap-common',['city'=>'thane'])->header('Content-Type', 'text/xml');
	});
 
 
	Route::get('/sitemap-tiruchirappalli', function () {
		return response()->view('client.sitemap-common',['city'=>'tiruchirappalli'])->header('Content-Type', 'text/xml');
	});
 
	Route::get('/sitemap-udaipur', function () {
		return response()->view('client.sitemap-common',['city'=>'udaipur'])->header('Content-Type', 'text/xml');
	});
 
	Route::get('/sitemap-vadodara', function () {
		return response()->view('client.sitemap-common',['city'=>'vadodara'])->header('Content-Type', 'text/xml');
	});
 
	Route::get('/sitemap-varanasi', function () {
		return response()->view('client.sitemap-common',['city'=>'varanasi'])->header('Content-Type', 'text/xml');
	});

	Route::get('/sitemap-nashik', function () {
		return response()->view('client.sitemap-common',['city'=>'nashik'])->header('Content-Type', 'text/xml');
	});

	Route::get('/sitemap-nagpur', function () {
		return response()->view('client.sitemap-common',['city'=>'nagpur'])->header('Content-Type', 'text/xml');
	});
	Route::get('/sitemap-mysuru', function () {
		return response()->view('client.sitemap-common',['city'=>'mysuru'])->header('Content-Type', 'text/xml');
	});
 
 
	Route::get('/sitemap-vijayawada', function () {
		return response()->view('client.sitemap-common',['city'=>'vijayawada'])->header('Content-Type', 'text/xml');
	});
 
	Route::get('/sitemap-visakhapatnam', function () {
		return response()->view('client.sitemap-common',['city'=>'visakhapatnam'])->header('Content-Type', 'text/xml');
	});
 
 
	Route::get('/sitemap-jamshedpur', function () {
		return response()->view('client.sitemap-common',['city'=>'jamshedpur'])->header('Content-Type', 'text/xml');
	});
 
 
 
	Route::get('/sitemap-jabalpur', function () {
		return response()->view('client.sitemap-common',['city'=>'jabalpur'])->header('Content-Type', 'text/xml');
	});
 
 
	Route::get('/sitemap-gwalior', function () {
		return response()->view('client.sitemap-common',['city'=>'gwalior'])->header('Content-Type', 'text/xml');
	});
 
	Route::get('/sitemap-guwahati', function () {
		return response()->view('client.sitemap-common',['city'=>'guwahati'])->header('Content-Type', 'text/xml');
	});
 
 
 
	Route::get('/sitemap-indore', function () {
		return response()->view('client.sitemap-common',['city'=>'indore'])->header('Content-Type', 'text/xml');
	});
 
 
	Route::get('/sitemap-gorakhpur', function () {
		return response()->view('client.sitemap-common',['city'=>'gorakhpur'])->header('Content-Type', 'text/xml');
	});
 
 
 
	Route::get('/quickdialssitemap.xml', function () {
		return response()->view('client.quickdialssitemap')->header('Content-Type', 'text/xml');
	});
 



Route::get('/ads/study-abroad',[App\Http\Controllers\Client\LandingPageController::class, 'studyabroad']);
Route::post('/apiddd/lead/add',[App\Http\Controllers\Client\HomePageController::class, 'addLadsss']);


Route::get('/coaching/distance-education',[App\Http\Controllers\Client\LandingPageController::class, 'distance_education']);
Route::get('/coaching/foreign-language',[App\Http\Controllers\Client\LandingPageController::class, 'foreign_language']);
Route::get('/coaching/multimedia',[App\Http\Controllers\Client\LandingPageController::class, 'multimedia']);
Route::get('/coaching/it-training',[App\Http\Controllers\Client\LandingPageController::class, 'it_training']);
Route::get('/coaching/iit-entrance-exam',[App\Http\Controllers\Client\LandingPageController::class, 'iit_entrance_exam']);
Route::get('/coaching/entrance-exam-coaching',[App\Http\Controllers\Client\LandingPageController::class, 'entrance_exam_coaching']);
Route::get('/coaching/thank',[App\Http\Controllers\Client\LandingPageController::class, 'thankyou']);

Route::get('/ads/entrance-exam-coaching',[App\Http\Controllers\Client\LandingPageController::class, 'entranceexamcoaching']);
Route::get('/ads/distance-education',[App\Http\Controllers\Client\LandingPageController::class, 'distanceeducation']);
Route::get('/ads/it-training',[App\Http\Controllers\Client\LandingPageController::class, 'ittraining']);
Route::get('/free-course/landing',[App\Http\Controllers\Client\LandingPageController::class, 'index']);

Route::get('/email', [App\Http\Controllers\EmailController::class, 'index']); 
  
Route::get('/about-us',[App\Http\Controllers\Official\OfficialController::class, 'about']); 
Route::get('/news',[App\Http\Controllers\Official\OfficialController::class, 'news']); 
Route::get('/rss', [App\Http\Controllers\Official\OfficialController::class, 'rss']); 
Route::get('/features',[App\Http\Controllers\Official\OfficialController::class, 'features']); 
Route::get('/faq', [App\Http\Controllers\Official\OfficialController::class, 'faq']); 
Route::get('/contact-us', [App\Http\Controllers\Official\OfficialController::class, 'contact']); 
Route::get('/careers', [App\Http\Controllers\Official\OfficialController::class, 'careers']); 
Route::get('/pricing', [App\Http\Controllers\Official\OfficialController::class, 'pricing']); 
Route::get('/media', [App\Http\Controllers\Official\OfficialController::class, 'media']); 
Route::get('/advertise', [App\Http\Controllers\Official\OfficialController::class, 'advertise']); 
Route::get('/blog',[App\Http\Controllers\Official\OfficialController::class, 'blog']); 
Route::get('/official/blog-details',[App\Http\Controllers\Official\OfficialController::class, 'blogdetails']); 
Route::get('/blog/{slug}', [App\Http\Controllers\Official\OfficialController::class, 'blogdetails']); 
Route::get('/subscribe',[App\Http\Controllers\Official\OfficialController::class, 'subscribe']); 
Route::get('/testimonials', [App\Http\Controllers\Official\OfficialController::class, 'testimonials']); 
Route::get('/terms-conditions', [App\Http\Controllers\Official\OfficialController::class, 'termsconditions']); 
Route::get('/privacy-policy', [App\Http\Controllers\Official\OfficialController::class, 'privacypolicy']); 
Route::get('/copyright-policy', [App\Http\Controllers\Official\OfficialController::class, 'copyrightpolicy']); 
	
	

	Route::get('/', [App\Http\Controllers\Client\HomePageController::class, 'index']);
	
	Route::post('/newsletter', [App\Http\Controllers\Client\HomePageController::class, 'newsletter']);
	
	Route::get('/{html}.html', [App\Http\Controllers\Client\HomePageController::class, 'callHtml']);
	Route::get('/business-services', [App\Http\Controllers\Client\HomePageController::class, 'businessServices']);
	Route::get('/getKWList', [App\Http\Controllers\Client\HomePageController::class, 'getKWList']);
	Route::get('/getCityKWList', [App\Http\Controllers\Client\HomePageController::class, 'getCityKWList']); 
	Route::get('/getCityList', [App\Http\Controllers\Client\HomePageController::class, 'getCountryCode']);
	
	Route::get('/disclaimer',function(){return view('client.disclaimer');});
	 
	 
 
	Route::post('/kw/search', [App\Http\Controllers\Client\HomePageController::class, 'searchKW']);
	Route::get('/kw/search/cc', [App\Http\Controllers\Client\HomePageController::class, 'searchKWcc']);
	
	



/*login otp mobile */
Route::get('/client-login',[App\Http\Controllers\ClientAuth\AuthController::class, 'clientLogin']);
Route::post('/client-login', [App\Http\Controllers\ClientAuth\AuthController::class,'clientLoginPost'])->name('client.login');

	Route::get('/client-detail/{slug}', [App\Http\Controllers\Client\ClientDetailController::class, 'index']);
	Route::get('/business-details/{slug}', [App\Http\Controllers\Client\ClientDetailController::class, 'index']);
	
	Route::post('/review',[App\Http\Controllers\Client\ReviewController::class, 'store']);
	Route::get('/client/logout', [App\Http\Controllers\LogoutController::class, 'clientLogout']);
	Route::get('/clients', [App\Http\Controllers\Client\HomePageController::class, 'clientCategories']);
	Route::get('/category', [App\Http\Controllers\Client\HomePageController::class, 'category']);
	Route::get('/categories/{slug}', [App\Http\Controllers\Client\HomePageController::class, 'categories']);
	Route::get('/child/{slug}', [App\Http\Controllers\Client\HomePageController::class, 'child']);
	//Route::get('/{city}/categories/{slug}/', [App\Http\Controllers\Client\HomePageController::class, 'cityCategories']);
	//Route::get('/{city}/categories/{parentslug}/{childslug}/', [App\Http\Controllers\Client\HomePageController::class, 'subcategories']);
	Route::get('/clients/{slug}', [App\Http\Controllers\Client\HomePageController::class, 'clients']);
	Route::get('/{city}/', [App\Http\Controllers\Client\HomePageController::class, 'city']);
	 
	
 
	Route::get('/{city}/{search_kw}/', [App\Http\Controllers\Client\SearchListController::class, 'index']);
	 
	  
	//Route::get('/{city}/{search_kw}/',['as'=>'search-list','uses'=>'Client\SearchListController@index']);
	Route::POST('/client/lead/add-lead/', [App\Http\Controllers\Client\HomePageController::class, 'store']);
	Route::POST('/client/lead/saveTwoEnquiry', [App\Http\Controllers\Client\HomePageController::class, 'saveTwoEnquiry']);
	Route::POST('/client/lead/saveEnquiry', [App\Http\Controllers\Client\HomePageController::class, 'saveEnquiryWithoutZone']);
	Route::POST('/client/lead/saveEnquiryContact', [App\Http\Controllers\Client\HomePageController::class, 'saveEnquiryContact']);
	 
	 	 
	Route::POST('/lead/auto-form-save', [App\Http\Controllers\Client\HomePageController::class, 'autoFormSave']);
	Route::POST('/{city}/lead/auto-form-save', [App\Http\Controllers\Client\HomePageController::class, 'autoFormSave']);










