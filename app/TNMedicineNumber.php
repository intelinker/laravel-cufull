<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TNMedicineNumber extends Model
{
    protected $fillable = [
        'number', 'factory', 'drug',
    ];
}
