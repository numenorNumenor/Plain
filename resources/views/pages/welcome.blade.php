@extends('master')

@section('title', '| Welcome')

@section('content')

  <div class="row">
    <div class="col-md-12">
      <div class="jumbotron">
        <h1>Welcome</h1>
        <p class="lead">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam impedit quod atque saepe maiores quidem corporis, eligendi beatae laboriosam reprehenderit laudantium odio magnam tempore consectetur nisi sunt veritatis, culpa nulla.
        </p>
        <div class="btn-group">
          <a href="/" class="btn btn-primary">Read More</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">

      <h1>Latest Post</h1>

      @foreach ($posts as $post)

        <div class="post">

          <h2>{{ $post->title }} <small>| {{ $post->created_at->diffForHumans() }}</small></h2>

          <p>
            {{ substr($post->body, 0, 150) }} {{ strlen($post->body) > 150 ? "..." : "" }}
          </p>

          <div class="btn-group">
            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-sm">Read</a>
          </div>

        </div>

      @endforeach

      <div class="text-center">
        {{ $posts->links() }}
      </div>

    </div>
  </div>

@stop
