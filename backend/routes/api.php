<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{PlanController,JobsController,ListingController,MarketPlaceController,UserController}; 
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

Route::get('dev-data', function() {
    $scats = App\Msubcategory::orderBy('name')->get();
    $records = [];
    foreach($scats as $scat)
    {
        if(is_null($scat->deleted_at))
        {
            $records[] = [
                'id'   => $scat->id,
                'og'   => $scat->og,
                'name' => $scat->name,
                'icon' => $scat->icon,
                'color'=> $scat->colors,
                'scats'=> []    
            ];
        }
    }
    return $records;
});

// Auth Apis
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');

//google login
Route::get('google/redirect', 'AuthController@redirect');
Route::get('auth/google/callback', 'AuthController@callback');

Route::post('social-login', 'AuthController@socialLogin');
Route::post('password/forgot', 'AuthController@forgot');
Route::post('verify-otp/{id}', 'AuthController@verifyEmailOTP');
Route::get('request-otp/{id}', 'AuthController@sendEmailOTP');
Route::post('reset', 'AuthController@reset');

Route::middleware('auth:api')->group(function() {
    Route::post('logout', 'AuthController@logout');
    Route::post('profile-update','AuthController@profileUpdate');
});


// Global Search APis
Route::post('global-search','CategoryController@global_search');

// Plans Apis
Route::get('plans', [PlanController::class, 'index']);

// Category Apis
Route::get('categories/{type}', 'CategoryController@index');
Route::get('category/form/{id}','CategoryController@form');
Route::get('subcategories/{category_id}', 'CategoryController@sub_category');

// Query & Ratings & claim & view & recent Apis $ lead send 
Route::post('query/{type}/{id}','CategoryController@query_submit');
Route::post('ratings/{type}/{id}','CategoryController@ratings_submit');
Route::post('claim/{type}/{id}','CategoryController@claim_submit');
Route::post('report/{type}/{id}','CategoryController@report_submit');
Route::get('recent/{type}', 'CategoryController@recent');
Route::get('view/{type}/{id}', 'CategoryController@view');
Route::post('lead/send','CategoryController@send_leads');


Route::middleware('auth:api')->group(function() {
    // jobs
    Route::post('/jobs/store', [JobsController::class, 'store']);
    // post data
    Route::post('posts/save-data', [ListingController::class,'store']);  
    //category 
    Route::get('categories/service-facility/{category_id}', 'CategoryController@service');
});

// Jobs Apis
Route::prefix('jobs')->name('jobs.')->group(function() {
    Route::get('/categories', [JobsController::class, 'categories']);
    Route::get('/types', [JobsController::class, 'types']);
    Route::get('/education-level', [JobsController::class, 'education_level']);
    Route::get('/', [JobsController::class, 'index']);
    Route::get('/{slug}', [JobsController::class, 'details']);
    Route::post('/edit/{slug}', [JobsController::class, 'edit']);
    Route::post('/update/{slug}', [JobsController::class, 'update']);
    Route::post('/queries', [JobsController::class, 'queries']);
    Route::get('/filter', [JobsController::class, 'filter']);
});

// listing Apis 
Route::prefix('listing')->name('listing.')->group(function() {
    Route::get('/{category}/{city}',[ListingController::class, 'index']);
    Route::get('/{slug}',[ListingController::class, 'lending']);   
});

Route::middleware('auth:api')->prefix('user')->group(function () {
    Route::get('/listing/{type}', [ListingController::class, 'user_listing']);
    Route::get('/listing/{type}/{slug}', [ListingController::class, 'user_listing_details']);
    Route::get('/dashboard', [UserController::class, 'dashboard']);
});

// MarketPlace Apis 
Route::prefix('marketplace')->name('marketplace.')->group(function() {
    Route::middleware('auth:api')->prefix('listing')->group(function () {
        Route::post('/store',[MarketPlaceController::class, 'store']);
    });

    Route::get('types', 'MarketController@marketPlaceTypes');
    Route::get('search', 'MarketController@search');
    Route::get('recent', 'MarketController@recent');
    Route::get('product', 'MarketController@product');
    Route::get('featured', 'MarketController@featured');
    Route::get('products', 'MarketController@products');
    // Route::get('categories', 'MarketController@categories');
    Route::get('localities', 'MarketController@localities');
    // Route::get('sub-category', 'MarketController@subCategory');
    // Route::get('sub-categories', 'MarketController@subCategories');
    Route::get('market-categories','MarketController@marketRentCategories');

    Route::get('categories',[MarketPlaceController::class, 'categories']);
    Route::get('listings/{id}', [MarketPlaceController::class, 'lending']);
    Route::get('sub-category', [MarketPlaceController::class, 'subCategory']);
    Route::get('sub-categories', [MarketPlaceController::class, 'subCategories']);
    Route::get('{category?}', [MarketPlaceController::class, 'index']);
});

// Property Apis 
Route::prefix('property')->name('property.')->group(function() {
    Route::get('/{category?}', [MarketPlaceController::class, 'index']);
    Route::get('/listings/{id}', [MarketPlaceController::class, 'lending']);

    Route::middleware('auth:api')->group(function () {
        Route::post('active','PropertyController@active');
        Route::get('/user-listing','PropertyController@userListing');
        Route::get('hostel','PropertyController@store');
        Route::post('save-data', 'PropertyController@store');
        Route::get('get-data/{id}', 'PropertyController@edit');
        Route::post('update-data/{id}', 'PropertyController@update');
        Route::get('delete-data/{id}', 'PropertyController@destroy');
    });
});

Route::get('category-form-data/{category_id}/{sub_category_id?}','CategoryController@categoryFormData');
Route::get('marketplace-category-form-data/{category_id}/{sub_category_id?}','CategoryController@marketplaceCategoryFormData');
Route::get('states', 'GeneralController@states');
Route::get('cities', 'GeneralController@cities');
Route::get('payment-mode', 'GeneralController@paymentMode');

Route::get('listing-by-categories/{id}', 'CategoryController@edit');

Route::get('categories/facility/{category_id}/{id?}', 'CategoryController@facility');

Route::get('recent-listings', 'GeneralController@recentListings');
Route::get('most-viewed-listings', 'GeneralController@mostViewedListings');
Route::post('rating-save', 'GeneralController@ratingSave');
Route::post('claim-save', 'GeneralController@claimSave');
Route::post('report', 'GeneralController@Report');
Route::post('views-data', 'GeneralController@viewsPost');
Route::post('views', 'GeneralController@views');
Route::get('leads','TemplateController@leads');

Route::prefix('template')->group(function() {
    Route::get('/','TemplateController@index');
    Route::post('/add','TemplateController@store');
    Route::post('/update/{id}','TemplateController@update');
    Route::get('/delete/{id}','TemplateController@destroy');
});


Route::get('marketplace/edit-listing/{slug}', 'MarketController@editListing');
Route::post('marketplace/enquiry/{product_id}','MarketController@enquiry');

Route::middleware('auth:api')->prefix('user')->group(function() {
    Route::get('/', 'UserController@authuser');
    Route::get('listings', 'UserController@listings');
    Route::prefix('marketplace')->group(function() {
        Route::post('job-posts/save-data', 'MarketController@saveJobData'); 
        Route::get('job-post/{type}', 'MarketController@jobPost');
        Route::get('stuff-for-sale/{type}', 'MarketController@stuffForSale');
        Route::post('stuff-for-sale/save-data', 'MarketController@saveSFSData');
        Route::get('stuff-for-sale/edit-data/{id}', 'MarketController@editSF');
        Route::get('job-posts/edit-data/{id}', 'MarketController@editJob');
        Route::post('stuff-for-sale/save-edit-data/', 'MarketController@editSFData');
        Route::post('job-posts/save-edit-data/', 'MarketController@editJobData');
        Route::get('all-product', 'MarketController@allProduct');
        Route::get('all-job-post', 'MarketController@allJobPost');
        Route::get('media-delete/{id}','MarketController@mediaDelete');
        Route::get('property-subcategories','PropertyController@index');
        Route::get('delete-data/{id}', 'MarketController@destroy');
    });

    Route::post('reset', 'AuthController@reset');
    Route::post('logout', 'AuthController@logout');
    Route::post('verify-otp', 'AuthController@verifyEmailOTP');
    Route::post('request-otp', 'AuthController@sendEmailOTP');
    Route::post('profile-update','AuthController@profileUpdate');
    Route::get('/sayhello', function() {
        return  response()->json(['msg'=>"hi"]);
    });
});

Route::middleware('auth:api')->group(function() {
    Route::get('payment-plan', 'CoachingInsert@paymentPlan');
    Route::prefix('business')->group(function() {
        Route::post('save-data', 'CoachingInsert@create');
        Route::get('get-data/{id}', 'CoachingInsert@edit');
        Route::post('update-data/{id}', 'CoachingInsert@update');
        Route::get('delete-data/{id}', 'CoachingInsert@destroy');
    });
});

// All Job Data
Route::get('/job','JobController@index');
Route::get('/property','PropertyController@allData');
Route::get('/property/details/{slug}','PropertyController@propertyDetails');
Route::get('/job/details/{slug}','JobController@jobDetails');
Route::middleware('auth:api')->group(function() {
    Route::prefix('job')->group(function() {
        Route::get('/user-listing','JobController@userListing');
        Route::post('save-data', 'JobController@store');
        Route::get('get-data/{id}', 'JobController@edit');
        Route::post('update-data/{id}', 'JobController@update');
        Route::get('delete-data/{id}', 'JobController@destroy');
    });
});