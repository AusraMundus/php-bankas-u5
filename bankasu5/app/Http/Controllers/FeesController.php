<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Client;

use Illuminate\Http\Request;

class FeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $clients = Client::all();
        $accounts = Account::all();

        return view('fees', [
            'clients' => $clients,
            'accounts' => $accounts
        ]);
    }
}