<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransfersController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function transfer()
    {
        $clients = Client::all();
        $accounts = Account::all();

        return view('transfers', [
            'clients' => $clients,
            'accounts' => $accounts
        ]);
    }

    public function execute(Account $account, Request $request)
    {
            $validator = Validator::make(
            $request->all(),[
                'amount' => ['required', 'min:0', 'not_in:0', 'regex:/^0$|^[1-9]\d*$|^\.\d+$|^0\.\d*$|^[1-9]\d*\.\d*$/']
            ],
            [
                'amount.required' => 'Please enter the amount!',
                'amount.min', 'amount.not_in' => 'The amount must be a positive digit!'
            ]);

            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }

            $account = Account::where('account_id', '=', $request->to_account_id);
            $account2 = Account::where('account_id', '=', $request->from_account_id);

            if ($account->balance >= $request->amount){
                $account->balance -= $request->amount;
                $account2->balance += $request->amount;

                $account->save();
                $account2->save();
                return redirect()->back()->with('success', 'Money where transfared!');
            }

            return redirect()->back()->withErrors('Balance is not sufficient');
    }

}
