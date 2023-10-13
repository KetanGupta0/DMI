<?php

namespace App\Models;

use CodeIgniter\Model;

class applicationModel extends Model
{
    protected $table = 'application';
    protected $primaryKey = 'application_id';
    protected $allowedFields = [
        'applicant_name_english',
        'applicant_name_hindi',
        'applicant_dob',
        'applicant_father',
        'applicant_mother',
        'applicant_email',
        'applicant_gender',
        'applicant_mobile',
        'applicant_ug_status',
        'inter_passing_year',
        'inter_college_name',
        'inter_marks',
        'ug_passing_year',
        'ug_college_name',
        'ug_marks',
        'applicant_village',
        'applicant_post',
        'applicant_block',
        'applicant_district',
        'applicant_state',
        'applicant_pin',
        'applicant_payment_ref',
        'applicant_payment_date',
        'applicant_photo',
        'applicant_signature',
        'application_date',
        'status_flag'
    ];

    public function updateRecord($recordId, $data)
    {
        $existingRecord = $this->find($recordId);
        if ($existingRecord) {
            $this->update($recordId, $data);
        } else {
            throw new \RuntimeException('Record not found.');
        }
    }
}


