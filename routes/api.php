    <?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



$api = app("Dingo\Api\Routing\Router");


$api->version("v1", function($api) {
    // user's api
    $api->post("create/user", "App\Http\Controllers\UserController@createUser");
    $api->put("update/user", "App\Http\Controllers\UserController@updateUser");
    $api->get("get/users", "App\Http\Controllers\UserController@getUsers");
      $api->get("get/usersnew", "App\Http\Controllers\UserController@getUsersNew");
    $api->get("get/user/{id}", "App\Http\Controllers\UserController@getUserById");
    $api->post("login", "App\Http\Controllers\Auth\AuthController@authenticate");
    $api->post("import/users", "App\Http\Controllers\UserController@importUsers");

    // device's api
    $api->post("create/device", "App\Http\Controllers\DeviceController@createDevice");
    $api->put("update/device", "App\Http\Controllers\DeviceController@updateDevice");
    $api->get("get/devices", "App\Http\Controllers\DeviceController@getDevices");
    $api->get("get/all/devices", "App\Http\Controllers\DeviceController@getAllDevices");
    $api->get("get/device/{id}", "App\Http\Controllers\DeviceController@getDeviceById");
      $api->post("import/devices", "App\Http\Controllers\DeviceController@importDevices");

    // user and device assoc api
    $api->post("assign/deviceToUser", "App\Http\Controllers\UserDeviceAssocController@assignDeviceToUser");
    $api->get("get/userIdByDeviceId/{id}", "App\Http\Controllers\UserDeviceAssocController@getUserIdByDeviceId");
    $api->get("get/deviceIdByUserId/{id}", "App\Http\Controllers\UserDeviceAssocController@getDeviceIdByUserId");
    $api->get("reset/deviceById/{id}", "App\Http\Controllers\UserDeviceAssocController@resetDeviceById");

    // user and product assoc api
    $api->post("add/testCaseResult", "App\Http\Controllers\UserProductController@addTestCaseResult");
    $api->get("get/productsByUserId/{id}", "App\Http\Controllers\UserProductController@getProductsByUserId");
    $api->post("get/productHistoryByDateAndProductId", "App\Http\Controllers\UserProductController@getProductHistoryByDateAndProductId");
    $api->get('report/download/{userId}/{date}/{productId}/{type}','App\Http\Controllers\UserProductController@download');
    // role related api
    $api->get("get/roles", "App\Http\Controllers\RoleController@getRoles");

    // pdf setting related api
    $api->post("add/pdfSetting", "App\Http\Controllers\PdfSettingController@addPdfSetting");
    $api->get("get/pdfSettings", "App\Http\Controllers\PdfSettingController@getPdfSettings");
    $api->post("change/pdfSettingStatus", "App\Http\Controllers\PdfSettingController@changePdfSettingStatus");
    $api->get("get/activeStatusPdfSetting", "App\Http\Controllers\PdfSettingController@getActiveStatusPdfSetting");

});

$api->version("v1", ['middleware' => 'api.auth'], function($api) {

});
