<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Flight;
use App\Models\Airline;
use App\Models\Airport;
use Carbon\Carbon;

class FlightSeeder extends Seeder
{
    public function run()
    {
        // Get or create airlines - USING EXACT COLUMNS FROM YOUR MIGRATION
        $qatarAirways = Airline::firstOrCreate([
            'code' => 'QR'
        ], [
            'name' => 'Qatar Airways',
            'logo' => 'qatar_airways.png',
            'country' => 'Qatar',
            'description' => 'National airline of Qatar'
        ]);

        $emirates = Airline::firstOrCreate([
            'code' => 'EK'
        ], [
            'name' => 'Emirates',
            'logo' => 'emirates.png',
            'country' => 'UAE',
            'description' => 'Flag carrier of the United Arab Emirates'
        ]);

        $ethiopian = Airline::firstOrCreate([
            'code' => 'ET'
        ], [
            'name' => 'Ethiopian Airlines',
            'logo' => 'ethiopian.png',
            'country' => 'Ethiopia',
            'description' => 'Flag carrier of Ethiopia'
        ]);

        $britishAirways = Airline::firstOrCreate([
            'code' => 'BA'
        ], [
            'name' => 'British Airways',
            'logo' => 'british_airways.png',
            'country' => 'United Kingdom',
            'description' => 'Flag carrier of the United Kingdom'
        ]);

        $airFrance = Airline::firstOrCreate([
            'code' => 'AF'
        ], [
            'name' => 'Air France',
            'logo' => 'air_france.png',
            'country' => 'France',
            'description' => 'Flag carrier of France'
        ]);

        // Get or create airports
        $doh = Airport::firstOrCreate(['code' => 'DOH'], [
            'name' => 'Hamad International Airport',
            'city' => 'Doha',
            'country' => 'Qatar',
            'timezone' => 'Asia/Qatar',
            'is_active' => true
        ]);

        $dxb = Airport::firstOrCreate(['code' => 'DXB'], [
            'name' => 'Dubai International Airport',
            'city' => 'Dubai',
            'country' => 'UAE',
            'timezone' => 'Asia/Dubai',
            'is_active' => true
        ]);

        $add = Airport::firstOrCreate(['code' => 'ADD'], [
            'name' => 'Bole International Airport',
            'city' => 'Addis Ababa',
            'country' => 'Ethiopia',
            'timezone' => 'Africa/Addis_Ababa',
            'is_active' => true
        ]);

        $los = Airport::firstOrCreate(['code' => 'LOS'], [
            'name' => 'Murtala Muhammed International Airport',
            'city' => 'Lagos',
            'country' => 'Nigeria',
            'timezone' => 'Africa/Lagos',
            'is_active' => true
        ]);

        $lhr = Airport::firstOrCreate(['code' => 'LHR'], [
            'name' => 'Heathrow Airport',
            'city' => 'London',
            'country' => 'UK',
            'timezone' => 'Europe/London',
            'is_active' => true
        ]);

        $cdg = Airport::firstOrCreate(['code' => 'CDG'], [
            'name' => 'Charles de Gaulle Airport',
            'city' => 'Paris',
            'country' => 'France',
            'timezone' => 'Europe/Paris',
            'is_active' => true
        ]);

        $jfk = Airport::firstOrCreate(['code' => 'JFK'], [
            'name' => 'John F. Kennedy International Airport',
            'city' => 'New York',
            'country' => 'USA',
            'timezone' => 'America/New_York',
            'is_active' => true
        ]);

        $nbo = Airport::firstOrCreate(['code' => 'NBO'], [
            'name' => 'Jomo Kenyatta International Airport',
            'city' => 'Nairobi',
            'country' => 'Kenya',
            'timezone' => 'Africa/Nairobi',
            'is_active' => true
        ]);

        $jnb = Airport::firstOrCreate(['code' => 'JNB'], [
            'name' => 'O.R. Tambo International Airport',
            'city' => 'Johannesburg',
            'country' => 'South Africa',
            'timezone' => 'Africa/Johannesburg',
            'is_active' => true
        ]);

        $bom = Airport::firstOrCreate(['code' => 'BOM'], [
            'name' => 'Chhatrapati Shivaji Maharaj International Airport',
            'city' => 'Mumbai',
            'country' => 'India',
            'timezone' => 'Asia/Kolkata',
            'is_active' => true
        ]);

        // Sample flights data - REMOVED aircraft_type column
        $flights = [
            // Qatar Airways flights
            [
                'flight_number' => 'QR123',
                'airline_id' => $qatarAirways->id,
                'departure_airport_id' => $doh->id,
                'arrival_airport_id' => $dxb->id,
                'departure_time' => Carbon::now()->addDays(1)->setTime(8, 0),
                'arrival_time' => Carbon::now()->addDays(1)->setTime(10, 30),
                'duration' => 150,
                'class' => 'economy',
                'price' => 299.99,
                'available_seats' => 150,
                'status' => 'scheduled'
            ],
            [
                'flight_number' => 'QR456',
                'airline_id' => $qatarAirways->id,
                'departure_airport_id' => $doh->id,
                'arrival_airport_id' => $lhr->id,
                'departure_time' => Carbon::now()->addDays(1)->setTime(14, 0),
                'arrival_time' => Carbon::now()->addDays(1)->setTime(19, 30),
                'duration' => 450,
                'class' => 'business',
                'price' => 1899.99,
                'available_seats' => 40,
                'status' => 'scheduled'
            ],
            [
                'flight_number' => 'QR789',
                'airline_id' => $qatarAirways->id,
                'departure_airport_id' => $doh->id,
                'arrival_airport_id' => $jfk->id,
                'departure_time' => Carbon::now()->addDays(2)->setTime(10, 0),
                'arrival_time' => Carbon::now()->addDays(2)->setTime(17, 0),
                'duration' => 780,
                'class' => 'first',
                'price' => 3499.99,
                'available_seats' => 12,
                'status' => 'scheduled'
            ],

            // Emirates flights
            [
                'flight_number' => 'EK202',
                'airline_id' => $emirates->id,
                'departure_airport_id' => $dxb->id,
                'arrival_airport_id' => $lhr->id,
                'departure_time' => Carbon::now()->addDays(1)->setTime(9, 30),
                'arrival_time' => Carbon::now()->addDays(1)->setTime(13, 45),
                'duration' => 435,
                'class' => 'economy',
                'price' => 599.99,
                'available_seats' => 200,
                'status' => 'scheduled'
            ],
            [
                'flight_number' => 'EK404',
                'airline_id' => $emirates->id,
                'departure_airport_id' => $dxb->id,
                'arrival_airport_id' => $bom->id,
                'departure_time' => Carbon::now()->addDays(1)->setTime(16, 0),
                'arrival_time' => Carbon::now()->addDays(1)->setTime(20, 30),
                'duration' => 210,
                'class' => 'business',
                'price' => 1299.99,
                'available_seats' => 35,
                'status' => 'scheduled'
            ],

            // Ethiopian Airlines flights
            [
                'flight_number' => 'ET500',
                'airline_id' => $ethiopian->id,
                'departure_airport_id' => $add->id,
                'arrival_airport_id' => $los->id,
                'departure_time' => Carbon::now()->addDays(1)->setTime(11, 0),
                'arrival_time' => Carbon::now()->addDays(1)->setTime(14, 30),
                'duration' => 210,
                'class' => 'economy',
                'price' => 399.99,
                'available_seats' => 120,
                'status' => 'scheduled'
            ],
            [
                'flight_number' => 'ET600',
                'airline_id' => $ethiopian->id,
                'departure_airport_id' => $add->id,
                'arrival_airport_id' => $nbo->id,
                'departure_time' => Carbon::now()->addDays(1)->setTime(13, 0),
                'arrival_time' => Carbon::now()->addDays(1)->setTime(15, 0),
                'duration' => 120,
                'class' => 'economy',
                'price' => 249.99,
                'available_seats' => 70,
                'status' => 'scheduled'
            ],

            // British Airways flights
            [
                'flight_number' => 'BA178',
                'airline_id' => $britishAirways->id,
                'departure_airport_id' => $lhr->id,
                'arrival_airport_id' => $jfk->id,
                'departure_time' => Carbon::now()->addDays(1)->setTime(18, 0),
                'arrival_time' => Carbon::now()->addDays(1)->setTime(21, 0),
                'duration' => 480,
                'class' => 'economy',
                'price' => 699.99,
                'available_seats' => 180,
                'status' => 'scheduled'
            ],

            // Air France flights
            [
                'flight_number' => 'AF345',
                'airline_id' => $airFrance->id,
                'departure_airport_id' => $cdg->id,
                'arrival_airport_id' => $jnb->id,
                'departure_time' => Carbon::now()->addDays(1)->setTime(20, 0),
                'arrival_time' => Carbon::now()->addDays(2)->setTime(7, 0),
                'duration' => 660,
                'class' => 'business',
                'price' => 1599.99,
                'available_seats' => 28,
                'status' => 'scheduled'
            ],

            // More flights for better search results
            [
                'flight_number' => 'QR901',
                'airline_id' => $qatarAirways->id,
                'departure_airport_id' => $dxb->id,
                'arrival_airport_id' => $doh->id,
                'departure_time' => Carbon::now()->addDays(1)->setTime(19, 0),
                'arrival_time' => Carbon::now()->addDays(1)->setTime(21, 30),
                'duration' => 150,
                'class' => 'economy',
                'price' => 279.99,
                'available_seats' => 140,
                'status' => 'scheduled'
            ],
            [
                'flight_number' => 'EK801',
                'airline_id' => $emirates->id,
                'departure_airport_id' => $lhr->id,
                'arrival_airport_id' => $dxb->id,
                'departure_time' => Carbon::now()->addDays(2)->setTime(15, 0),
                'arrival_time' => Carbon::now()->addDays(2)->setTime(23, 30),
                'duration' => 450,
                'class' => 'business',
                'price' => 1399.99,
                'available_seats' => 32,
                'status' => 'scheduled'
            ],
        ];

        // Create flights
        foreach ($flights as $flightData) {
            Flight::firstOrCreate(
                [
                    'flight_number' => $flightData['flight_number'],
                    'departure_time' => $flightData['departure_time']
                ],
                $flightData
            );
        }

        $this->command->info('Flights seeded successfully!');
        $this->command->info('Total flights created: ' . count($flights));
    }
}
