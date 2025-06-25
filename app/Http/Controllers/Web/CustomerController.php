<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('guest');
        $this->addBaseRoute('home');
        $this->addBaseView('home');
    }
    public function registerCustomer(Request $request)
    {
        Customer::create([
                'name'  =>$request->customerName,
                'email' => $request->emailCustomer,
                'password' => $request->passwordCustomer,
            ]);
        return redirect()->route('login');
    }

    public function customerHome()
    {
        $userIdFromSession = session('user_id');
        $customer = Customer::where('id', $userIdFromSession)->first();
        $customerBalance = number_format((float) $customer->balance, 2, '.', '');

        $customerEmail = $customer->email;
        $path = $this->getView('home');
        $para = ['customerBalance', 'customerEmail'];
        $title = 'Customer Home';

        return $this->renderView($path, compact($para), $title);
    }

    public function customerLogin(Request $request)
    {
        $customerEmail = $request->input('email');
        $customerPassword = $request->input('password');

        $customer = Customer::where('email', $customerEmail)->first();

            if ($customer && $customer->password === $customerPassword) {

                session(['user_id' => $customer->id]);
                session(['user_email' => $customer->email]);
                session(['name' => $customer->name]);

                return redirect()->route('customer-home');
            } else {
            return redirect()->back()->with('error', 'Invalid login credentials');
            }
    }
    public function customerDeposit()
    {

        $path = $this->getView('deposit');
        $para = [];
        $title = 'Deposit';

        return $this->renderView($path, compact($para), $title);
    }

    public function logout()
    {
        session()->flush();

        return redirect('/');
    }

}
