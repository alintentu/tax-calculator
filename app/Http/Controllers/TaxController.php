<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaxCalculatorService;

class TaxController extends Controller
{
    protected $taxCalculator;

    public function __construct(TaxCalculatorService $taxCalculator)
    {
        $this->taxCalculator = $taxCalculator;
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'gross_salary' => 'required|numeric|min:0',
        ]);

        $results = $this->taxCalculator->calculate($request->input('gross_salary'));

        return view('results', $results);
    }

    public function showForm()
    {
        return view('salary_form');
    }
}
