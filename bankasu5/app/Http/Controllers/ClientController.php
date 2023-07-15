<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();

        return view('clients.index', [
            'clients' => $clients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'first_name' => 'required|max:50|min:3|alpha',
                'last_name' => 'required|max:50|min:3|alpha',
                'personal_id' =>
                [
                    'required',
                    'integer',
                    'regex:/^(3[0-9]{2}|4[0-9]{2}|6[0-9]{2}|5[0-9]{2})(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01])\d{4}$/',
                    'unique:clients',
                ]
            ],
            [
                'first_name.required' => 'Please enter client`s first name!',
                'first_name.max' => 'Client`s first name is too long!',
                'first_name.min' => 'Client`s first name is too short!',
                'first_name.alpha' => 'Client`s first name must contain only letters!',

                'last_name.required' => 'Please enter client`s last name!',
                'last_name.max' => 'Client`s last name is too long!',
                'last_name.min' => 'Client`s last name is too short!',
                'last_name.alpha' => 'Client`s last name must contain only letters!',

                'personal_id.required' => 'Please enter client`s personal ID!',
                'personal_id.integer' => 'Personal ID must consist of 11 digits!',
                'personal_id.regex' => 'Personal ID is not valid!',
                'personal_id.unique' => 'Client with this personal ID has already been added!'
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $client = new Client;
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->personal_id = $request->personal_id;

        $client->save();
        return redirect()
            ->route('clients-index')
            ->with('success', 'New client ' . $client->first_name . ' ' . $client->last_name . ' has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', [
            'client' => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'first_name' => 'required|max:50|min:3|alpha',
                'last_name' => 'required|max:50|min:3|alpha'
            ],
            [
                'first_name.required' => 'Please enter client first name!',
                'first_name.max' => 'Client first name is too long!',
                'first_name.min' => 'Client first name is too short!',
                'first_name.alpha' => 'Client first name must contain only letters!',

                'last_name.required' => 'Please enter client last name!',
                'last_name.max' => 'Client last name is too long!',
                'last_name.min' => 'Client last name is too short!',
                'last_name.alpha' => 'Client last name must contain only letters!'
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;

        $client->save();
        return redirect()
            ->route('clients-index')
            ->with('success', 'Client ' . $client->first_name . ' ' . $client->last_name . ' details have been updated!');
    }

    public function delete(Client $client)
    {
        if ($client->accounts()->count()) {
            return redirect()->back()->with('info', 'Can not delete client ' . $client->first_name . ' ' . $client->last_name . ', because it has accounts!');
        }

        return view('clients.delete', [
            'client' => $client
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()
            ->route('clients-index')
            ->with('success', 'Client ' . $client->first_name . ' ' . $client->last_name . ' has been deleted!');
    }
}
