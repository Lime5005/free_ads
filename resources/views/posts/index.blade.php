@extends('layouts.app')

<style>
  .input-group .md-form.form-sm.form-1 input {
    border: 1px solid #bdbdbd;
    border-top-right-radius: 0.25rem;
    border-bottom-right-radius: 0.25rem;
  }
</style>

@section('content')
  @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}
      </div><br>
  @endif
  <!-- Search bar -->
  <form action='{{ url("posts/search") }}' method="POST">
    {{ csrf_field() }}
    <div class="input-group md-form form-sm form-1 pl-0">
      <div class="input-group-prepend">
        <span class="input-group-text cyan lighten-2">
        <i class="fas fa-search text-white" aria-hidden="true"></i></span>
      </div>
        <input type="text" class="form-control my-0 py-1" name="search" placeholder="Product name..." aria-label="Search">
        <span class="input-group-btn">
          <button class="btn btn-default">Go!</button>
        </span>
    </div>
  </form>
  <h1>Ads</h1>
  <!-- Filter area -->
  <div class="row">
    <div class="col-md-3 col-sm-3">
      <div class="card">
        <div class="form-group">
          {{ Form::label('category_id', 'Category') }}
          <ul class="list-group list-group-flush" name="">
            @foreach ($cat as $key=>$value)
            <li class="list-group-item">
              <a href="{{ route('categories.show', $value->id) }}">{{ $value->name }}</a>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="card">
        <div class="form-group">
          {{ Form::label('', 'Price') }}
          <!-- Create a price range bar -->
          <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
        </div>
      </div>
      <div class="card">
        <div class="form-group">
          {{ Form::label('', 'Condition') }}
          <select name="condition" id="condition" class="brower-default custom-select">
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-9 col-sm-9">
      <div class="card">
        @if(count($posts) > 0)
          @foreach($posts as $post)
            <div class="card-body">
              <div class="row">
                <div class="col-md-4 col-sm-4">
                  <img style="width:100%" src="/storage/cover_image/{{$post->cover_image}}" alt="cover_image">
                </div>
                <div class="col-md-8 col-sm-8 mb-0">
                  <h4><a href="/posts/{{$post->id}}">{{$post->title}}</a></h4>
                  <p class="text-muted">Category: <a>{{ $post->category['name'] }}</a></p>
                  <p class="text-muted">Description: <a>{{ $post->description }}</a></p>
                  <p class="text-muted">Price: <a>{{ $post->price }}</a></p>
                  <p class="text-muted">Condition: <a>{{ $post->condition }}</a></p>
                  <p class="text-muted">Location: <a>{{ $post->location }}</a></p>
                  <small>Posted on {{ $post->created_at }} by {{ $post->user->name }}</small>
                </div>
              </div>
            </div>
          @endforeach
          {{ $posts->links() }}
        @else
          <p>No Ads Found</p>
        @endif
      </div>
    </div>
  </div>
  @endsection
  