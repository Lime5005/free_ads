@extends('layouts.app')

@section('content')
<style>
  .uper{
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit User Data
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div><br>
    @endif
      <form action="{{ route('users.update', $user->id) }}" method="POST">
        <div class="form-group">
          @csrf
          @method('PATCH')
          <label for="name">Name:</label>
          <input type="text" class="form-control" name="name" value="{{$user->name}}">
        </div>
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" name="username" value="{{$user->username}}">
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" name="email" value="{{$user->email}}">
        </div>
        <div class="form-group">
          <label for="phone_number">Phone Number:</label>
          <input type="tel" class="form-control" name="phone_number" value="{{$user->phone_number}}">
        </div>
        <button type="submit" class="btn btn-primary">Update Data</button>
      </form>
  </div>
</div>
@endsection
