<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Client;
use App\Models\Website;

class ClientApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_clients_index()
    {
        Client::factory()->count(3)->create();

        $response = $this->get('/api/clients');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_client_websites()
    {
        $client = Client::factory()->create();
        Website::factory()->count(2)->create(['client_id' => $client->id]);

        $response = $this->get("/api/clients/{$client->id}/websites");

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'id',
                     'email',
                     'websites' => [
                         '*' => ['id', 'url', 'client_id']
                     ]
                 ]);
    }
}
