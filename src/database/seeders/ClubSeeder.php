<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Club;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Club::insert([
            [
                'name' => 'Manchester United Football Club',
                'short_name' => 'Man Utd',
                'city' => 'Manchester',
                'country' => 'England',
                'founded_year' => 1878,
                'owner_name' => 'Joel Glazer',
                'contact_email' => 'contact@manutd.co.uk',
                'contact_phone' => '+441612345678',
                'stadium_name' => 'Old Trafford',
                'stadium_address' => 'Sir Matt Busby Way, Manchester M16 0RA',
                'api_token' => 'tokenmu1'
            ],
            [
                'name' => 'Real Madrid Club de Fútbol',
                'short_name' => 'Real Madrid',
                'city' => 'Madrid',
                'country' => 'Spain',
                'founded_year' => 1902,
                'owner_name' => 'Florentino Pérez',
                'contact_email' => 'info@realmadrid.com',
                'contact_phone' => '+34912345678',
                'stadium_name' => 'Santiago Bernabéu',
                'stadium_address' => 'Av. de Concha Espina, 1, 28036 Madrid',
                'api_token' => 'tokenmdr1'
            ]
        ]);
    }
}
