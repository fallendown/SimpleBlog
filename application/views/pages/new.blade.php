@layout('master')

@section('content')
	{{ Form::open('admin', 'POST', array('class' => 'form-horizontal')) }}
		{{ Form::hidden('author_id', $user->id) }}
	<div class="control-group">
			
		<div class="controls">
			<p>{{ Form::label('title', 'Title') }}</p>
			{{ $errors->first('title', '<p class="label label-important">The Title is required!</p>') }}
			<p>{{ Form::text('title', Input::old('title')) }}</p>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<p>{{ Form::label('body', 'Body') }}</p>
			{{ $errors->first('body', '<p class="label label-important">The Body is required!</p>') }}
			<p>{{ Form::textarea('body', Input::old('body')) }}</p>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<p>{{ Form::submit('Create Post', array('class' => 'btn btn-primary')) }}</p>
		</div>
	</div>	
	{{ Form::close() }}
@endsection


