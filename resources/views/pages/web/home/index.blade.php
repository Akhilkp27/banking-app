@extends('layouts.home')
@section('content')
<div style="width:30%; margin:10%;">
<form action="{{route('customer-login')}}" method="GET">
  <div class="mb-3">
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
   
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="password">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
  <label for="">Don't have an account register<a href="{{route('register-user')}}">here!</a></label>
</form>
</div>
@endsection