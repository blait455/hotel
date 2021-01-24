<?php

use Illuminate\Support\Facades\Route;

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

/***** Front-end Routes *****/
Route::get('/', 'FrontpageController@index')->name('home');
Route::get('/search', 'FrontpageController@search')->name('search');

Route::get('/gallery', 'PagesController@gallery')->name('gallery');

Route::get('/rooms', 'PagesController@rooms')->name('rooms');
Route::get('/rooms/{id}', 'PagesController@showRoom')->name('room.show');
Route::post('/rooms/comment/{id}', 'PagesController@roomComments')->name('room.comment');
Route::post('/rooms/rating', 'PagesController@roomRating')->name('room.rating');
Route::get('/rooms/type/{id}', 'PagesController@roomType')->name('room.type');


Route::get('/blog', 'PagesController@blog')->name('blog');
Route::get('/blog/{id}', 'PagesController@blogshow')->name('blog.show');
Route::post('/blog/comment/{id}', 'PagesController@blogComments')->name('blog.comment');
Route::get('/blog/categories/{slug}', 'PagesController@blogCategories')->name('blog.categories');
Route::get('/blog/tags/{slug}', 'PagesController@blogTags')->name('blog.tags');
Route::get('/blog/author/{username}', 'PagesController@blogAuthor')->name('blog.author');

Route::get('/contact', 'PagesController@contact')->name('contact');
Route::post('/contact', 'PagesController@messageContact')->name('contact.message');

/***** Auth Routes *****/
Auth::routes();


/***** Back-end Routes *****/
Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'as'=>'admin.'], function(){
    Route::get('dashboard','DashboardController@index')->name('dashboard')->middleware('auth');

    Route::resource('users', 'UsersController')->middleware('can:manage-users');
    Route::resource('roles', 'RolesController');
    Route::resource('tags', 'TagController');
    Route::resource('categories', 'CategoryController');
    Route::resource('posts', 'PostController');
    Route::resource('sliders', 'SliderController');
    Route::resource('services', 'ServiceController');
    Route::resource('testimonials', 'TestimonialController');
    Route::resource('rooms', 'RoomsController');
    Route::resource('features', 'FeaturesController');
    Route::resource('types', 'TypesController');
    Route::resource('guests', 'GuestController');
    Route::resource('bookings', 'BookingsController');
    Route::resource('food-types', 'FoodTypeController');
    Route::resource('food-items', 'FoodItemController');
    Route::resource('drink-categories', 'DrinkCategoryController');
    Route::resource('drinks', 'DrinkController');

    Route::get('reserve/{id}/', 'BookingsController@reserve')->name('bookings.reserve');

    Route::post('rooms/gallery/delete','RoomsController@galleryImageDelete')->name('gallery-delete');

    Route::get('profile','DashboardController@profile')->name('profile');
    Route::post('profile','DashboardController@profileUpdate')->name('profile.update');

    Route::get('changepassword','DashboardController@changePassword')->name('changepassword');
    Route::post('changepassword','DashboardController@changePasswordUpdate')->name('changepassword.update');

    Route::get('settings', 'DashboardController@settings')->name('settings');
    Route::post('settings', 'DashboardController@settingStore')->name('settings.store');

    Route::get('galleries/album','GalleryController@album')->name('album');
    Route::post('galleries/album/store','GalleryController@albumStore')->name('album.store');
    Route::get('galleries/{id}/gallery','GalleryController@albumGallery')->name('album.gallery');
    Route::post('galleries','GalleryController@Gallerystore')->name('galleries.store');

});
