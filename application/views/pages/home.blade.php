@layout('master')

@section('content')
	@foreach ($posts->results as $post)
		<div class="row">
			<div class="span8">
				<div class="row">
					<div class="span8">
						<h4><strong>{{ HTML::link('view/' .$post->id, $post->title) }} </strong></h4>
					</div>
				</div>
				<div class="row">
					<div class="span2">
						<a href="#" class="thumbnail">
							<img src="http://placehold.it/260x180" alt="">
						</a>
					</div>
					<div class="span6">
						<p>
							{{ substr($post->body, 0, 120 ).'[..]' }}
						</p>
						<p>{{ HTML::link('view/' .$post->id, 'Read more', array('class' => 'btn')) }}</p>
					</div>
				</div>
			</div>
		</div>
	@endforeach
	{{ $posts->links() }}

@endsection


