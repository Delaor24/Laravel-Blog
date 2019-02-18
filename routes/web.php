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

// .............frontEnd route................


Route::group(['namespace' => 'FrontEnd'],function(){
     Route::get('/','FrontEndController@index')->name('home');
     Route::get('posts','FrontEndController@all_posts')->name('posts');
});







//..............laravel default auth route.............

Auth::routes();


/*
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']],function(){
     Route::get('dashboard','DashboardController@index')->name('admin.dashboard');
});

Route::group(['prefix'=>'author','namespace'=>'Author','middleware'=>['auth','author']],function(){
     Route::get('dashboard','DashboardController@index')->name('author.dashboard');
});
*/
// ================================Author route==================================


Route::name('author.')->namespace('Author')->prefix('author')->middleware(['auth','author'])->group(function(){
     Route::get('dashboard','DashboardController@index')->name('dashboard');
     Route::resource('post','PostController');
     Route::get('seeting','AuthorSettingController@index')->name('seeting.index');
     Route::put('profile-update','AuthorSettingController@profile_update')->name('profile.update');
     Route::put('password-update','AuthorSettingController@password_update')->name('password.update');
     Route::get('favarite-list','FavariteController@index')->name('favarite.post');
     

});
// ================================admin route==================================
Route::name('admin.')->namespace('Admin')->prefix('admin')->middleware(['auth','admin'])->group(function(){
     Route::get('dashboard','DashboardController@index')->name('dashboard');
     Route::resource('tag','TagController');
     Route::resource('category','CategoryController');
     Route::resource('post','PostController');
     Route::put('post/{id}/approve','PostController@approval')->name('post.approve');
     Route::get('pending/post','PostController@pending')->name('post.pending');
     Route::get('subscribers','SubscriberController@index')->name('subscriber.index');
     Route::delete('subscriber/{id}','SubscriberController@destroy')->name('subscriber.destroy');
     Route::get('seeting','AdminSetingController@index')->name('seeting.index');
     Route::put('profile-update','AdminSetingController@profile_update')->name('profile.update');
     Route::put('password-update','AdminSetingController@password_update')->name('password.update');
     Route::get('favarite-list','FavariteController@index')->name('favarite.post');
     //...................pdf route................
     Route::get('posts_pdf','PDFController@pdfPost')->name('pdf.post');
});

//.................subscriber route...........
Route::post('subscriber','SubscriberController@store')->name('subscriber.store');

//...........favarite list................

Route::group(['middleware'=>'auth'],function(){
    Route::post('favarite/{post}','FavariteController@add')->name('post.favarite');
    Route::post('comment/{post}','CommentController@store')->name('comment.store');
});

//..............post route............
Route::get('post/{slug}','PostController@details')->name('single.post');
//.............category route...............
Route::get('post/category/{id}','PostController@category_post')->name('category.posts');
//......................tag route....................
Route::get('post/tag/{id}','PostController@tag_post')->name('tag.posts');











//...............view route for category

View::composer('layouts.frontEnd.partial.footer',function ($view) {
    $categories = App\Category::all();
    $view->with('categories',$categories);
});