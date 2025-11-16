<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Kved;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyKvedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();
        $kveds = Kved::all();

        if ($companies->isEmpty() || $kveds->isEmpty()) {
            return;
        }

        $companies->each(function ($company) use ($kveds) {
            $randomCount = rand(1, min(5, $kveds->count()));

            $randomKveds = $kveds->random($randomCount);

            $randomKveds->each(function ($kved, $index) use ($company) {
                $company->kveds()->attach($kved->id, [
                    'is_primary' => $index === 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            });
        });
    }
}
