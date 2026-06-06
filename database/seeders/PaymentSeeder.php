<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Payment::create([
            'registrationid' => 1,
            'amount' => 500000,
            'paymentmethod' => 'Bank Transfer',
            'paymentdate' => now(),
            'status' => 'Success',
        ]);

        \App\Models\Payment::create([
            'registrationid' => 2,
            'amount' => 1000000,
            'paymentmethod' => 'Cash',
            'paymentdate' => now(),
            'status' => 'pending',
        ]);

        \App\Models\Payment::create([
            'registrationid' => 3,
            'amount' => 750000,
            'paymentmethod' => 'Credit Card',
            'paymentdate' => now(),
            'status' => 'failed',
        ]);
    }
}
