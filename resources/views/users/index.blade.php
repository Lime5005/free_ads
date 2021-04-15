@extends('layouts.app')

@section('content')
<style>
  .uper{
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success')}}
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
        <td colspan="2">Action</td>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->username}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->phone_number}}</td>
        <td><a href="{{ route('users.edit', $user->id)}}" class="btn btn-primary">Edit</a></td>
        <td>
          <form action="{{ route('users.destroy', $user->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
