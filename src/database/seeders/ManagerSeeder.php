<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Manager;

class ManagerSeeder extends Seeder
{
    public function run(): void
    {
        Manager::create([
            'name' => 'Pep Guardiola',
            'nationality' => 'Spain',
            'birth_date' => '1971-01-18',
            'experience_years' => 15,
            'license_type' => 'UEFA Pro',
            'contact_email' => 'pep@club.com',
            'contact_phone' => '+628123456789',
            'club_id' => 1, // pastikan club dengan ID 1 sudah ada
        ]);
    }
}
