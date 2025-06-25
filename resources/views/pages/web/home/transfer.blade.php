@extends('layouts.home')
@section('content')
@include('pages.web.home.includes.nav')
 <div class=" align-items-center" style="width: 40%; height: 10%;margin-left:30%;margin-top:30px;">
    <h5>Transfer Money</h5>
  <form>
            @csrf
            <div>
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" id="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter Email ID">
            </div>
            <div class="mb-3">
                <label for="balance" class="form-label">Amount</label>
                <input type="text" name="balance" class="form-control" id="balance" aria-describedby="emailHelp" placeholder="Enter money to transfer">                          
            </div>
            <button type="button" class="btn btn-primary" onclick="transferAmount()">Transfer</button>
  </form>
 </div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function transferAmount() {
        var amount = $('#balance').val();
        var email = $('#email').val();
     
        console.log(amount);
          
        $.ajax({
            url: "{{ route('add-customer-transfer') }}",
            method: 'POST',
            data: {
                "amount": amount, "email": email,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {

                 if (response.message === 'Email exists') {
                    toastr.success('Amount Transferd successfully');
                    setTimeout(function() {
                    window.location.href = "{{ route('customer-home') }}";
                    }, 1000); 
                } else if (response.message === 'Email does not exist') {
                   
                    toastr.error('Email does not exist');
                  
                } else {
                    toastr.warning('Insufficient balance');
                }
                                 
            },
            error: function(xhr, status, error) {
             
                  if (xhr.status == 422) {
          
                    var errors = xhr.responseJSON.errors;
                    var errorString = '';
                    $.each(errors, function(key, value) {
                        errorString += value[0] + '<br>';
                    });

                    toastr.error(errorString);
                } else { 
                    console.error("AJAX Request Error:", error);
                }
            }
        });
    }
</script>