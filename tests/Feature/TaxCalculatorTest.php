<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\TaxBand;

class TaxCalculatorTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        TaxBand::create(['lower_limit' => 0, 'upper_limit' => 5000, 'rate' => 0]);
        TaxBand::create(['lower_limit' => 5000, 'upper_limit' => 20000, 'rate' => 20]);
        TaxBand::create(['lower_limit' => 20000, 'upper_limit' => null, 'rate' => 40]);
    }

    public function test_tax_calculation_for_40000_salary()
    {
        $response = $this->post('/calculate', ['gross_salary' => 40000]);

        $response->assertStatus(200)
                 ->assertSee('£40,000.00')
                 ->assertSee('£3,333.33')
                 ->assertSee('£29,000.00')
                 ->assertSee('£2,416.67')
                 ->assertSee('£11,000.00')
                 ->assertSee('£916.67');
    }

    public function test_tax_calculation_for_10000_salary()
    {
        $response = $this->post('/calculate', ['gross_salary' => 10000]);

        $response->assertStatus(200)
                 ->assertSee('£10,000.00')
                 ->assertSee('£833.33')
                 ->assertSee('£9,000.00')
                 ->assertSee('£750.00')
                 ->assertSee('£1,000.00')
                 ->assertSee('£83.33');
    }

    public function test_invalid_salary_input()
    {
        $response = $this->post('/calculate', ['gross_salary' => -10000]);

        $response->assertSessionHasErrors('gross_salary');
    }
}
