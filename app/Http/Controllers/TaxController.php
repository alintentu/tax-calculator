<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaxBand;

class TaxController extends Controller
{
    public function calculate(Request $request)
    {
        $request->validate([
            'gross_salary' => 'required|numeric|min:0',
        ]);

        $grossSalary = $request->input('gross_salary');
        // $taxBands = TaxBand::all();
        $taxBands = Cache::remember('tax_bands', 60 * 60, function() {
            return TaxBand::all();
        });
        $totalTax = 0;

        foreach ($taxBands as $band) {
            if ($grossSalary > $band->lower_limit) {
                $taxableIncome = $band->upper_limit
                    ? min($grossSalary, $band->upper_limit) - $band->lower_limit
                    : $grossSalary - $band->lower_limit;
                $totalTax += $taxableIncome * ($band->rate / 100);
            }
        }

        $netSalary = $grossSalary - $totalTax;

        return view('results', [
            'gross_salary' => $grossSalary,
            'gross_monthly_salary' => $grossSalary / 12,
            'net_annual_salary' => $netSalary,
            'net_monthly_salary' => $netSalary / 12,
            'annual_tax_paid' => $totalTax,
            'monthly_tax_paid' => $totalTax / 12
        ]);
    }

    public function showForm()
    {
        return view('salary_form');
    }
}
