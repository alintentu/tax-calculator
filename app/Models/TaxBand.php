<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxBand extends Model
{
    protected $fillable = ['lower_limit', 'upper_limit', 'rate'];
}
