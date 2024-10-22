<?php

namespace App\Services;

use App\Repositories\TaxBandRepository;

class TaxCalculatorService
{
    protected $taxBandRepository;

    public function __construct(TaxBandRepository $taxBandRepository)
    {
        $this->taxBandRepository = $taxBandRepository;
    }

    /**
     * Calculates the tax and returns salary details
     *
     * @param float $grossSalary
     * @return array
     */
    public function calculate(float $grossSalary): array
    {
        $taxBands = $this->taxBandRepository->getAllTaxBands();
        $totalTax = 0;

        $totalTax = $taxBands->reduce(function ($carry, $band) use ($grossSalary) {
            if ($grossSalary > $band->lower_limit) {
                $taxableIncome = $band->upper_limit
                    ? min($grossSalary, $band->upper_limit) - $band->lower_limit
                    : $grossSalary - $band->lower_limit;
                $carry += $taxableIncome * ($band->rate / 100);
            }
            return $carry;
        }, 0);

        $netSalary = $grossSalary - $totalTax;

        return [
            'gross_salary' => $grossSalary,
            'gross_monthly_salary' => $grossSalary / 12,
            'net_annual_salary' => $netSalary,
            'net_monthly_salary' => $netSalary / 12,
            'annual_tax_paid' => $totalTax,
            'monthly_tax_paid' => $totalTax / 12,
        ];
    }
}
