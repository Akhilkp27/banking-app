@extends('layouts.home')
@section('content')
@include('pages.web.home.includes.nav')
 <div class=" align-items-center" style="width: 40%; height: 10%;margin-left:30%;margin-top:30px;">
    <h5>Withdraw Money</h5>
  <form>
            @csrf
            <div class="mb-3">
                <label for="balance" class="form-label">Amount</label>
                <input type="text" name="balance" class="form-control" id="balance" aria-describedby="emailHelp" placeholder="Enter money to withdraw">                          
            </div>
            <button type="button" class="btn btn-primary" onclick="withdrawAmount()">Withdraw</button>
  </form>
 </div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function withdrawAmount() {
        var amount = $('#balance').val();
     
        console.log(amount);
          
        $.ajax({
            url: "{{ route('add-customer-withdraw') }}",
            method: 'POST',
            data: {
                "amount": amount,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                 toastr.success('Amount Withdrawed successfully');
                setTimeout(function() {
                window.location.href = "{{ route('customer-home') }}";
                }, 1000); 
                console.log(response);
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