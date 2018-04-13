<?php
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/add-friend', function(){
   return App\User::find(9)->add_friend(1);
});

Route::get('accept-friend', function () {
    return App\User::find(2)->accept_friendship(4);
});

Route::get('friends', function () {
    return App\User::first()->friends();
});

Route::get('friends-ids', function () {
    return App\User::first()->friends_ids();
});

Route::get('is-friends', function () {
    return App\User::first()->is_friends_with(2);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/auth_user', function(){
    return Auth::user();
});


/* ---------------------------------------------------------
| Profile Routes
|-----------------------------------------------------------
*/

Route::group(['middleware'=>['auth', 'web']], function(){
    Route::get('/profile/edit', 'ProfilesController@edit')->name('profile.edit');
    Route::get('/profile/{slug}', 'ProfilesController@index')->name('profile');
    Route::post('/profile/update', 'ProfilesController@update')->name('profile.update');
});

/* ---------------------------------------------------------
| Friendship Routes
|-----------------------------------------------------------
*/
Route::group(['middleware'=>['auth', 'web']], function(){
    Route::get('/add-friend/{id}', 'FriendshipController@add_friend')->name('friendship.add-friend');
    Route::get('/accept-friend/{id}', 'FriendshipController@accept_friend')->name('friendship.accept_friend');
    Route::get('/check-relationship-status/{id}', 'FriendshipController@check')->name('friendship.check-friendship-status');
});

// Notification Routes.
Route::group(['middleware'=>['auth', 'web']], function(){

    Route::get('/get_unread', function(){
        return Auth::user()->unreadNotifications;
    });

    Route::get('/notifications', 'HomeController@notifications')->name('notes');


    });

// Post Routes:
Route::group(['middleware'=>['auth', 'web']], function(){
    Route::resource('post', 'PostController');
    Route::resource('like', 'LikesController');
    Route::get('unlike/{id}', function($id){
        $post = \App\Post::find($id);
        $like = \App\Like::where('post_id', $post->id)->where('user_id', Auth::id())->first();

        $like->delete();
        return $like->id;
    });

});

