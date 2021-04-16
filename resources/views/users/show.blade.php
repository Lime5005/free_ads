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
    <table class="table table-striped">
    <thead>
      <tr>
        <td>Id</td>
        <td>Name</td>
        <td>Username</td>
        <td>Email</td>
        <td>Phone Number</td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->username}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->phone_number}}</td>
      </tr>
    </tbody>
  </table>
  </div>
</div>
@endsection
