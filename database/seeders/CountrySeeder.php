<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            [
                'name' => 'Nigeria',
                'phone_code' => '234',
                'exchange_rate' => '600',
                'currency_code' => 'Naira',
                'symbol' => '₦',
                'status' => true
            ],
            [
                'name' => 'Ghana',
                'phone_code' => '233',
                'exchange_rate' => '500',
                'currency_code' => 'Cedis',
                'symbol' => '¢',
                'status' => true
            ],
            [
                'name' => 'United State',
                'phone_code' => '1',
                'exchange_rate' => '1',
                'currency_code' => 'Dollar',
                'symbol' => '$',
                'status' => true
            ],
        ];

        foreach ($countries as $key => $country) {
            Country::create($country);
        }
    }
}
