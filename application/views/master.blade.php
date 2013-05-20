<!DOCTYPE html>
<html lang="en">
<head>
	<title>Simple Blog</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	{{ HTML::style('css/style.css') }}
	{{ HTML::style('css/bootstrap.css') }}
	{{ HTML::script('js/bootstrap.js') }}
</head>
<body>


	<div class="navbar">
		<div class="navbar-inner">
			{{HTML::link('/', 'Simple Blog', array('class' => 'brand'))}}
			<ul class="nav">
				@if (Auth::guest())
					<li>{{ HTML::link('admin', 'Login') }}</li>
					<li>{{ HTML::link('register', 'Register') }}</li>
				@else
					<li>{{ HTML::link('admin', 'Admin') }}</li>
					<li>{{ HTML::link('logout', 'Logout') }}</li>
				@endif
			</ul>
		</div>		
	</div>

	<div class="container">
		<h1>Simple Blog</h1>
		<em>A simple blog using Laravel</em>
	</div>

	<div class="container">
		@yield('content')
	</div>
</body>
</html>