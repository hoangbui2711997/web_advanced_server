<?php

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'common'], function () {
	Route::get('navigators', 'API\CommonController@getNavigators');
	Route::get('locations', 'API\CommonController@getLocationTypes');
	Route::get('zipcodes', 'API\CommonController@getZipcodes');
	Route::get('note-types', 'API\CommonController@getNodeTypes');

	Route::get('apis', 'API\CommonController@showAPIs');

	Route::group(['prefix' => 'product'], function () {
		Route::get('list', 'API\ProductController@index');
		Route::get('{slug}', 'API\ProductController@getProduct');
		Route::get('zipcode/{id}', 'API\ProductController@getZipcode');
	});

	Route::group(['prefix' => 'program'], function () {
		Route::get('collection-products', 'API\ProgramController@getCollectionProduct');
	});
});

Route::group(['prefix' => 'user'], function () {
	// for register user ------------------------------------------
	Route::post('login', 'API\UserController@login');
	Route::post('signup', 'API\UserController@signup');
	Route::post('signup/activate/{token}', 'API\UserController@signupActivate');
	// ------------------------------------------------------------
	Route::group(['middleware' => 'auth:api'], function () {
		Route::get('add-address-book', 'API\UserController@addAddressBook');
		Route::get('address-books', 'API\UserController@getAddressBooks');
		Route::get('payment', 'API\UserController@paymentCart');
		Route::get('current', 'API\UserController@getCurrentUser');

		Route::group(['prefix' => 'chat'], function () {
			Route::get('messages', 'API\ChatController@getMessages');
			Route::post('send-message', 'API\ChatController@sendMessage');
		});

		Route::group(['prefix' => 'checkout'], function () {
			Route::group(['prefix' => 'cart'], function () {
				Route::post('add', 'API\UserController@addToCart');
				Route::get('info', 'API\UserController@getCartInfo');
				Route::delete('product', 'Products\ProductController@removeProductInCart');
			});
		});

		Route::group(['prefix' => 'password'], function () {
			Route::post('create', 'PasswordResetController@create');
			Route::get('find/{token}', 'PasswordResetController@find');
			Route::post('reset', 'PasswordResetController@reset');
		});

		Route::group(['prefix' => 'info'], function () {
			Route::get('', 'API\UserController@getUserInfo');
			Route::post('update', 'API\UserController@updateUserInfo');
		});

		Route::post('logout', 'API\UserController@logout');
		Route::get('', 'API\UserController@user');
		Route::post('', 'API\UserController@updateUser');
	});
});
