<?php

namespace App\Repositories;

use App\Models\TaxBand;

class TaxBandRepository
{
    /**
     * Retrieve all tax bands from the database
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllTaxBands()
    {
        return TaxBand::all();
    }
}
