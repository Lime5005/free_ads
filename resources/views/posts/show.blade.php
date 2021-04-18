@extends('layouts.app')

@section('content')
  <a href="/posts" class="btn btn-loght">Go Back</a>
  <h1>{{ $post->title }}</h1>
  <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
  <br><br>
  <div>
    {!! $post->category['name'] !!}
  </div>
  <div>
    {!! $post->description !!}
  </div>
  <div>
    {!! $post->price !!}
  </div>
  <div>
    {!! $post->condition !!}
  </div>
  <div>
    {!! $post->location !!}
  </div>
  <hr>
  <small>Posted on {{ $post->created_at }} by {{ $post->user->name }}</small>
  <hr>
  <div class="row justify-content-between">
    @if(!Auth::guest())
      @if(Auth::user()->id == $post->user_id)
      <div class="col-4">
        <a href="/posts/{{ $post->id }}/edit" class="btn btn-primary">Edit</a>
      </div>
      <div class="col-4">
        {!! Form::open(['action' => ['App\Http\Controllers\PostController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
        {{ Form::hidden('_method', 'DELETE') }}
        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
        {!! Form::close() !!}
      </div>
      @endif
    @endif
  </div>
@endsection
