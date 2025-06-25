@extends('layouts.home')
@section('content')
@include('pages.web.home.includes.nav')
    <div class=" align-items-center" style="width: 60%; height: 10%;margin-left:30%;margin-top:30px;">
    <div class="row align-items-center">
        <div class="col-auto">
           <p>Welcome {{ session('name', 'user name') }}</p>
        </div>
        
    </div>
    <div class="row align-items-center mt-3">
        <div class="col-auto">
            <p class="text-muted mb-0">YOUR ID </p>
        </div>
        <div class="col-auto">
            <label for="exampleInputEmail1" class="form-label mb-0">{{ $customerEmail }}</label>
        </div>
    </div>
     <div class="row align-items-center mt-3">
        <div class="col-auto">
            <p class="text-muted mb-0">YOUR BALANCE </p>
        </div>
        <div class="col-auto">
            <label for="exampleInputEmail1" class="form-label mb-0">{{$customerBalance}} INR</label>
        </div>
    </div>
</div>

@endsection