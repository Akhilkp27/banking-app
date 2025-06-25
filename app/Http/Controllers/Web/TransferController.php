<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransferController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('guest');
        $this->addBaseRoute('home');
        $this->addBaseView('home');
    }
    public function customerTransfer() 
    {
   
        $path = $this->getView('transfer');
        $para = [];
        $title = 'Transfer';
       
        return $this->renderView($path, compact($para), $title);
    }

    public function transferAmount(Request $request)
    {
        $validatedData = $request->validate([
        'amount' => 'required|numeric',
        'email' => 'required|email',
        ]);

        $amount = $validatedData['amount'];
        $email = $validatedData['email'];
        $userIdFromSession = session('user_id');
       

        $transferCustomer = Customer::where('email', $email)->first();
       
        $sndingCustomer = Customer::where('id', $userIdFromSession)->first();

        if(($sndingCustomer->balance) >= $amount) {

            if ($transferCustomer ) {

                $newBalance = $transferCustomer->balance + $amount;
                $finalBalance = $sndingCustomer->balance - $amount;
                $transferCustomer->update(['balance' => $newBalance]);
                $sndingCustomer->update(['balance' => $finalBalance]);
                Transaction::create([

                    'customer_id' => $userIdFromSession,
                    'amount' => $amount,
                    'balance' => $finalBalance,
                    'transaction_type' =>'Debit',
                    'transaction_details' =>'Transfer',
                    'transfer_from' => $sndingCustomer->email,
                    'transfer_to' => $transferCustomer->email,
                ]);

                return response()->json(['message' => 'Email exists']);
            } else {
                
                return response()->json(['message' => 'Email does not exist']);
            }
        } else {
            
        return response()->json(['message' => 'Insufficient balance']); 
        }       

    }
}
