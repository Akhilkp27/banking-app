@extends('layouts.home')
@section('content')
<div style="width:50%; margin:10%;">
<form action="{{route('customer.register')}}" method="POST">
  @csrf
    <h3>Register Form</h3>
   {{-- <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    
  </div> --}}
  
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email"  name="emailCustomer" class="form-control" id="emailCustomer" aria-describedby="emailHelp">
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="passwordCustomer" class="form-control" id="passwordCustomer">
  </div>
 
  <button type="submit" class="btn btn-primary">Register</button>
</form>
</div>
@endsection