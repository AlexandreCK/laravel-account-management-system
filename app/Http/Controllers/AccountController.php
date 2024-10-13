<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::latest()->take(5)->get();

        $types = Account::getTypes();

        return view('home', compact('accounts', 'types'));
    }

    public function show(Account $account)
    {
        return view('accounts', compact('account'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'reference' => 'required|string|max:255|unique:accounts',
            'type' => 'required|string|max:255',
            'docs' => 'nullable|string',
        ]);

        $docs = $request->docs ? explode(',', $request->docs) : [];

        Account::create([
            'name' => $request->name,
            'reference' => $request->reference,
            'type' => $request->type,
            'docs' => $docs,
        ]);

        return redirect()->route('home')->with('success', 'Account created successfully!');
    }

}

