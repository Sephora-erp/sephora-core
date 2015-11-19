<?php
use App\Http\Helpers\RouteHelper;

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

//Auth routes
Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');

Route::group(['middleware' => ['auth']], function()
{

  Route::get('/', 'HomeController@showHome');


  Route::get('/settings', 'SettingsController@showHome');
  Route::get('/settings/enable-module/{package}', 'SettingsController@enableModule');
  Route::get('/settings/disable-module/{package}', 'SettingsController@disableModule');
  Route::post('/settings/update', 'SettingsController@updateGeneral');
  Route::post('/user/create', 'SettingsController@createUser');
  Route::get('/user/delete/{id}', 'SettingsController@deleteUser');

  /*
   * Route Injector
   */
  //Check if the routes table exist's before using it (For example to protect app to break in the 1º migration stage)

  if (Schema::hasTable('routes')) {
  //Inject the routes
      foreach (RouteHelper::fetchRoutes() as $route) {
          switch ($route->type) {
              case "GET":
                  Route::get($route->url, $route->action);
                  break;
              case "POST":
                  Route::post($route->url, $route->action);
                  break;
              case "PUT":
                  Route::put($route->url, $route->action);
                  break;
              case "DELETE":
                  Route::delete($route->url, $route->action);
                  break;
          }
      }
  }
});
