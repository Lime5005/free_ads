@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header">
    Category Dashboard
  </div>
  <div class="card-body">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br>
    @endif
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br>
    @endif
    <div class="row">
      <div class="col-md-12">
        <table class="table">
          <thead>
            <th>CategoryId</th>
            <th>Name</th>
            <th>Created At</th>
            <th>Option</th>
          </thead>
          <tbody>
            <?php $no=1; ?>
            @foreach ($cat as $key=>$value)
              <tr>
                <th>{{ $no++ }}</th>
                <th><a href="{{ route('categories.show', $value->id) }}">{{$value->name}}</a></th>
                <th>{{$value->created_at}}</th>
                <th>
                {!! Form::open(['method' => 'DELETE', 'route' => ['delete.category', $value->id], 'style' => 'display:inline']) !!}
                {!! Form::button('Delete', ['type' => 'submit', 'class' => 'btn btn-danger btn-md btn-block']) !!}
                {!! Form::close() !!}
                </th>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="col-md-4">
        {!! Form::open(['route' => 'create.category', 'data-parsley-validate' => '']) !!}
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', NULL, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) !!}
        {!! Form::submit('Add Category', ['class' => 'btn btn-success btn-lg btn-block mt-2']) !!}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
