<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\Flight;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Airlines
        $airlines = [
            [
                'name' => 'Qatar Airways',
                'code' => 'QR',
                'country' => 'Qatar',
                'description' => 'Qatar Airways is the flag carrier of Qatar.'
            ],
            [
                'name' => 'Emirates',
                'code' => 'EK',
                'country' => 'UAE',
                'description' => 'Emirates is one of the largest airlines in the Middle East.'
            ],
            [
                'name' => 'British Airways',
                'code' => 'BA',
                'country' => 'United Kingdom',
                'description' => 'British Airways is the flag carrier airline of the United Kingdom.'
            ]
        ];

        foreach ($airlines as $airline) {
            Airline::create($airline);
        }

        // Create Airports
        $airports = [
            [
                'name' => 'Hamad International Airport',
                'code' => 'DOH',
                'city' => 'Doha',
                'country' => 'Qatar',
                'timezone' => 'Asia/Qatar'
            ],
            [
                'name' => 'Dubai International Airport',
                'code' => 'DXB',
                'city' => 'Dubai',
                'country' => 'UAE',
                'timezone' => 'Asia/Dubai'
            ],
            [
                'name' => 'Heathrow Airport',
                'code' => 'LHR',
                'city' => 'London',
                'country' => 'United Kingdom',
                'timezone' => 'Europe/London'
            ],
            [
                'name' => 'John F. Kennedy International Airport',
                'code' => 'JFK',
                'city' => 'New York',
                'country' => 'USA',
                'timezone' => 'America/New_York'
            ],
            [
                'name' => 'Charles de Gaulle Airport',
                'code' => 'CDG',
                'city' => 'Paris',
                'country' => 'France',
                'timezone' => 'Europe/Paris'
            ]
        ];

        foreach ($airports as $airport) {
            Airport::create($airport);
        }

        // Create Sample Flights
        $flights = [
            [
                'flight_number' => 'QR001',
                'airline_id' => 1,
                'departure_airport_id' => 1, // DOH
                'arrival_airport_id' => 2,   // DXB
                'departure_time' => now()->addDays(1)->setHour(8)->setMinute(0),
                'arrival_time' => now()->addDays(1)->setHour(10)->setMinute(30),
                'duration' => 150, // 2h 30m
                'price' => 250.00,
                'available_seats' => 150,
                'class' => 'economy',
            ],
            [
                'flight_number' => 'QR002',
                'airline_id' => 1,
                'departure_airport_id' => 1, // DOH
                'arrival_airport_id' => 3,   // LHR
                'departure_time' => now()->addDays(2)->setHour(14)->setMinute(0),
                'arrival_time' => now()->addDays(2)->setHour(20)->setMinute(0),
                'duration' => 420, // 7h
                'price' => 650.00,
                'available_seats' => 200,
                'class' => 'business',
            ],
            [
                'flight_number' => 'EK003',
                'airline_id' => 2,
                'departure_airport_id' => 2, // DXB
                'arrival_airport_id' => 4,   // JFK
                'departure_time' => now()->addDays(3)->setHour(10)->setMinute(0),
                'arrival_time' => now()->addDays(3)->setHour(18)->setMinute(0),
                'duration' => 780, // 13h
                'price' => 850.00,
                'available_seats' => 180,
                'class' => 'first',
            ]
        ];

        foreach ($flights as $flight) {
            Flight::create($flight);
        }

        // Create Sample User
        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone' => '+1234567890',
            'password' => Hash::make('password'),
            'date_of_birth' => '1990-01-01',
            'nationality' => 'US',
            'passport_number' => 'AB123456',
            'passport_expiry' => '2028-12-31',
            'gender' => 'male',
        ]);
    }
}
