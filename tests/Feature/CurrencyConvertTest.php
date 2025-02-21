<?php

namespace Tests\Feature;

use App\Models\ExchangeRate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CurrencyConvertTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        
        ExchangeRate::create([
            'from' => 'SGD',
            'to' => 'PLN',
            'rate' => 2.97,
        ]);
    }

    public function test_currency_conversion_successful()
    {
        $response = $this->getJson('/api/convert?amount=100');

        $response->assertStatus(200)
                 ->assertJson([
                    'success' => true,
                    'message' => 'Currency converted successfully',
                    'data' => [
                        'amount' => 100,
                        'from' => 'SGD',
                        'to' => 'PLN',
                        'exchange_rate' => 2.97,
                        'converted_amount' => 297
                    ],
                 ]);
    }

    public function test_currency_conversion_requires_amount()
    {
        $response = $this->getJson('/api/convert', []);

        $response->assertStatus(422)
             ->assertJsonStructure([
                "error",
             ]);
    }
}
