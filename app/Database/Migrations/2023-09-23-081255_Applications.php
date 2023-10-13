<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Applications extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'application_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'applicant_name_english' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'applicant_name_hindi' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'applicant_dob' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'applicant_father' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'applicant_mother' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'applicant_email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'applicant_gender' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'applicant_mobile' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'applicant_ug_status' => [
                'type'       => 'INT',
                'constraint' => 2,
            ],
            'inter_passing_year' => [
                'type'       => 'INT',
                'constraint' => 4,
            ],
            'inter_college_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'inter_marks' => [
                'type'       => 'INT',
                'constraint' => 3,
            ],
            'ug_passing_year' => [
                'type'       => 'INT',
                'constraint' => 4,
                'null' => true,
            ],
            'ug_college_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'ug_marks' => [
                'type'       => 'INT',
                'constraint' => 3,
            ],
            'applicant_village' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'applicant_post' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'applicant_block' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'applicant_district' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'applicant_state' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'applicant_pin' => [
                'type'       => 'INT',
                'constraint' => 6,
            ],
            'applicant_payment_ref' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'applicant_payment_date' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'applicant_photo' => [
                'type'       => 'VARCHAR',
                'constraint' => '256',
            ],
            'applicant_signature' => [
                'type'       => 'VARCHAR',
                'constraint' => '256',
            ],
            'application_description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('application_id', true);
        $this->forge->createTable('application');
    }

    public function down()
    {
        //
    }
}
