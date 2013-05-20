@layout('master')

@section('content')
	<div class="span8">
		<h1>{{ HTML::link('view/' .$post->id, $post->title) }}</h1>
		<p>{{ $post->body }}</p>
		<p> {{ HTML::link('/', 'Back to Index', array('class' => 'btn')) }}</p>
		<div>
			<span class="badge badge-success">Posted: {{ $post->created_at }}</span>
		</div>
	</div>
@endsection