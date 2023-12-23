<?php

namespace Database\Seeders;

use App\Models\BankNote;
use Illuminate\Database\Seeder;

class BankNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BankNote::truncate();
        BankNote::create([
           'price'=>'200',
           'title'=>'200 AZN',
           'count'=>'10',
        ]);
        BankNote::create([
           'price'=>'100',
           'title'=>'100 AZN',
           'count'=>'10',
        ]);
        BankNote::create([
           'price'=>'50',
           'title'=>'50 AZN',
           'count'=>'10',
        ]);
        BankNote::create([
           'price'=>'20',
           'title'=>'20 AZN',
           'count'=>'10',
        ]);
        BankNote::create([
           'price'=>'10',
           'title'=>'10 AZN',
           'count'=>'10',
        ]);
        BankNote::create([
           'price'=>'5',
           'title'=>'5 AZN',
           'count'=>'10',
        ]);
        BankNote::create([
           'price'=>'1',
           'title'=>'1 AZN',
           'count'=>'10',
        ]);
    }
}
