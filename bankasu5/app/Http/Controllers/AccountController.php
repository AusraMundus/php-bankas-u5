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
                'iban' => 'required|max:20|min:20',
                'client_id' => 'required|integer',
                'balance' => 'required|integer'
            ],
            [
                'iban.required' => 'Please enter account No!',
                'iban.max' => 'Account No is too long!',
                'iban.min' => 'Account No is too short!',
                'client_id.required' => 'Please select the client!',
                'client_id.integer' => 'Please select the client!',
            ]);

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $account = new Account;
        $account->iban = $request->iban;
        $account->client_id = $request->client_id;
        $account->balance = $request->balance;

        $account->save();
        return redirect()
        ->route('accounts-index')
        ->with('success', 'New account has been added!');
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
        $validator = Validator::make(
            $request->all(),
            [
                'balance' => 'required|integer'
            ],
            [
                'balance.required' => 'Please enter the amount!',
                'balance.integer' => 'The amount has to be integer!',
            ]);

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $account->balance = $request->balance;

        $account->save();
        return redirect()
        ->route('accounts-index')
        ->with('success', 'Account balance has been edited!');
    }

    public function delete(Account $account)
    {
        
        if ($account->balance > 0) {
            return redirect()->back()->with('info', 'Cannot delete account, because it has money in it!');
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
