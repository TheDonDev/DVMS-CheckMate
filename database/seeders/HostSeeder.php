<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Host;

class HostSeeder extends Seeder
{
    public function run()
    {
        Host::create([
            'name' => 'Prof. Barasa Lwagula',
            'email' => 'barasa@example.com',
        ]);

        Host::create([
            'name' => 'Prof. John Chang\'ach',
            'email' => 'john@example.com',
        ]);

        Host::create([
            'name' => 'Dr. Bostley Asenahabi',
            'email' => 'john@example.com',
        ]);

        Host::create([
            'name' => 'Dr. Titus Muhambe',
            'email' => 'dmakori@student.au.ac.ke',
        ]);

        Host::create([
            'name' => 'Dr. Victor Mengwa',
            'email' => 'john@example.com',
        ]);

        Host::create([
            'name' => 'Dr  Caren Muhambe',
            'email' => 'john@example.com',
        ]);

        Host::create([
            'name' => 'Genevive Nasimihu',
            'email' => 'john@example.com',
        ]);
    }
}