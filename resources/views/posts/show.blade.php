@extends ('layouts/master')

@section ('content')

  <div class="col-md-8 blog-main">

    <h1>{{ $post->title }}</h1>

    @if (count($post->tags))

      <ul>

          @foreach ($post->tags as $tag)

            <li>

              <a href="/posts/tags/{{ $tag->name }}">

                {{ $tag->name }}

              </a>

            </li>

          @endforeach

       </ul>

      @endif

      {{ $post->body }}

      <hr>

      <div class="comments">
  			<ul class="list-group">
  			<!-- De comments van een post worden weergegeven en kunnen worden bewerkt -->
  			@foreach ($post->comments as $comment)
  				<li class="list-group-item">
  					<strong>{{ $comment->created_at->diffForHumans() }}</strong> door <strong>{{ $comment->user->name }}</strong>: &nbsp;
  					<br><br>{{ $comment->body }}
  					<!-- De delete en wijzig knoppen worden alleen getoond aan geauthorizeerde gebruikers, hierbij moet worden gecontroleerd of ze zijn ingelogd EN of ze mogen bewerken (admin/editor of de auteur van de post) -->

  							<div class="comment-header d-flex justify-content-between">
                    			  <div class="user d-flex align-items-center"></div>
  		                    </div>
  							<br>
  							<form method="POST" action="/blog/{{ $post->id }}/comments/{{ $comment->id }}">
  								{{ csrf_field() }}
  								{{ method_field('PUT') }}

  								<div class="form-group">
  									<textarea name="body" placeholder="Your comment here." class="form-control">{{ $comment->body }}</textarea>
  								</div>

  								<div class="form-group">
  									<button type="submit" class="btn btn-primary btn-sm">Edit</button>
  									<a href="/delete/{{ $comment->id }}" class="btn btn-danger btn-sm" type="button">Delete</a>
  								</div>
  							</form>
  				</li>
  			@endforeach
  			</ul>
  		</div>

      Add a comment :)

      <hr>

      <div class="card">

        <div class="card-block">

          <form method="POST" action="/posts/{{ $post->id }}/comments">

            {{ csrf_field() }}

            <div class="form-group">

              <textarea name="body" placeholder="Your comment here." class="form-control" required></textarea>

            </div>

            <div class="form-group">

              <button type="submit" class="btn btn-primary">Add Comment</button>


            </div>



          </form>

          @include ('layouts.errors')

        </div>

      </div>

  </div>

@endsection
