<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;

class AccountSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Account::create([
                'name' => 'Test Account ' . $i,
                'reference' => 'test-account-' . $i,
                'type' => 'User',
                'docs' => ['http://example.com/doc' . $i, 'http://example.com/doc' . ($i + 1)]
            ]);
        }

    }
}

