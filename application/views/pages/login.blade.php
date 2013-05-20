@layout('master')

@section('content')

	{{ Form::open('login', 'POST', array('class' => 'form-horizontal')) }}
	<fieldset>
		<div id="legend">
			<legend>Login</legend>
		</div>
		<div class="control-group">
			@if (Session::has('login_errors'))
				<span class="label label-important">Username or Password incorrect</span><br>
			@endif
			<div class="controls">
				<p>{{ Form::text('email', '', array( 'placeholder' => 'Email')) }}</p>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<p>{{ Form::password('password', array( 'placeholder' => 'Password')) }}</p>
			</div>
		</div>

		<div class="control-group">
			<div class="controls">
				<p>{{ Form::submit('Login', array('class' => 'btn btn-success')) }}</p>
			</div>
		</div>
		</div>
	</fieldset>
	{{ Form::close() }}

@endsection