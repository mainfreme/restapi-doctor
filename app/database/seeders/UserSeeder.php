<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\PatientFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminDoctor = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('haslo123'),
            'type' => 'lekarz',
        ]);

        $whoDoctor = User::create([
            'name' => 'Who Doctor',
            'email' => 'who@example.com',
            'password' => Hash::make('haslo123'),
            'type' => 'lekarz',
        ]);

        // Pacjenci dla Admina
        User::factory()->count(5)->create([
            'type' => 'pacjent',
            'doctor_id' => $adminDoctor->id,
        ]);

        // Pacjenci dla Who Doctor
        User::factory()->count(5)->create([
            'type' => 'pacjent',
            'doctor_id' => $whoDoctor->id,
        ]);
    }
}
