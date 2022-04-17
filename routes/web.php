<?php

use Illuminate\Support\Facades\Route;
use App\CategaryProduct;

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

// Route::get('/', function () {
//     return view('client.home');
// });
Route::get('/' ,'HomeController@index');


Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

 route::middleware('auth')->group(function(){
  Route::get('admin' ,'DashboardController@show');
 Route::get('dashboard' , 'DashboardController@show');
Route::get('admin/dashboard','DashboardController@show');
route::middleware('Athou')->group(function(){
 Route::get('admin/user/register' , 'UsersController@add');
 Route::get('admin/user/list' , 'UsersController@list');
 Route::get('admin/user/store' , 'UsersController@store');
 Route::get('admin/user/action' , 'UsersController@action');
 Route::get('admin/user/delete/{id}' ,'UsersController@delete')->name('user/delete');
 Route::get('admin/user/edit/{id}' ,'UsersController@edit')->name('user/edit');
 Route::get('admin/user/update/{id}' ,'UsersController@update')->name('user/update');
});

 #Pages

Route::get('admin/page/add' ,'PagesController@add')->middleware('CheckSubcriber');
Route::post('admin/page/store'  ,'PagesController@store')->name('page/store');
Route::get('admin/page/list' ,'PagesController@list');
Route::get('admin/page/detail/{id}' ,'PagesController@detail');
Route::get('admin/page/action' ,'PagesController@action')->name('page/action')->middleware('CheckSubcriber');;
Route::get('admin/page/edit/{id}' ,'PagesController@edit' )->name('page/edit')->middleware('CheckAuthor','CheckSubcriber');
Route::post('admin/page/update/{id}' ,'PagesController@update' )->name('page/update')->middleware('CheckAuthor' ,'CheckSubcriber');
Route::get('admin/page/delete/{id}' ,'PagesController@delete' )->name('page/delete')->middleware('CheckAuthor' ,'CheckSubcriber');

#Posts
Route::get('admin/post/cat/list' ,'PostsController@listCat');
Route::get('admin/post/cat/add' ,'PostsController@addCat')->name('post/cat/add')->middleware('CheckSubcriber');
Route::get('admin/post/cat/edit/{id}' ,'PostsController@editCat')->name('cat/edit')->middleware('CheckAuthor' ,'CheckSubcriber');
Route::get('admin/post/cat/update/{id}' ,'PostsController@updateCat')->name('cat/update')->middleware('CheckAuthor' ,'CheckSubcriber');
Route::get('admin/post/cat/delete/{id}' ,'PostsController@deleteCat')->name('cat/delete')->middleware('CheckAuthor' ,'CheckSubcriber');
Route::get('admin/post/add' ,'PostsController@add')->middleware('CheckSubcriber');
Route::post('admin/post/store' ,'PostsController@store')->middleware('CheckSubcriber');;
Route::get('admin/post/list' ,'PostsController@list');
Route::get('admin/post/action' ,'PostsController@action')->name('post/action')->middleware('CheckSubcriber');;
Route::get('admin/post/edit/{id}' ,'PostsController@edit')->name('post/edit')->middleware('CheckAuthor' ,'CheckSubcriber');
Route::post('admin/post/update/{id}' ,'PostsController@update')->middleware('CheckAuthor' ,'CheckSubcriber');
Route::get('admin/post/detail/{id}' ,'PostsController@detail');
Route::get('admin/post/delete/{id}' ,'PostsController@delete')->name('post/delete')->middleware('CheckAuthor' ,'CheckSubcriber');;

#Product
Route::get('admin/product/cat/list' ,'ProductController@listCat');
Route::get('admin/product/category/add' ,'ProductController@addCategoryProduct')->name('category/add');
Route::get('admin/product/cat/edit/{id}' ,'ProductController@editCat')->name('product/cat/edit')->middleware('CheckAuthor','CheckSubcriber');;
Route::get('admin/product/cat/update/{id}' ,'ProductController@updateCat')->name('product/cat/update')->middleware('CheckAuthor','CheckSubcriber');;
Route::get('admin/product/cat/delete/{id}' ,'ProductController@deleteCat')->name('product/cat/delete')->middleware('CheckAuthor','CheckSubcriber');;
Route::get('admin/product/list/color' ,'ProductController@listColor')->name('product/list/color');
Route::get('admin/product/list/code' ,'ProductController@code');
Route::get('admin/product/add/color' ,'ProductController@addColor')->name('product/add/color')->middleware('CheckSubcriber');
Route::get('admin/product/delete/color/{id}' ,'ProductController@deleteColor')->name('product/delete/color')->middleware('CheckAuthor' ,'CheckSubcriber');;
Route::get('admin/product/add' ,'ProductController@add')->name('product/add')->middleware('CheckSubcriber');;
Route::post('admin/product/store' ,'ProductController@store');
Route::get('admin/product/list' ,'ProductController@list');
Route::get('admin/product/action' ,'ProductController@action')->name('product/action')->middleware('CheckSubcriber');;
Route::get('admin/product/edit/{id}' ,'ProductController@edit')->name('product/edit')->middleware('CheckAuthor' ,'CheckSubcriber');;
Route::post('admin/product/update/{id}' ,'ProductController@update')->name('product/update')->middleware('CheckAuthor' ,'CheckSubcriber');;
Route::get('admin/product/delete_edit','ProductController@delete_edit' );
Route::get('admin/product/delete/{id}','ProductController@delete')->name('product/delete')->middleware('CheckAuthor' ,'CheckSubcriber');;
Route::get('admin/product/detail_ajax','ProductController@detail_ajax');

#Oder

Route::get('admin/order/list','OderController@list')->middleware('Athou');


#Role
Route::get('admin/role/list','RoleController@list_role');


#END ADMIN

 });
 #Post Client
route::get('tin-tuc' , 'PostsController@listPost');
Route::get('tin-moi/{id}' ,'PostsController@detailPost');


#Page
Route::get('gioi-thieu/{id}' ,'PagesController@introduce');
Route::get('lien-he/{id}' ,'PagesController@introduce');
Route::get('chinh-sach-su-dung/{id}' ,'PagesController@introduce');
Route::get('chinh-sach-bao-mat/{id}' ,'PagesController@introduce');
Route::get('chinh-sach-doi-tra/{id}' ,'PagesController@introduce');
Route::get('chinh-sach-su-dung/{id}' ,'PagesController@introduce');


#Product
Route::get('san-pham/{categary}/{id}' ,'ProductController@listProCate');
Route::get('product/filterAjax/{id}' ,'ProductController@filterAjax');
Route::get('product/filterAjax/fetch_data/{id}' ,'ProductController@fetch_data');
Route::get('{categary}/{idCate}/{categarychild}/{id}' ,'ProductController@listProChild');
Route::get('firtChildAjax' ,'ProductController@firtChildAjax');
Route::get('paginate' ,'ProductController@fetch_data1');
Route::get('{categary}/{idCate}/{categarychild}/chi-tiet/{idPro}','ProductController@detailProduct');

#Cat
Route::get('cat/add/{id}' ,'CatController@catAdd')->name('cat/add');
Route::get('gio-hang' ,'CatController@catShow');
Route::get('cat/delete/{id}' ,'CatController@delete')->name('cat/delete');
Route::post('cap-nhat-gio-hang' ,'CatController@update')->name('cap-nhat-gio-hang');
Route::get('xoa-toan-bo' ,'CatController@deleteAll')->name('xoa-toan-bo');
Route::get('update/ajax' ,'CatController@updateAjax');
