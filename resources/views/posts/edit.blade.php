@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header">
    Edit Ads
  </div>
  <div class="card-body">
    @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}
      </div><br>
    @endif
    @if($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div><br>
    @endif
      {!! Form::open(['action' => ['App\Http\Controllers\PostController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
          {{ Form::label('title', 'Title') }}
          {{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title']) }}
        </div>
        <div class="form-group">
          {{ Form::label('category_id', 'Category') }}
          <select class="browser-default custom-select" name="category_id">
            {{ $selectedValue = $post->category_id }}
            @foreach($cat as $key=>$value)
              <option value="{{ $value->id }}" {{ $selectedValue == $value['id'] ? 'selected="selected"' : ''}}>{{ $value->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          {{ Form::label('description', 'Description') }}
          {{ Form::textarea('description', $post->description, ['class' => 'form-control', 'placeholder' => 'Description Text']) }}
        </div>
        <div class="form-group">
          {{ Form::file('cover_image') }}
        </div>
        <div class="form-group">
          {{ Form::label('price', 'Price(€)') }}
          {{ Form::text('price', $post->price, ['class' => 'form-control', 'placeholder' => 'Price']) }}
        </div>
        <div class="form-group">
          {{ Form::label('condition', 'Condition') }}
          {{ Form::text('condition', $post->condition, ['class' => 'form-control', 'placeholder' => 'Condition']) }}
        </div>
        <div class="form-group">
          {{ Form::label('location', 'Location') }}
          {{ Form::text('location', $post->location, ['class' => 'form-control', 'placeholder' => 'Location']) }}
        </div>
        {{ Form::hidden('_method', 'PUT') }}
        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
      {!! Form::close() !!}
  </div>
</div>
@endsection
