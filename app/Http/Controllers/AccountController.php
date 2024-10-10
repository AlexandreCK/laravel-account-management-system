<?php

namespace App\Http\Controllers;

use App\Models\Account;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::latest()->take(5)->get();
        return view('home', compact('accounts'));
    }

    public function show(Account $account)
    {
        return view('accounts', compact('account'));
    }
}

?>
