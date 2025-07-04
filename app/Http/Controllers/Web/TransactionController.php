<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('guest');
        $this->addBaseRoute('home');
        $this->addBaseView('home');
    }

     public function customerStatement()
    {
        $userIdFromSession = session('user_id');
        $userEmailFromSession = session('user_email');

        $transaction = Transaction::where('customer_id', $userIdFromSession)->orWhere('transfer_to', $userEmailFromSession)->get();
        $customer = Customer::where('id', $userIdFromSession)->first();
        $customerBalance = number_format((float) $customer->balance, 2, '.', '');
        $path = $this->getView('statement');
        $para = ['transaction', 'userEmailFromSession','customerBalance'];
        $title = 'Statement';

        return $this->renderView($path, compact($para), $title);
    }
}
