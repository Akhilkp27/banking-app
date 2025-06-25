<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;

class WithdrawController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('guest');
        $this->addBaseRoute('home');
        $this->addBaseView('home');
    }
    public function customerWithdraw() 
        {
        
            $path = $this->getView('withdraw');
            $para = [];
            $title = 'Withdraw';
        
            return $this->renderView($path, compact($para), $title);
        }

    public function withdrawAmount(Request $request) 
    {
        $validatedData = $request->validate([
        'amount' => 'required|numeric',
        ]);

        $amount = $validatedData['amount'];
        $userIdFromSession = session('user_id');
        $customer = Customer::where('id', $userIdFromSession)->first();
       

         if ($customer) {
       
            $newBalance = $customer->balance - $amount;
            $customer->update(['balance' => $newBalance]);
             Transaction::create([

            'customer_id' => $userIdFromSession,
            'amount' => $amount,
            'balance' => $newBalance,
            'transaction_type' =>'Debit',
            'transaction_details' =>'Withdraw',
        ]);

            return response()->json(['message' => ' Amount Withdrawed  Successfully', 'new_balance' => $newBalance], 200);
        }
       
       return response()->json(['message' => 'Customer not found'], 404);
    }
}
