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

Route::resource('categories', 'Categories\CategoryController', [
    'only' => ['index']
]);

Route::resource('products', 'Products\ProductController');

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'API\AuthController@login');
    Route::post('signup', 'API\AuthController@signup');
    Route::get('signup/activate/{token}', 'API\AuthController@signupActivate');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'API\AuthController@logout');
        Route::get('user', 'API\AuthController@user');
        Route::get('users', 'API\AuthController@users');
    });
});

Route::group([
    'namespace' => 'Auth',
    'middleware' => 'api',
    'prefix' => 'password'
], function () {
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});

Route::get('test-users', 'API\AuthController@users');
