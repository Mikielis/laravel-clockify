<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view('client.index');
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'city' => 'max:255',
            'postcode' => 'max:10',
            'street' => 'max:255',
            'house_number' => 'max:10',
        ]);


    }
}
