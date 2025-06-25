@extends('layouts.home')
@section('content')
@include('pages.web.home.includes.nav')
 <div class=" align-items-center" style="width: 60%; height: 10%;margin-left:20%;margin-top:30px;">
   <h5>statment of account</h5>
   <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">DATETIME</th>
            <th scope="col">AMOUNT</th>
            <th scope="col">TYPE</th>
            <th scope="col">DETAILS</th>
            <th scope="col">BALANCE</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
                $loggedUserEmail = session('user_email');
            @endphp
            @foreach ($transaction as $transactions)
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $transactions->created_at }}</td>
                    <td>&#8377; {{ number_format((float) $transactions->amount, 2, '.', '') }}</td>
                        @switch($transactions->transaction_details)
                            @case('Transfer')
                                @if ($transactions->transfer_to === $loggedUserEmail)
                                    <td>Credit</td>
                                    <td>Transfer from <br>{{ $transactions->transfer_from }}</td>
                                @else
                                    <td>Debit</td>
                                    <td>Transfer to <br>{{ $transactions->transfer_to }}</td>
                                @endif
                            @break
                            @case('Deposit')
                                    <td>Credit</td>
                                    <td>Deposit</td>
                            @break
                            @case('Withdraw')
                                    <td>Debit</td>
                                    <td>Withdraw</td>
                            @break
                            @default
                        @endswitch
                    <td>&#8377; {{ $customerBalance}}</td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
   </table>
 </div>
@endsection
