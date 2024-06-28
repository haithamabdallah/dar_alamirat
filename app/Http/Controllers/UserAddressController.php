<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserAddressController extends Controller
{
    public function __construct(public $rules=[])
    {
        $rules = [
            'governorate' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'house_number' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'famous_place_nearby' => 'nullable|string|max:255',
            'phone1' => 'required|string|min:1|max:16',
            'phone2' => 'nullable|string|min:1|max:16',
        ];
        $this->rules = $rules;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), $this->rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                $status = 'error';
                return response()->json(compact('status', "errors"));
            }

            $validated = $validator->safe()->all();

            $address = auth('web')->user()->addresses()->create($validated);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }

        $status = 'success';
        return response()->json(compact('status', "address"));
    }

    /**
     * Display the specified resource.
     */
    public function show(UserAddress $userAddress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserAddress $userAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserAddress $address)
    {

        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $status = 'error';
            return response()->json(compact('status', "errors"));
        }

        $validated = $validator->safe()->all();

        try {
            $address->update($validated);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }

        $status = 'success';
        return response()->json(compact('status', "address"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserAddress $address)
    {
        $address->delete();
        $status = 'success';
        $message = 'Deleted Successfully.';
        return response()->json(compact('status', "message"));
    }
}
