<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Player;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Player::insert([
            [
                'name' => 'Marcus Rashford',
                'position' => 'Forward',
                'nationality' => 'England',
                'birth_date' => '1997-10-31',
                'birth_place' => 'Manchester',
                'passport_number' => 'UK1234567',
                'salary' => 200000.00,
                'contract_start' => '2023-07-01',
                'contract_end' => '2026-06-30',
                'medical_record' => 'No known conditions.',
                'agent_name' => 'Dwaine Maynard',
                'contact_email' => 'rashford@manutd.co.uk',
                'contact_phone' => '+447911223344',
                'club_id' => 1,
                'api_token' => "212"
            ],
            [
                'name' => 'Luka Modrić',
                'position' => 'Midfielder',
                'nationality' => 'Croatia',
                'birth_date' => '1985-09-09',
                'birth_place' => 'Zadar',
                'passport_number' => 'HR9876543',
                'salary' => 180000.00,
                'contract_start' => '2022-07-01',
                'contract_end' => '2025-06-30',
                'medical_record' => 'Knee surgery in 2018.',
                'agent_name' => 'Vlado Lemić',
                'contact_email' => 'modric@realmadrid.com',
                'contact_phone' => '+385911234567',
                'club_id' => 2,
                'api_token' => "215"
            ]
        ]);
    }
}
