<?php
use Illuminate\Http\Request;
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

Route::get('/', function () {
  $categories = App\Category::all();
  return view('dashboard', [
      'categories' => $categories
  ]);
});

Route::get('/categories', function () {
    return $categories;
});

Route::post('/items', function (Request $oRequest) {
    $items = DB::table('items')
    ->where('category_id', $oRequest->iCategory)
    ->get();
    return json_encode($items);
});

Route::get('/item/{id}', function ($id) {
    $item = DB::table('items')
    ->where('id', $id)
    ->get()
    ->first();
    return json_encode($item);
});

Route::get('/coupons', function () {
    dd(App\Coupon::all());
});
