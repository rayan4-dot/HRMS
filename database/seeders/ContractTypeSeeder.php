<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContractTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('contract_types')->insert([
            ['type' => 'CDI'],
            ['type' => 'CDD'],
            ['type' => 'Freelance'],
            ['type' => 'Internship'],
            ['type' => 'Apprenticeship'],
        ]);
    }
}
