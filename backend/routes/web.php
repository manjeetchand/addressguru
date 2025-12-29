<?php

use App\Category;
use App\Mail\EMail;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|admin-market-subcategory
*/
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    dd('cache-clear');
});

Route::get('test-mail-sending', 'API\AuthController@testMail');

Route::get('dev-text', function() {
    dd(ob_get_contents());
});



// Route::get('create-slug', function () {
//     $categories = Category::all();

//     foreach ($categories as $category) {
//         $slug = Str::slug($category->name);
//         $category->update(['slug' => $slug]);
//     }

//     return 'Slugs updated successfully!';
// });


Route::get('/test', function()
{
    $to = "digitarttech@gmail.com";
    $rands = "324324234";
	$details     = (object) [
		'otp'  => '123456',
	];

    $subject = "Verify OTP | AddressGuru";

    $htmlContent = '<html>
        <head>
        </head>
        <body>
          <div style="margin:auto;width:1000px;">
            <div style="background-color:#FFE1CC;padding:40px 15px 40px 15px;">
              <h1 style="color:#FE6E04;font-size:30px;"><b>Welcome To Address Guru</b></h1><hr/>
              <h3 style="color:#282323;font-size:20px;">Thanks for being part of Address Guru</h3>
              <p>AddressGuru is online local business directory that provide information about your daily needs just one click away. We get your business listed on it and grow online by reaching everyone who search you online.</p>
              <h4 style="font-size:18px;">&#128273; Your one time password: '.$rands.'</h4>
              <br/>
              <center><img src="http://www.addressguru.sg/images/logopng.png" style="width:150px;"></center>
            </div>
          </div>
        </body>
        </html>';
            // $headers = 'MIME-Version: 1.0' . "\r\n" .
            // 'Content-type:text/html;charset=UTF-8' . "\r\n" .
            // 'From: "AddressGuru" <'.env('EMAIL').'>' . "\r\n" .
            // 'Reply-To: "AddressGuru" <'.env('EMAIL').'>' . "\r\n" .
            // 'X-Mailer: PHP/' . phpversion();
            dd(
			Mail::to($to)->send(new EMail($details, $subject, 'mails.notification.user.mailotp'))
			);
    	// Mail::to($to)->send(new EMail($rands,$subject, $htmlContent));
			// dd($m);
			// $m = mail($to, $subject, $htmlContent, $headers);	
	// return view('test1');
});

//Website Route
Route::resource('/', 'IndexPage');
Route::resource('marketplace', 'Marketplace');
Route::resource('jobs', 'jobsController');
Route::resource('property', 'PropertyController');
Route::resource('/verify', 'Verify');
Route::get('/search/{place_id}', 'Search@details')->name('search.details');
Route::resource('/search', 'Search');
Route::get('infringement-policy', function () {
	return view('i_policy');
});
Route::post('change-city', 'IndexPage@changeCity');
Route::get('approve-listing/{name}', 'IndexPage@approve');
Route::get('dis-approve-listing/{name}', 'IndexPage@disapprove');
Route::get('posting-rules', function () {
	return view('posting_rules');
});
Route::resource('/payment', 'PaymentControl');
Route::post('partner-otp-verification/{id}','AgentRegister@verifyOTP')->name('verify.otp');
Route::post('partner-send-otp/{id}','AgentRegister@ResendOtp')->name('send.otp');
Route::resource('/partner', 'AgentRegister');
Route::resource('/rating', 'PostRating');
Route::resource('/resend', 'Filters');
Route::resource('/sms', 'smsquery');
Route::get('success1', 'PaymentControl@success1');
Route::get('/success', function(){
	return view('success');
});
Route::get('/failed', function(){
	return view('fail');
});
Auth::routes();
Route::resource('/claim', 'Postclaim');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('sitemap.xml', ['as' => 'sitemap', 'uses' => 'sitemap@index']);
Route::get('/login/google', 'Auth\RegisterController@redirectToGoogle');
Route::resource('/query', 'QueryInsert');
Route::get('/Pricing-Table', function(){
	return view('price');
});
Route::get('/About-Us', function(){
	return view('about');
});
Route::get('/Privacy-Policy', function(){
	return view('policy');
});
Route::get('/Contact-Us', function(){
	return view('contact');
});
Route::resource('/report', 'ReportSubmit');

Route::group(['middleware'=>'post'], function() {
	Route::resource('/post', 'CoachingInsert');
	Route::post('get_subcategory', 'CoachingInsert@create');
	Route::resource('/banner-ad', 'Bannerad');
	Route::get('marketplace-post', 'CoachingInsert@mcategory');
	Route::post('marketplace-store', 'CoachingInsert@mstore');
	Route::get('marketplace-preview/{slug}', 'CoachingInsert@previewpost');
	Route::get('sell-step-one/{id}', 'CoachingInsert@mstepone');	
	Route::get('sell-step-one-edit/{id}', 'CoachingInsert@msteponeedit');
	Route::patch('edit-product/{id}', 'CoachingInsert@mupdate');
	Route::get('sell-step-two/{id}', 'CoachingInsert@msteptwo');
	Route::get('sell-step-three/{id}', 'CoachingInsert@mstepthree');
	Route::get('sell-step-four/{id}', 'CoachingInsert@mstepfour');
	Route::get('payment-success/{id}', 'CoachingInsert@success');
	Route::get('success-product/{id}', 'CoachingInsert@successdone');
	Route::get('payment-failed', 'CoachingInsert@failed');
	// Route::resource('/testurl', 'CoachingInsert@post');
	Route::resource('/preview', 'Preview');
	Route::get('/profile-preview/{slug}', 'smsquery@show');
	Route::resource('/posting', 'CoachingInsert@post');
	Route::get('/category-post/{id}', 'CoachingInsert@category');
	Route::get('/subcategory-post/{id}', 'CoachingInsert@subcategory');
	Route::get('/step-two/{id}', 'CoachingInsert@steptwo');
	Route::get('/step-three/{id}', 'CoachingInsert@stepthree');
	Route::get('/step-four/{id}', 'CoachingInsert@stepfour');
	Route::get('/step-five/{id}', 'CoachingInsert@stepfive');
	Route::get('/step-six/{id}', 'CoachingInsert@stepsix');
	Route::get('/thankyou/{id}', 'CoachingInsert@thankyou');
	Route::post('post-media', 'CoachingInsert@media');
});

// editor Route 
Route::group(['middleware'=>'editor'], function() {
	Route::resource('editor-dashboard', 'EditorIndex');
	Route::resource('editor-image', 'EditorImage');
	Route::resource('editor-listing', 'EditorPost');
});     

// Admin Route 
Route::group(['middleware'=>'admin'], function() {
	// category route 
	Route::resource('admin-category', 'CategoryControl');

	Route::resource('admin-user', 'AdminUser');
	Route::get('category/form/{category_id}/{id?}', 'CategoryForm@create')->name('category.form');
	Route::resource('category-form', 'CategoryForm');
	Route::get('admin-subcategory/child-category-list/{id}/{status?}', 'AdminSubCategory@childSubCategoryList')->name('childSubCategoryList');
	Route::any('admin-subcategory/child-category/value/{id?}', 'AdminSubCategory@value');
	Route::any('admin-subcategory/child-category/update/{id?}', 'AdminSubCategory@childSubCategoryUpdate')->name('childSubCategory.update');
	Route::resource('admin-sub-category', 'AdminSubCategory');
	Route::resource('admin-listing', 'AdminPost');
	Route::resource('admin-media', 'AdminMedia');
	Route::any('admin-category/facilities/{id?}', 'CategoryControl@facilities');
	Route::any('admin-category/services/{id?}', 'CategoryControl@services');
	Route::any('admin-subcategory/facilities/{id?}', 'AdminSubCategory@facilities');
	Route::any('admin-subcategory/services/{id?}', 'AdminSubCategory@services');
	Route::any('admin-subcategory/child-category/{id}', 'AdminSubCategory@childSubCategory');
	Route::get('admin-category/payment', 'CategoryControl@payment');
	Route::post('admin-category/payment/create', 'CategoryControl@paymentCreate');
	Route::post('admin-category/payment/edit/{id}', 'CategoryControl@paymentEdit');
	Route::delete('admin-category/payment/delete/{id}', 'CategoryControl@paymentDestroy');
	
	Route::resource('admin-query', 'AdminQuery');
	Route::resource('admin-verify', 'AdminVerify');
	Route::resource('admin-template', 'AdminTemplate');
	Route::post('/payment-package/store', 'PaymentPackageController@store')->name('payment-package.store');
	Route::resource('payment-package', 'PaymentPackageController');
	Route::resource('admin-search', 'AdminSearch');
	Route::post('admin-search-delete', 'AdminSearch@des');
	Route::resource('admin-rating', 'AdminRating');
	Route::resource('admin-editor', 'AdminEditor');
	Route::resource('admin-banner', 'AdminBanner');
	Route::resource('admin', 'AdminIndex');
	Route::post('approve-ads', 'AdminMarketIndex@adapp');
	Route::get('ads-approval-request', 'AdminMarketIndex@adsapprove');
	Route::get('admin-market-query', 'AdminMarketIndex@create');
	Route::get('admin-market-report', 'AdminMarketIndex@report');
	Route::get('admin-market-payment', 'AdminMarketIndex@paymnet');
	Route::get('admin-market-deactive-product', 'AdminMarketIndex@depro');
	Route::delete('delete-deactive-product/{id}', 'AdminMarketIndex@trash');
	Route::get('live-products', 'AdminMarketIndex@live');
	Route::resource('/admin-message', 'AdminMessage');
	Route::resource('admin/change', 'AdminPost@change');
	Route::resource('admin/trash/user', 'AdminTrashUser');
	Route::resource('admin-trash-post', 'AdminTrashPost');
	Route::get('admin-pay-check/{id}', 'AdminIndex@pay');
	Route::post('admin-listing-reject', 'AdminBanner@store');
	Route::get('rejected-listing', 'AdminUser@reect');
	Route::resource('admin-market-category', 'AdminMarket');
	Route::match(['post', 'patch'], '/admin-business/active/{id}', 'AdminBusiness@active')->name('admin-business.active');
	Route::get('admin-business/{type}', 'AdminBusiness@listing')->name('admin-business.listing');
	Route::resource('admin-business', 'AdminBusiness');
	Route::resource('admin-marketplace', 'AdminMarketIndex');	
	Route::get('admin-market-subcategory/dropdown/{id}','AdminMsub@dropdown')->name('admin.sub.category.dropdown');
	Route::any('admin-market-subcategory/dropdown/update/{id}','AdminMsub@dropdownUpdate');
	Route::any('admin-market-subcategory/dropdown/destroy/{id}','AdminMsub@dropdownDestroy');
	Route::post('admin-market-subcategory/dropdown/store/','AdminMsub@dropdownStore');
	Route::resource('admin-market-subcategory', 'AdminMsub');
	Route::match(['post', 'patch'], '/admin-jobs/active/{id}', 'AdminJob@active')->name('admin-jobs.active');
	Route::get('admin-jobs/{type}', 'AdminJob@listing')->name('admin-job.listing');
	Route::get('admin-propery/{type}', 'AdminProperty@listing')->name('admin-property.listing');
	Route::resource('admin-jobs', 'AdminJob');
	Route::resource('admin-property', 'AdminProperty');
});




// Agent  Route 
Route::group(['middleware'=>'agent'], function(){
	Route::resource('/Partner Dashboard', 'PartnerIndex');
	Route::get('agent-product', 'PartnerIndex@create');
	Route::resource('agent/client', 'PartnerClient');
	Route::resource('agent-banner', 'AgentBanner');
	Route::resource('agent/listing', 'PartnerListing');
	Route::resource('agent/media', 'PartnerMedia');
	Route::resource('agent/rating', 'AgentRating');
	Route::resource('agent/package', 'AgentPack');
	Route::resource('agent-payment', 'AgentPayment');
	Route::resource('agent/change', 'PartnerListing@change');
	Route::resource('agent-profile', 'AgentProfile');
	Route::resource('agent/password', 'AgentProfile@password');
	Route::get('packagent/{id}', 'AgentPack@create');
});

// User Route 
Route::group(['middleware'=>'user'], function(){
	Route::resource('Dashboard', 'UserIndex');
	Route::resource('user-post', 'UserPost');
	Route::resource('user/media', 'UserMedia');
	Route::resource('user/package', 'UserPack');
	Route::resource('user-banner', 'UserBanner');
	Route::resource('user/change', 'UserPost@change');
	Route::resource('user/profile', 'UserProfile');
	Route::resource('user/password', 'UserProfile@password');
	Route::get('packcreate/{id}', 'UserPack@create');
	Route::get('user-product', 'UserIndex@create');
});

Route::get('/get', function() {
	$user = Auth::user();
	$category = Category::lists('name', 'id')->all();
	$cat = Category::orderBy('name', 'ASC')->get();
	return view('view', compact('category', 'user', 'cat'));
});

Route::get('/webhook', function(){
	return view('webhook');
});

Route::get('marketplace/{state}/{category}/{subcategory}/{slug}', 'Marketplace@show');
Route::get('auth/{provider}', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');
Route::get('marketplace/{category}/{subcategory}/{id}', 'Marketplace@subcatresult');
Route::get('marketplace-category/{category}/{id}', 'Marketplace@cateresult');
Route::get('/{category}/{local}/{city}/{id}', 'Search@create');
Route::get('/profiles/{slug}', 'smsquery@index');
Route::get('/{category}/{city}', 'Search@index');
Route::get('/{category}/{subcategory}/in/{city}/{id}', 'Search@sub');
Route::get('/list-of-/{top}/{category}/{city}/{id}', 'Search@show');
Route::get('/checkout/{slug}', 'PaymentControl@create');
Route::get('/redirect', 'PaymentControl@redirect');
Route::get('/{slug}', 'IndexPage@show');