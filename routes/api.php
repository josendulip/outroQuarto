<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Settings\AdditionalController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Services\AnnounceController;
use App\Http\Controllers\Services\PropertyController;
use App\Http\Controllers\Services\HomeController; 
use App\Http\Controllers\Services\SearchController; 
use App\Http\Controllers\Services\MyHousesController; 
use App\Http\Controllers\Services\StatisticController;

use App\Http\Controllers\Services\HouseReviewsController;
use App\Http\Controllers\Services\AppointmentController;
use App\Http\Controllers\Services\FavouriteController;
use App\Http\Controllers\Services\HistoryController;
use App\Http\Controllers\Services\ScheduleController;
use App\Http\Controllers\Services\PromoteController;
use App\Http\Controllers\Services\VerificateController;


use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PropertiesController;
use App\Http\Controllers\Admin\SuggestedPropertyController;
use App\Http\Controllers\Admin\ScheduleServiceController;

use App\Http\Controllers\Services\SuggestController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('user', [UserController::class, 'current']);

    Route::patch('settings/profile', [ProfileController::class, 'update']);
    Route::patch('settings/password', [PasswordController::class, 'update']);
    Route::patch('settings/additional', [AdditionalController::class, 'update']);
    Route::post('/upload-photo', [ProfileController::class, 'uploadPhoto']);
    Route::patch('/profile-info', [ProfileController::class, 'uploadInfo']);
    Route::post('/become-an-advertiser', [ProfileController::class, 'becomeAdvertiser']);
    
    /* Route::post('announce', [AnnounceController::class, 'create']);
    Route::post('property-images', [AnnounceController::class, 'storeImage']); */

    Route::post('save-property', [PropertyController::class, 'create']);
    Route::post('property-images', [PropertyController::class, 'storeImage']);
    Route::get('get-owner-property/{slug}', [PropertyController::class, 'getOwnerProperty']);
    Route::post('delete-house/{id}', [PropertyController::class, 'destroy']);


    Route::apiResources(['request-promo' => PromoteController::class]);
    Route::apiResources(['request-verification' => VerificateController::class]);


    Route::get('home-houses', [HomeController::class, 'index']);
    Route::get('view/{houseCode}', [HomeController::class, 'getHouse'])->name('view.house');
    Route::get('get-photos/{houseCode}', [HomeController::class, 'getPhotos']);
    Route::get('searched-houser', [HomeController::class, 'searchedhouses'])->name('search');
    Route::get('search-houser', [HomeController::class, 'searchHouser']);

    
    Route::get('my-houses', [MyHousesController::class, 'index']);
    Route::get('edit-my-house/{houseCode}', [MyHousesController::class, 'editMyHouse'])->name('edit.my.house');
    Route::post('update-house/{houseCode}', [MyHousesController::class, 'updateMyHouse']);
    Route::post('change-profile-house-picture/', [MyHousesController::class, 'changeProfileHousePicture']);
    Route::post('upload-house-photos/', [MyHousesController::class, 'uploadPhotos']);
    Route::post('delete-image/{id}', [MyHousesController::class, 'destroy']);  
    Route::get('has-photos/{house}', [MyHousesController::class, 'hasPhotos']);


    Route::post('house-statistic', [StatisticController::class, 'index']);
    Route::post('save-views/{house_code}', [StatisticController::class, 'saveViews']);
    
    Route::get('my-schedules', [ScheduleController::class, 'mySchedules']);
    Route::get('my-schedules-user', [ScheduleController::class, 'mySchedulesUser']);
    Route::get('count-schedules', [ScheduleController::class, 'countSchedules']);
    Route::get('user-count-schedules', [ScheduleController::class, 'userCountSchedules']);
    Route::get('get-schedule/{id}', [ScheduleController::class, 'getSchedule']);
    Route::get('owner-property/{id}', [ScheduleController::class, 'ownerProperty']);
    Route::post('confirm-schedule/{id}', [ScheduleController::class, 'confirmSchedule']);
    Route::post('reschedule/{id}', [ScheduleController::class, 'Reschedule']);
    Route::post('confirm-each/{id}', [ScheduleController::class, 'confirmEachFrromAllMsg']);

    Route::post('send-request-to-visit', [ScheduleController::class, 'scheduleVisits']);
    Route::post('my-schedule/{id}', [ScheduleController::class, 'deleteItem']);
    
    //Route::resource('review', HouseReviewsController::class);
    Route::apiResources(['review' => HouseReviewsController::class]);
    Route::get('get-star-rating/{house_code}', [HouseReviewsController::class, 'getStarRating']);
    Route::get('get-review/{house_code}', [HouseReviewsController::class, 'getReview']);

    Route::get('get-user', [AppointmentController::class, 'getUser']);
    Route::post('appointment', [AppointmentController::class, 'store']);
    Route::post('work-with-us', [AppointmentController::class, 'workWithUs']);
    
    Route::post('favourite/{houseCode}', [FavouriteController::class, 'favourite']);  
    Route::get('favourites-houses', [FavouriteController::class, 'favouriteHouses']);
    
    Route::get('histories-houses', [HistoryController::class, 'index']);
    Route::post('create-history/{houseCode}', [HistoryController::class, 'create']);
    Route::post('delete-history/{id}', [HistoryController::class, 'dropHistory']);

    //ADMIN ROUTERS
    Route::apiResources(['my-users' => UsersController::class]);
    Route::get('get-user-info/{slug}', [UsersController::class, 'getUserInfor']);
    Route::post('authorize/{id}', [UsersController::class, 'getAuthorize']);
    Route::get('count-user', [UsersController::class, 'countUser']);

    Route::apiResources(['properties'=> PropertiesController::class]);
    Route::get('count-properties', [PropertiesController::class, 'countProperties']);
    
    Route::apiResources(['suggested-properties'=> SuggestedPropertyController::class]);
    Route::get('count-suggested', [SuggestedPropertyController::class, 'countSuggest']);
    Route::get('get-suggest/{id}', [SuggestedPropertyController::class, 'GetSuggest']);
    Route::get('count-unread-suggest', [SuggestedPropertyController::class, 'countSuggestUnread']);
    
    Route::apiResources(['schedule-services'=> ScheduleServiceController::class]);
    Route::get('count-schedule-services', [ScheduleServiceController::class, 'countScheduleService']);
    Route::get('view-schedule-payment/{id}', [ScheduleServiceController::class, 'viewSchedulePayment']);
    Route::post('approve-schedule/{id}', [ScheduleServiceController::class, 'approveSchedule']);
    Route::post('desapprove-schedule/{id}', [ScheduleServiceController::class, 'desapproveSchedule']);
    

});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('create-user-activity', [RegisterController::class, 'createUserWithActivity']);

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);

    Route::post('oauth/{driver}', [OAuthController::class, 'redirect']);
    Route::get('oauth/{driver}/callback', [OAuthController::class, 'handleCallback'])->name('oauth.callback');
    Route::get('searched-houses', [SearchController::class, 'index'])->name('search');
    Route::get('find/{houseKey}', [SearchController::class, 'findHouse'])->name('find.house');
    Route::get('searchHouser', [SearchController::class, 'searchH']);
    Route::get('find-photos/{houseCode}', [SearchController::class, 'findPhotos']);
    Route::get('get-total-stars/{houseCode}', [SearchController::class, 'getTotalStars']);

    Route::post('send-suggest', [SuggestController::class, 'store']);

});
