<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::all();

        return view('accounts.index', [
            'accounts' => $accounts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();

        return view('accounts.create', [
            'clients' => $clients
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
                'balance' => 'required|integer'
            ],
            [
                'iban.required' => 'Please enter account No!',
                'iban.unique' => 'Account with this account number has already been added!',
                'iban.size' => 'Account No must consist of 20 characters!',

                'client_id.required' => 'Please select the client!',
                'client_id.integer' => 'Please select the client!',
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $account = new Account;
        $account->iban = $request->iban;
        // $account->iban = $request->Account::generateLithuanianIBANn();
        $account->client_id = $request->client_id;
        $account->balance = 0;

        $account->save();
        return redirect()
            ->route('accounts-index')
            ->with('success', 'New account ' . $account->iban . ' has been added!');
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
                'amount' => 'required|integer|min:0'
            ],
            [
                'amount.required' => 'Please enter the amount!',
                'amount.integer' => 'The amount has to be integer!',
                'amount.min' => 'The amount must be a positive integer!'
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
                ->with('success', $amount . ' € has been added to the ' . $account->client->first_name . ' ' . $account->client->last_name . ' account ' . $account->iban . '!');
        }

        // Withdraw money
        if (isset($request->withdraw)) {

            $account->balance -= $amount;

            $account->save();
            return redirect()
                ->route('accounts-index')
                ->with('success', $amount . ' € has been withdrawn from the ' . $account->client->first_name . ' ' . $account->client->last_name . ' account ' . $account->iban . '!');
        }
    }

    public function delete(Account $account)
    {

        if ($account->balance > 0) {
            return redirect()->back()->with('info', 'Cannot delete account ' . $account->iban . ' because it has money in it!');
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
            ->with('success', 'Account ' . $account->iban . ' has been deleted!');
    }
}
