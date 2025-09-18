<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LeadBusinessController;
use App\Http\Controllers\Api\ProfileController;
 use App\Http\Controllers\Api\EnquiryController;
Route::get('/token', [AuthController::class, 'refresh']);
Route::post('/login', [AuthController::class, 'login']);
 

Route::middleware('auth:sanctum')->group(function () {
Route::get('/business/profileInfo', [ProfileController::class, 'profileInfo']);
Route::get('/business/dashboard',[App\Http\Controllers\Api\BusinessDashboardController::class, 'dashboard'])->name('business.dashboard');
Route::get('/business/get-leads',[EnquiryController::class, 'getLeads']);
Route::get('/business/enquiry',[EnquiryController::class,'enquiry']);
Route::get('/business/new-enquiry',[EnquiryController::class,'newEnquiry']);
Route::get('/business/myLead',[EnquiryController::class,'myLead']);
Route::get('/business/favorite-enquiry',[EnquiryController::class,'favoriteEnquiry']);
Route::get('/business/manage-enquiry',[EnquiryController::class,'manageEnquiry']);
Route::get('/business/get-Discussion',[App\Http\Controllers\Api\BusinessDiscussionController::class, 'getDiscussion']);
Route::get('/business-owners/get-paginated-assigned-keywords',[App\Http\Controllers\Api\BusinessKeywordController::class, 'getPaginatedAssignedKeywords']);
 
Route::get('/business/personal-details',[App\Http\Controllers\Api\PersonalDetailsController::class, 'personalDetails']);
 
Route::post('/business/saveProfileInfo',[App\Http\Controllers\Api\ProfileController::class, 'saveProfileInfo']);
Route::post('/business/saveBusinessLocation',[App\Http\Controllers\Api\ProfileController::class, 'saveBusinessLocation']);
Route::post('/business/savePersonalDetails',[App\Http\Controllers\Api\PersonalDetailsController::class, 'savePersonalDetails']);

Route::get('/business/profile-logo',[App\Http\Controllers\Api\BusinessLogoController::class, 'profileLogo']);
Route::post('/business/saveProfileLogo',[App\Http\Controllers\Api\BusinessLogoController::class, 'saveProfileLogo']);
Route::get('/business/profileLogo/logoDel',[App\Http\Controllers\Api\BusinessLogoController::class, 'logoDel']);
Route::get('/business/profileLogo/profilePicDel',[App\Http\Controllers\Api\BusinessLogoController::class, 'profilePicDel']);

Route::get('/business/gallery-pictures',[App\Http\Controllers\Api\BusinessLogoController::class, 'uploadPictures']);

Route::post('/business/saveGallary',[App\Http\Controllers\Api\BusinessLogoController::class,'saveGallary']); 

Route::get('/business/location-information',[App\Http\Controllers\Api\BusinessLocationController::class, 'locationInformation']);
Route::post('/business/saveLocationInformation',[App\Http\Controllers\Api\BusinessLocationController::class, 'saveLocationInformation']);


Route::post('/business/pauseLead',[App\Http\Controllers\Api\EnquiryController::class, 'pauseLead']);
Route::post('/business/scrapLead',[App\Http\Controllers\Api\EnquiryController::class, 'scrapLead']);
Route::post('/business/readLead',[App\Http\Controllers\Api\EnquiryController::class, 'readLead']);
Route::post('/business/favoritleads',[App\Http\Controllers\Api\EnquiryController::class, 'favoritleads']);

Route::post('/business/cities/getajaxcities',[App\Http\Controllers\Api\BusinessController::class, 'getAjaxCities']);
Route::post('/business/state/getAjaxSate',[App\Http\Controllers\Api\BusinessController::class, 'getAjaxSate']);
Route::post('/business/zone/getAjaxZone',[App\Http\Controllers\Api\BusinessController::class, 'getAjaxZone']);
Route::get('/business/get-assigned-zones',[App\Http\Controllers\Api\BusinessController::class, 'getAssignedZonesPagination']);
Route::get('/business/assignZone/delete/{id}',[App\Http\Controllers\Api\BusinessController::class, 'assignZoneDelete']);
Route::post('/business/assignLocation/selectAssignZoneDelete',[App\Http\Controllers\Api\BusinessController::class, 'selectAssignZoneDelete']);


Route::get('/business/package',[App\Http\Controllers\Api\AccountController::class, 'package']);
Route::get('/business/account-settings',[App\Http\Controllers\Api\AccountController::class, 'accountSettings']);
Route::get('/business/business-location',[App\Http\Controllers\Api\BusinessLocationController::class, 'businessLocation']);

Route::get('/business/buy-package',[App\Http\Controllers\Api\AccountController::class, 'buyPackage']);

Route::get('/business/billing-history',[App\Http\Controllers\Api\InvoiceController::class, 'billingHistory']);

Route::get('/business/get-billing-history',[App\Http\Controllers\Api\InvoiceController::class, 'getBillingHistory']);

Route::get('/business/getinvoiceBillingPrintPdf',[App\Http\Controllers\Api\InvoiceController::class, 'getinvoiceBillingPrintPdf']);

Route::get('/business/coinsHistory',[App\Http\Controllers\Api\InvoiceController::class, 'coinsHistory']);

Route::get('/business/get-paginated-payment-history',[App\Http\Controllers\Api\InvoiceController::class, 'getPaginatedPaymentHistory']);


 Route::get('/business/help',[App\Http\Controllers\Api\BusinessController::class,'help']);
 Route::get('/business/businessActiveStatus/{id}/{val}',[App\Http\Controllers\Api\BusinessController::class,'businessActiveStatus']);
 
 Route::get('/business/get-enquiry',[App\Http\Controllers\Api\EnquiryController::class,'getEnquiry']);
 Route::get('/business/enquiry/follow-up/{id}',[App\Http\Controllers\Api\EnquiryController::class,'followUp']);
 Route::post('/business/enquiry/store-follow-up/{id}',[App\Http\Controllers\Api\EnquiryController::class,'storeFollowUp']);
 Route::get('/business/enquiry/getfollowups/{id}',[App\Http\Controllers\Api\EnquiryController::class,'getFollowUps']);  


 Route::get('/business/keywords',[App\Http\Controllers\Api\BusinessKeywordController::class,'keywords']); 


Route::post('/business/saveKeywordAssign/{id}',[App\Http\Controllers\Api\BusinessKeywordController::class,'saveKeywordAssign']); 
Route::delete('/business/assignKeyword/delete/{id}',[App\Http\Controllers\Api\BusinessKeywordController::class, 'assignKeywordDelete']);
Route::get('/business/get-paginated-assigned-keywords',[App\Http\Controllers\Api\BusinessKeywordController::class, 'getPaginatedAssignedKeywords']);


 Route::get('/business/coins-history',[App\Http\Controllers\Api\InvoiceController::class,'coinsHistory']);
 


});

 