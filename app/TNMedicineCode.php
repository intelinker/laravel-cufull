<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TNMedicineCode extends Model
{
    protected $fillable = [
        'code', 'factory', 'drug',
    ];
}
