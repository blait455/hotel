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

    Route::get('RL', 'AdministrationController@rl_index')->name('rl');
    Route::get('RL/create', 'AdministrationController@rl_create')->name('rl.create');
    Route::get('RL/cr8', 'AdministrationController@rl_cr8')->name('rl.cr8');
    Route::post('RL/store', 'AdministrationController@rl_store')->name('rl.store');
    Route::get('RL/{id}/edit', 'AdministrationController@rl_edit')->name('rl.edit');
    Route::post('RL/{id}/update', 'AdministrationController@rl_update')->name('rl.update');
    Route::post('RL/{id}/delete', 'AdministrationController@rl_delete')->name('rl.delete');

    Route::get('RQ', 'AdministrationController@rq_index')->name('rq');
    Route::get('RQ/create', 'AdministrationController@rq_create')->name('rq.create');
    Route::post('RQ/store', 'AdministrationController@rq_store')->name('rq.store');
    Route::get('RQ/{id}/edit', 'AdministrationController@rq_edit')->name('rq.edit');
    Route::post('RQ/{id}/update', 'AdministrationController@rq_update')->name('rq.update');
    Route::post('RQ/{id}/delete', 'AdministrationController@rq_delete')->name('rq.delete');

    Route::get('RQT', 'AdministrationController@rqt_index')->name('rqt');
    Route::get('RQT/create', 'AdministrationController@rqt_create')->name('rqt.create');
    Route::post('RQT/store', 'AdministrationController@rqt_store')->name('rqt.store');
    Route::get('RQT/{id}/edit', 'AdministrationController@rqt_edit')->name('rqt.edit');
    Route::post('RQT/{id}/update', 'AdministrationController@rqt_update')->name('rqt.update');
    Route::post('RQT/{id}/delete', 'AdministrationController@rqt_delete')->name('rqt.delete');

    Route::get('RI', 'AdministrationController@ri_index')->name('ri');
    Route::get('RI/create', 'AdministrationController@ri_create')->name('ri.create');
    Route::post('RI/store', 'AdministrationController@ri_store')->name('ri.store');
    Route::get('RI/{id}/edit', 'AdministrationController@ri_edit')->name('ri.edit');
    Route::post('RI/{id}/update', 'AdministrationController@ri_update')->name('ri.update');
    Route::post('RI/{id}/delete', 'AdministrationController@ri_delete')->name('ri.delete');

    Route::get('SR', 'AdministrationController@sr_index')->name('sr');
    Route::get('SR/create', 'AdministrationController@sr_create')->name('sr.create');
    Route::post('SR/store', 'AdministrationController@sr_store')->name('sr.store');
    Route::get('SR/{id}/edit', 'AdministrationController@sr_edit')->name('sr.edit');
    Route::post('SR/{id}/update', 'AdministrationController@sr_update')->name('sr.update');
    Route::post('SR/{id}/delete', 'AdministrationController@sr_delete')->name('sr.delete');

    Route::get('MP', 'AdministrationController@mp_index')->name('mp');
    Route::get('MP/create', 'AdministrationController@mp_create')->name('mp.create');
    Route::post('MP/store', 'AdministrationController@mp_store')->name('mp.store');
    Route::get('MP/{id}/edit', 'AdministrationController@mp_edit')->name('mp.edit');
    Route::post('MP/{id}/update', 'AdministrationController@mp_update')->name('mp.update');
    Route::post('MP/{id}/delete', 'AdministrationController@mp_delete')->name('mp.delete');

    Route::get('DCR', 'AdministrationController@dcr_index')->name('dcr');
    Route::get('DCR/create', 'AdministrationController@dcr_create')->name('dcr.create');
    Route::post('DCR/store', 'AdministrationController@dcr_store')->name('dcr.store');
    Route::get('DCR/{id}/edit', 'AdministrationController@dcr_edit')->name('dcr.edit');
    Route::post('DCR/{id}/update', 'AdministrationController@dcr_update')->name('dcr.update');
    Route::post('DCR/{id}/delete', 'AdministrationController@dcr_delete')->name('dcr.delete');

    Route::get('DP', 'AdministrationController@dp_index')->name('dp');
    Route::get('DP/create', 'AdministrationController@dp_create')->name('dp.create');
    Route::post('DP/store', 'AdministrationController@dp_store')->name('dp.store');
    Route::get('DP/{id}/edit', 'AdministrationController@dp_edit')->name('dp.edit');
    Route::post('DP/{id}/update', 'AdministrationController@dp_update')->name('dp.update');
    Route::post('DP/{id}/delete', 'AdministrationController@dp_delete')->name('dp.delete');

    Route::get('SP', 'AdministrationController@sp_index')->name('sp');
    Route::get('SP/create', 'AdministrationController@sp_create')->name('sp.create');
    Route::post('SP/store', 'AdministrationController@sp_store')->name('sp.store');
    Route::get('SP/{id}/edit', 'AdministrationController@sp_edit')->name('sp.edit');
    Route::post('SP/{id}/update', 'AdministrationController@sp_update')->name('sp.update');
    Route::post('SP/{id}/delete', 'AdministrationController@sp_delete')->name('sp.delete');
});
