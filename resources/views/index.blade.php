@extends('layout')
@section('title', 'Home')
@section('content')
    <h1>Home</h1>
    <p>Welcome to our website!</p>
    @if(Session::has('username'))
        <p>Hello, {{ session('username')['name'] }}</p>
    @endif
@endsection
