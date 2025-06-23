<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tenant\User;
use App\Models\Tenant\Service;
use App\Models\Tenant\Staff;
use App\Models\Tenant\WorkingHour;
use Illuminate\Support\Facades\Hash;

class TenantDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '+1234567890',
            'address' => '123 Admin Street, City, State',
        ]);

        // Create sample services
        $services = [
            [
                'name' => 'Haircut',
                'description' => 'Professional haircut service',
                'price' => 25.00,
                'duration' => 30,
            ],
            [
                'name' => 'Hair Styling',
                'description' => 'Professional hair styling service',
                'price' => 35.00,
                'duration' => 45,
            ],
            [
                'name' => 'Hair Coloring',
                'description' => 'Professional hair coloring service',
                'price' => 75.00,
                'duration' => 120,
            ],
            [
                'name' => 'Manicure',
                'description' => 'Professional manicure service',
                'price' => 20.00,
                'duration' => 30,
            ],
            [
                'name' => 'Pedicure',
                'description' => 'Professional pedicure service',
                'price' => 30.00,
                'duration' => 45,
            ],
        ];

        foreach ($services as $serviceData) {
            Service::create($serviceData);
        }

        // Create sample staff
        $staffUsers = [
            [
                'name' => 'John Smith',
                'email' => 'john@example.com',
                'phone' => '+1234567891',
                'specialization' => 'Hair Styling',
                'bio' => 'Experienced hair stylist with 5 years of experience.',
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah@example.com',
                'phone' => '+1234567892',
                'specialization' => 'Hair Coloring',
                'bio' => 'Expert in hair coloring and highlights.',
            ],
            [
                'name' => 'Mike Wilson',
                'email' => 'mike@example.com',
                'phone' => '+1234567893',
                'specialization' => 'Nail Care',
                'bio' => 'Professional nail technician.',
            ],
        ];

        foreach ($staffUsers as $staffData) {
            $user = User::create([
                'name' => $staffData['name'],
                'email' => $staffData['email'],
                'password' => Hash::make('password'),
                'role' => 'staff',
                'phone' => $staffData['phone'],
            ]);

            $staff = Staff::create([
                'user_id' => $user->id,
                'specialization' => $staffData['specialization'],
                'bio' => $staffData['bio'],
            ]);

            // Assign services to staff
            if ($staffData['specialization'] === 'Hair Styling') {
                $staff->services()->attach([1, 2]); // Haircut and Hair Styling
            } elseif ($staffData['specialization'] === 'Hair Coloring') {
                $staff->services()->attach([3]); // Hair Coloring
            } elseif ($staffData['specialization'] === 'Nail Care') {
                $staff->services()->attach([4, 5]); // Manicure and Pedicure
            }

            // Create working hours for staff
            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
            foreach ($days as $day) {
                WorkingHour::create([
                    'staff_id' => $staff->id,
                    'day_of_week' => $day,
                    'start_time' => '09:00',
                    'end_time' => '17:00',
                    'is_working_day' => true,
                ]);
            }
        }

        // Create sample customers
        $customers = [
            [
                'name' => 'Alice Brown',
                'email' => 'alice@example.com',
                'phone' => '+1234567894',
                'address' => '456 Customer Ave, City, State',
            ],
            [
                'name' => 'Bob Davis',
                'email' => 'bob@example.com',
                'phone' => '+1234567895',
                'address' => '789 Customer Blvd, City, State',
            ],
            [
                'name' => 'Carol White',
                'email' => 'carol@example.com',
                'phone' => '+1234567896',
                'address' => '321 Customer Dr, City, State',
            ],
        ];

        foreach ($customers as $customerData) {
            User::create([
                'name' => $customerData['name'],
                'email' => $customerData['email'],
                'password' => Hash::make('password'),
                'role' => 'customer',
                'phone' => $customerData['phone'],
                'address' => $customerData['address'],
            ]);
        }
    }
} 