<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactUs extends Model
{
    protected $table            = 'contact_us';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'user_name',
        'user_email',
        'user_subject',
        'user_description',
        'created_at',
        'deleted_at',
        'deleted_by'
    ];
}
