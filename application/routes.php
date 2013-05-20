<?php

Route::get('/', function()
{	
	$per_page = 3;
	$posts = Post::order_by('id', 'desc')->paginate($per_page);
	return View::make('pages.home')
		->with('posts', $posts);
});

Route::get('view/(:num)', function($post){

	 $post = Post::find($post);
	 return View::make('pages.full')
		->with('post', $post);
});

Route::get('admin', array('before' => 'auth', 'do' => function(){
	$user = Auth::user();
	return View::make('pages.new')->with('user', $user);
}));

Route::post('admin', array('before' => 'auth', 'do' =>  function(){

	$new_post = array(
		'title' => Input::get('title'),
		'body' => Input::get('body'),
		'author_id' => Input::get('author_id')
		);

	$rules = array(
		'title' => 'required|min:3|max:128',
		'body' => 'required'
		);

	$v = Validator::make($new_post, $rules);

	if ($v->fails()) {
		return Redirect::to('admin')
			->with('user', Auth::user())
			->with_errors($v)
			->with_input();
	}

	$post = new Post($new_post);
	$post->save();

	return Redirect::to('view/' .$post->id);

}));

Route::get('login', function(){

	return View::make('pages.login');
});

Route::post('login', function(){

	$userdata = array(
		'username' => Input::get('email'),
		'password' => Input::get('password')
		);

	if (Auth::attempt($userdata)) {
		return Redirect::to('admin');
	} else {
		return Redirect::to('login')
			->with('login_errors', true);
	}

});

Route::get('register', function(){
	return View::make('pages.register');
});

Route::post('register', function(){

	$input = Input::all();

		$rules = array(
			'username' => 'required|unique:users',
			'email' => 'required|unique:users|email',
			'password' => 'required'
			);

		$v = Validator::make($input, $rules);

		if ($v->fails()) {
			return Redirect::to('register')->with_errors($v);	
		} else {

			$password = $input['password'];
			$password = Hash::make($password);

			$user = new User;
			$user->username = $input['username'];
			$user->email = $input['email'];
			$user->password = $password;
			$user->save();

			return Redirect::to('login');
		}
});

Route::get('logout', function(){
	Auth::logout();
	return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Router::register('GET /', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});