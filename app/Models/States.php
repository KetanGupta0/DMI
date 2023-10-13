<?php

namespace App\Models;

use CodeIgniter\Model;

class States extends Model
{
    protected $table = 'states';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'name',
        'country_code'
    ];
}
