@extends('layout')
@section('title', 'Login')
@section('content')
<div class="container">
<form action="{{route('login.post')}}" method="POST">
  @csrf
    <div class="form-group">
      <label for="username">username</label>
      <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" value="rootUsername">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="rootPassword">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  <div>
    <div class="mt-5">
      @if($errors->any())
        <div class="alert alert-danger" role="alert">
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </div>
      @endif
      @if(session('error'))
        <div class="alert alert-danger" role="alert">
          {{session('error')}}
        </div>
      @endif
      @if(session('success'))
        <div class="alert alert-success" role="alert">
          {{session('success')}}
        </div>
      @endif
    </div>

    
  </div>
</div>
@endsection