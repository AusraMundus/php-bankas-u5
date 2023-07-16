<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Client;

use Illuminate\Http\Request;

class TransfersController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        $accounts = Account::all();

        return view('transfers', [
            'clients' => $clients,
            'accounts' => $accounts
        ]);
    }

// public function transfer()

}
