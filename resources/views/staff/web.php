<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


	Route::post('/auth/login', ['as' => 'auth-page', 'uses' => 'AuthController@postAuthenticate']);
  Route::get('/auth/login', ['uses' => 'AuthController@authenticate']);

  Route::get('/auth/logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
	Route::get('/', ['as' => 'login-page', 'uses' => 'AdminController@login']);

 	Route::get('/login', ['as' => 'login-page', 'uses' => 'AdminController@login']);
 	Route::get('/logout', ['as' => 'logout-page', 'uses' => 'AdminController@logout']);

	// Post Route
	Route::post('/login', ['as' => 'post-login-page', 'uses' => 'AdminController@postLogin']);


Route::group(['middleware' => 'auth'], function () {

	Route::group(['prefix' => 'admin'], function () {

		// Get Route
		Route::get('/dashboard', ['as' => 'dashboard-page', 'uses' => 'AdminController@dashboard']);
    Route::get('/add-account', ['as' => 'add-account-page', 'uses' => 'AdminController@getAddAccount']);
		Route::get('/all-accounts', ['as' => 'all-accounts-page', 'uses' => 'AdminController@getAllAccounts']);
		Route::get('/account/edit/{id}', ['as' => 'all-account-page', 'uses' => 'AdminController@getEditAccount']);
		Route::get('/account/delete/{id}', ['as' => 'all-account-page', 'uses' => 'AdminController@deleteAccount']);
		Route::post('/add-account', ['as' => 'add-account-page', 'uses' => 'AdminController@postAddAccount']);
		Route::post('/change-account', ['as' => 'change-account-page', 'uses' => 'AdminController@changeAccount']);

		//pst
		Route::get('/all-shengzhupaislots', ['as' => 'all-shengzhupaislots-page', 'uses' => 'AdminController@getAllShengzhupaiSlots']);
		Route::get('/ajax-shengzhupaislots', ['as' => 'ajax-shengzhupaislots-page', 'uses' => 'AdminController@getAjaxShengzhupaiSlots']);
		Route::get('/setting-lingwei', ['as' => 'setting-lingwei-page', 'uses' => 'AdminController@getSettingLingwei']);
		Route::get('/all-lingwei', ['as' => 'all-lingwei-page', 'uses' => 'AdminController@getAllLingwei']);
		Route::get('/lingwei/edit/{id}', ['as' => 'edit-lingwei-page', 'uses' => 'AdminController@getEditLingwei']);
		Route::get('/all-lingwei-exchange', ['as' => 'all-lingwei-exchange-page', 'uses' => 'AdminController@getAllLingweiExchange']);
		Route::get('/setting-shengzhupai', ['as' => 'setting-shengzhupai-page', 'uses' => 'AdminController@getSettingShengzhupai']);
		Route::get('/all-shengzhupai', ['as' => 'all-shengzhupai-page', 'uses' => 'AdminController@getAllShengzhupai']);
		Route::get('/setting-bei', ['as' => 'setting-bei-page', 'uses' => 'AdminController@getSettingBei']);
		Route::get('/setting-bei/add/{id}', ['as' => 'setting-bei-add-page', 'uses' => 'AdminController@getSettingBeiAdd']);
    Route::get('/setting-bei/update/{id}', ['as' => 'setting-bei-update-page', 'uses' => 'AdminController@getSettingBeiUpdate']);
		Route::get('/all-bei', ['as' => 'all-bei-page', 'uses' => 'AdminController@getAllBei']);
		Route::get('/add-otheroption', ['as' => 'add-otheroption-page', 'uses' => 'AdminController@getAddOtherOption']);
		Route::get('/all-otheroption', ['as' => 'all-otheroption-page', 'uses' => 'AdminController@getAllOtheroption']);
		Route::get('/otheroption/edit/{id}', ['as' => 'edit-otheroption-page', 'uses' => 'AdminController@getEditOtherOption']);
		Route::get('/otheroption/delete/{id}', ['as' => 'delete-otheroption-page', 'uses' => 'AdminController@deleteOtherOption']);

		Route::get('/add-zuoling-status', ['as' => 'add-zuoling-status-page', 'uses' => 'AdminController@getAddZuolingStatus']);
		Route::get('/change-zuoling-status', ['as' => 'change-zuoling-status-page', 'uses' => 'AdminController@getChangeZuolingStatus']);
		Route::get('/all-zuoling', ['as' => 'all-zuoling-page', 'uses' => 'AdminController@getSettingLingwei']);
		Route::get('/report', ['as' => 'report-page', 'uses' => 'AdminController@getReport']);
		Route::get('/pricesetting-lingwei', ['as' => 'pricesetting-lingwei-page', 'uses' => 'AdminController@getPricesettingLingwei']);
		Route::get('/setting-gst', ['as' => 'setting-gst-page', 'uses' => 'AdminController@getSettingGst']);
		Route::get('/pricesetting-shengzhupai', ['as' => 'pricesetting-shengzhupai-page', 'uses' => 'AdminController@getPricesettingShengzhupai']);
		Route::get('/pricesetting-bei', ['as' => 'pricesetting-bei-page', 'uses' => 'AdminController@getPricesettingBei']);
		Route::get('/pricesetting-option', ['as' => 'pricesetting-option-page', 'uses' => 'AdminController@getPricesettingOption']);
		Route::get('/onetime-pricesetting-lingwei', ['as' => 'onetime-pricesetting-lingwei-page', 'uses' => 'AdminController@getOneTimePricesettingLingwei']);
		Route::get('/onetime-pricesetting-shengzhupai', ['as' => 'onetime-pricesetting-shengzhupai-page', 'uses' => 'AdminController@getOneTimePricesettingShengzhupai']);


		Route::post('/add-otheroption', ['as' => 'add-otheroption-page', 'uses' => 'AdminController@postAddOtherOption']);
		Route::post('/change-lingwei', ['as' => 'change-lingwei-page', 'uses' => 'AdminController@changeLingwei']);
		Route::post('/change-otheroption', ['as' => 'change-otheroption-page', 'uses' => 'AdminController@changeOtherOption']);
		Route::post('/add-zuoling-status', ['as' => 'add-zuoling-status-page', 'uses' => 'AdminController@postAddZuolingStatus']);
		Route::post('/setting-lingwei', ['as' => 'setting-lingwei-page', 'uses' => 'AdminController@postSettingLingwei']);
		Route::post('/setting-shengzhupai', ['as' => 'setting-shengzhupai-page', 'uses' => 'AdminController@postSettingShengzhupai']);
		Route::post('/pricesetting-shengzhupai', ['as' => 'pricesetting-shengzhupai-page', 'uses' => 'AdminController@postPricesettingShengzhupai']);
		Route::post('/pricesetting-lingwei', ['as' => 'pricesetting-lingwei-page', 'uses' => 'AdminController@postPricesettingLingwei']);
		Route::post('/onetime-pricesetting-lingwei', ['as' => 'onetime-pricesetting-lingwei-page', 'uses' => 'AdminController@postOneTimePricesettingLingwei']);
		Route::post('/onetime-pricesetting-shengzhupai', ['as' => 'onetime-pricesetting-shengzhupai-page', 'uses' => 'AdminController@postOneTimePricesettingShengzhupai']);
		Route::post('/setting-gst', ['as' => 'setting-gst-page', 'uses' => 'AdminController@postSettingGst']);
		Route::post('/add-setting-bei', ['as' => 'addsetting-bei-page', 'uses' => 'AdminController@postAddsettingBei']);


  });

  Route::group(['prefix' => 'operator'], function () {

		Route::get('/index', ['as' => 'main-page', 'uses' => 'OperatorController@index']);
		Route::get('/search/autocomplete', ['as' => 'search-autocomplete-page', 'uses' => 'OperatorController@getAutocomplete']);
		Route::get('/search/autocomplete2', ['as' => 'search-autocomplete2-page', 'uses' => 'OperatorController@getAutocomplete2']);
		Route::get('/search/address_street', ['as' => 'search-address-street-page', 'uses' => 'OperatorController@getAddressStreet']);
		Route::get('/address-translate', ['as' => 'address-translate-page', 'uses' => 'OperatorController@getAddressTranslate']);

		//pst
		Route::get('/getjsonotheroption', 'OperatorController@jsonGetOtherOption');

		Route::get('/devotee/edit/{devotee_id}', ['as' => 'edit-devotee-page', 'uses' => 'OperatorController@getEditDevotee']);
		Route::match(["post", "get"], '/devotee/new-search', ['as' => 'get-json-focus-devotee-page', 'uses' => 'OperatorController@getRemoveFocusDevotee']);
		Route::post('/devotee/search-familycode', ['as' => 'search-familycode-page', 'uses' => 'OperatorController@getSearchFamilyCode']);
		Route::get('/devotee/getDevoteeDetail', ['as' => 'get-devotee-page', 'uses' => 'OperatorController@getDevoteeDetail']);
		Route::get('/devotee/getMemberDetail', ['as' => 'get-member-page', 'uses' => 'OperatorController@getMemberDetail']);
		Route::get('/getFocusDevoteeDetail', ['as' => 'get-focus-devotee-detail-page', 'uses' => 'OperatorController@getFocusDevoteeDetail']);
		Route::get('/devotee/focus-devotee', ['as' => 'get-json-focus-devotee-page', 'uses' => 'OperatorController@getJSONFocusDevotee']);
		Route::get('/devotee/delete/{devotee_id}', ['as' => 'delete-devotee-page', 'uses' => 'OperatorController@deleteDevotee']);
		Route::match(["post", "get"], '/focus-devotee', ['as' => 'focus-devotee-page', 'uses' => 'OperatorController@getFocusDevotee']);
		Route::post('/relocation', ['as' => 'relocation-devotee-page', 'uses' => 'OperatorController@postRelocationDevotees']);
		Route::post('/new-devotee', ['as' => 'new-devotee-page', 'uses' => 'OperatorController@postAddDevotee']);
		Route::post('/edit-devotee', ['as' => 'edit-devotee-page', 'uses' => 'OperatorController@postEditDevotee']);

		//pst
		Route::get('/search/devotee_info', ['as' => 'search-devotee_info-page', 'uses' => 'OperatorController@getDevoteeInfo']);
		Route::get('/search/devotee_nric', ['as' => 'search-devotee_nric-page', 'uses' => 'OperatorController@getDevoteeNRIC']);

  });



  Route::group(['prefix' => 'staff'], function () {
		Route::get('/wanyuanshenghui/edit/{id}', ['as' => 'edit-wanyuanshenghui-page', 'uses' => 'StaffController@getEditWanyuanshenghui']);
			Route::post('/change-wanyuanshenghui', ['as' => 'change-wanyuanshenghui-page', 'uses' => 'StaffController@changeWanyuanshenghui']);

    Route::get('/search-devotee', ['as' => 'search-devotee-page', 'uses' => 'StaffController@getSearchDevotee']);
    Route::get('/donation', ['as' => 'get-donation-page', 'uses' => 'StaffController@getDonation']);
    Route::get('/preorder-shengzhupai', ['as' => 'get-preorder-shengzhupai-page', 'uses' => 'StaffController@getPreorderShengzhupai']);
		Route::get('/shengzhupai', ['as' => 'get-shengzhupai-page', 'uses' => 'StaffController@getShengzhupai']);
    Route::get('/lingwei', ['as' => 'get-lingwei-page', 'uses' => 'StaffController@getLingwei']);
		Route::get('/preorder-lingwei', ['as' => 'get-preorder-lingwei-page', 'uses' => 'StaffController@getPreOrderLingwei']);
    Route::get('/bei', ['as' => 'get-bei-page', 'uses' => 'StaffController@getBei']);
    Route::get('/rmkbei', ['as' => 'get-rmkbei-page', 'uses' => 'StaffController@getRmkbei']);
    Route::get('/wanyuanshenghui', ['as' => 'get-wanyuanshenghui-page', 'uses' => 'StaffController@getWanyuanshenghui']);
		Route::get('/all-wanyuanshenghui', ['as' => 'get-all-wanyuanshenghui-page', 'uses' => 'StaffController@getAllWanyuanshenghui']);
		Route::get('/wanyuanshenghuiprint', ['as' => 'get-wanyuanshenghuiprint-page', 'uses' => 'StaffController@getWanyuanshenghuiprint']);
    Route::get('/wanyuanshenghuiprint2', ['as' => 'get-wanyuanshenghuiprint2-page', 'uses' => 'StaffController@getWanyuanshenghuiprint2']);
    Route::get('/wanyuanshenghuiprint3', ['as' => 'get-wanyuanshenghuiprint3-page', 'uses' => 'StaffController@getWanyuanshenghuiprint3']);
    Route::get('/wanyuanshenghuiprint4', ['as' => 'get-wanyuanshenghuiprint4-page', 'uses' => 'StaffController@getWanyuanshenghuiprint4']);
    Route::get('/receipt/{receipt_id}', ['as' => 'receipt-page', 'uses' => 'StaffController@getReceipt']);
		Route::get('/receiptdetail/{receipt_id}', ['as' => 'receipt-page', 'uses' => 'StaffController@getReceiptDetail']);
    Route::get('/transaction/{generaldonation_id}', ['as' => 'receipt-page', 'uses' => 'StaffController@getTransaction']);
		Route::get('/create-festive-event', ['as' => 'create-festive-event-page', 'uses' => 'StaffController@getCreateFestiveEvent']);
		Route::post('/verticalprint-wanyuanshenghui', ['as' => 'post-verticalprint-wanyuanshenghui-page', 'uses' => 'StaffController@postVerticalprintWanyuanshenghui']);
		Route::post('/create-festive-event', ['as' => 'add-new-festive-event-page', 'uses' => 'StaffController@postCreateFestiveEvent']);
    Route::post('/donation', ['as' => 'post-donation-page', 'uses' => 'StaffController@postDonation']);
     Route::post('/shengzhupai', ['as' => 'post-shengzhupai-page', 'uses' => 'StaffController@postShengzhupai']);
		 Route::post('/preorder-shengzhupai', ['as' => 'post-preorder-shengzhupai-page', 'uses' => 'StaffController@postPreOrderShengzhupai']);
      Route::post('/lingwei', ['as' => 'post-lingwei-page', 'uses' => 'StaffController@postLingwei']);
			  Route::post('/preorder-lingwei', ['as' => 'post-preorder-lingwei-page', 'uses' => 'StaffController@postPreOrderLingwei']);
       Route::post('/bei', ['as' => 'post-bei-page', 'uses' => 'StaffController@postBei']);
        Route::post('/rmkbei', ['as' => 'post-rmkbei-page', 'uses' => 'StaffController@postRmkbei']);
          Route::post('/wanyuanshenghui', ['as' => 'post-wanyuanshenghui-page', 'uses' => 'StaffController@postWanyuanshenghui']);
		Route::post('/receipt-cancellation', ['as' => 'receipt-cancellation-page', 'uses' => 'StaffController@postReceiptCancellation']);
  });

	Route::group(['prefix' => 'account'], function () {
    Route::get('/new-glaccountgroup', ['as' => 'new-glaccount-group-page', 'uses' => 'GlController@getAddNewGlAccountGroup']);
		Route::get('/edit-glaccountgroup', ['as' => 'edit-glaccount-group-page', 'uses' => 'GlController@EditGlAccountGroup']);
		Route::get('/new-glaccount', ['as' => 'new-glaccount-page', 'uses' => 'GlController@getAddNewGlAccount']);
		Route::get('/edit-glaccount', ['as' => 'edit-glaccount-page', 'uses' => 'GlController@EditGlAccount']);
		Route::get('/chart-all-accounts', ['as' => 'chart-all-accounts-page', 'uses' => 'GlController@getChartAllAccounts']);

		Route::post('/new-glaccountgroup', ['as' => 'post-glaccount-group-page', 'uses' => 'GlController@postAddNewGlAccountGroup']);
		Route::post('/update-glaccountgroup', ['as' => 'update-glaccount-group-page', 'uses' => 'GlController@UpdateGlAccountGroup']);
		Route::post('/new-glaccount', ['as' => 'post-glaccount-page', 'uses' => 'GlController@postAddNewGlAccount']);
		Route::post('/update-glaccount', ['as' => 'update-glaccount-page', 'uses' => 'GlController@UpdateGlAccount']);

  });

	Route::group(['prefix' => 'job'], function () {
    Route::get('/manage-job', ['as' => 'new-job-page', 'uses' => 'JobController@getJob']);
		Route::get('/get-joblists', ['as' => 'get-joblists-page', 'uses' => 'JobController@getJobLists']);

		Route::post('/new-job', ['as' => 'post-glaccount-group-page', 'uses' => 'JobController@postAddNewJob']);
  });

});
