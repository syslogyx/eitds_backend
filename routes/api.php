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
    $api->post("update/user", "App\Http\Controllers\UserController@updateUser");
    $api->get("get/users", "App\Http\Controllers\UserController@getUsers");
    $api->get("get/usersnew", "App\Http\Controllers\UserController@getUsersNew");
    $api->get("get/user/{id}", "App\Http\Controllers\UserController@getUserById");
    $api->post("login", "App\Http\Controllers\Auth\AuthController@authenticate");
    $api->post("import/users", "App\Http\Controllers\UserController@importUsers");

    // device's api
    $api->post("create/device", "App\Http\Controllers\DeviceController@createDevice");
    $api->post("update/device", "App\Http\Controllers\DeviceController@updateDevice");
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
    $api->post("get/productHistoryByDateAndProductIdNew", "App\Http\Controllers\UserProductController@getProductHistoryByDateAndProductIdNew");
    $api->post("get/productHistoryByDateAndProductIdTesting", "App\Http\Controllers\UserProductController@getProductHistoryByDateAndProductIdTesting");
    $api->get('report/download/{userId}/{date}/{productId}/{type}','App\Http\Controllers\UserProductController@download');
    $api->post("get/result", "App\Http\Controllers\UserProductController@getResult");

    // role related api
    $api->get("get/roles", "App\Http\Controllers\RoleController@getRoles");

    // Check product is exist or not
    $api->post("generateId", "App\Http\Controllers\StickerController@generateId");
    $api->post("get/stickerList", "App\Http\Controllers\StickerController@getStickerList");
    $api->get('stickers/download','App\Http\Controllers\StickerController@download');
    $api->get('sticker/pdf/download/{series}/{limit}/{startIndex}','App\Http\Controllers\StickerController@stickerPdf');

    $api->get("get/seriesList", "App\Http\Controllers\SeriesController@getSeriesList");




    // pdf setting related api
    $api->post("add/pdfSetting", "App\Http\Controllers\PdfSettingController@addPdfSetting");
    $api->get("get/pdfSettings", "App\Http\Controllers\PdfSettingController@getPdfSettings");
    $api->post("change/pdfSettingStatus", "App\Http\Controllers\PdfSettingController@changePdfSettingStatus");
    $api->get("get/activeStatusPdfSetting", "App\Http\Controllers\PdfSettingController@getActiveStatusPdfSetting");
    $api->get("get/columnList", "App\Http\Controllers\PdfColumnTableController@getColumnList");



});

$api->version("v1", ['middleware' => 'api.auth'], function($api) {

});
