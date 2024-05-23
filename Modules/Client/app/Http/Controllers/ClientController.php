<?php

namespace Modules\Client\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Client\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = User::paginate(5);
        return view('dashboard.clients.clients', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.clients.create_client');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //

        $validatedData = $request->validate(
            [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone_number' => 'required|string|max:255',
                'birthday' =>  ['required', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
                'gender' => 'required|in:male,female',
                'password' => 'required|min:8|confirmed',

            ],
            [
                'birthday.before_or_equal' => 'You must be at least 18 years old.',
            ]
        );


        $client = new User();
        $client->fill($validatedData);


        $client->save();


        return redirect()->route('client.index')->with('success', 'Client added successfully!');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('client::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $client = User::find($id);
        return view('dashboard.clients.edit_client', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
        $user = User::findOrFail($id); // Assuming $id contains the ID of the user to be edited

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'required|string|max:255',
            'birthday' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            'gender' => 'required|in:male,female',
          //  'password' => 'nullable|min:8|confirmed',
        ], [
            'birthday.before_or_equal' => 'You must be at least 18 years old.',
        ]);

        $user->update($validatedData);

        return redirect()->route('client.index')->with('success', 'Client updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $client = User::find($id);
        $client->delete();
        return redirect()->route('client.index')->with('success', 'Client deleted successfully');
    }
}
