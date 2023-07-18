<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    
        // Pagination
        $perPage = (int) 5;

        if ($request->s) {

            $accounts = Account::where('account', 'like', '%'.$request->s.'%')->paginate(5)->withQueryString();

        } else {

            $accounts = Account::select('accounts.*');
            $accounts = $accounts->paginate($perPage)->withQueryString();
        }

        return view('accounts.index', [
            'accounts' => $accounts,
            'perPage' => $perPage
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $iban = Account::generateLithuanianIBAN();

        return view('accounts.create', [
            'clients' => $clients,
            'iban' => $iban
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'iban' => 'required|unique:accounts|size:20',
                'client_id' => 'required|integer',
                'balance' => ['required', 'regex:/^0$|^[1-9]\d*$|^\.\d+$|^0\.\d*$|^[1-9]\d*\.\d*$/']
            ],
            [
                'iban.required' => 'Please enter account No!',
                'iban.unique' => 'Account with this account No has already been added!',
                'iban.size' => 'Account No must consist of 20 characters!',

                'client_id.required', 'client_id.integer' => 'Please select the client!',
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $account = new Account;
        $account->iban = $request->iban;
        
        $account->client_id = $request->client_id;
        $account->balance = 0;

        $account->save();
        return redirect()
            ->route('accounts-index')
            ->with('success', 'New account No' . $account->iban . ' has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        $clients = Client::all();

        return view('accounts.edit', [
            'account' => $account,
            'clients' => $clients
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        $amount = $request->amount;

        $validator = Validator::make(
            $request->all(),
            [
                'amount' => ['required', 'min:0', 'not_in:0', 'regex:/^0$|^[1-9]\d*$|^\.\d+$|^0\.\d*$|^[1-9]\d*\.\d*$/']
            ],
            [
                'amount.required' => 'Please enter the amount!',
                'amount.min', 'amount.not_in' => 'The amount must be a positive digit!'
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        // Add money
        if (isset($request->add)) {

            $account->balance += $amount;

            $account->save();
            return redirect()
                ->route('accounts-index')
                ->with('success', $amount . ' € has been added to the ' . $account->client->first_name . ' ' . $account->client->last_name . ' account No' . $account->iban . '!');
        }

        // Withdraw money
        if (isset($request->withdraw)) {

            if ($account->balance < $amount) {
                return redirect()
                ->back()
                ->with('warning', $amount . ' € exceeds the account balance ' . $account->balance . ' € and cannot be withdrawn!');
            }

            $account->balance -= $amount;

            $account->save();
            return redirect()
                ->route('accounts-index')
                ->with('success', $amount . ' € has been withdrawn from the ' . $account->client->first_name . ' ' . $account->client->last_name . ' account No' . $account->iban . '!');
        }
    }

    public function delete(Account $account)
    {

        if ($account->balance > 0) {
            return redirect()->back()->with('warning', 'Cannot delete account No' . $account->iban . ' because it has money in it!');
        }

        return view('accounts.delete', [
            'account' => $account
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()
            ->route('accounts-index')
            ->with('success', 'Account No' . $account->iban . ' has been deleted!');
    }
}
