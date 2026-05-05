<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Website;
class ClientWebSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client1 = Client::create([
            'email' => 'client1@example.com'
        ]);
        Website::create([
            'url' => 'https://example.com',
            'client_id' => $client1->id
        ]);
        Website::create([
            'url' => 'https://google.com',
            'client_id' => $client1->id
        ]);

        $client2 = Client::create([
            'email' => 'client2@example.com'
        ]);
        Website::create([
            'url' => 'https://laravel.com',
            'client_id' => $client2->id
        ]);
    }
}
