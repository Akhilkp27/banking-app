<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepositController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('guest');
        $this->addBaseRoute('home');
        $this->addBaseView('home');
    }
    public function addDeposit(Request $request)
    {
        $validatedData = $request->validate([
        'amount' => 'required|numeric',
        ]);

        $amount = $validatedData['amount'];
        $userIdFromSession = session('user_id');
        $customer = Customer::where('id', $userIdFromSession)->first();
 
        if (!$customer) {

         return response()->json(['message' => 'Customer not found'], 404);   
        }

        $newBalance = $customer->balance + $amount;
        $customer->update(['balance' => $newBalance]);
   
        Transaction::create([
            'customer_id' => $userIdFromSession,
            'amount' => $amount,
            'balance' => $newBalance,
            'transaction_type' =>'Credit',
            'transaction_details' =>'Deposit',
            
        ]);
   
        return response()->json(['message' => 'Deposit added successfully', 'new_balance' => $newBalance], 200);
       
    }
}
