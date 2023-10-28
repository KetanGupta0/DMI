<?php

namespace App\Controllers;

use App\Models\applicationModel;
use App\Models\District;
use App\Models\States;
use CodeIgniter\Controller;

class ApplicationController extends BaseController
{
    /**
     * @var Session
     */
    protected $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }
    public function saveApplication()
    {
        if ($this->session->has('logged_in') && $this->session->get('logged_in') === true) {
            $userData = $this->session->get();
            $model = new ApplicationModel();
            $existingRecord = $model->find($userData['user_id']);
            if ($existingRecord) {
                $currentTimestamp = time();
                $formattedDate = date('Y-m-d H:i:s', $currentTimestamp);
                $photo = $this->request->getFile('photo');
                $signature = $this->request->getFile('signature');
                $photoName = time() . '_' . $photo->getName();
                $signatureName = time() . '_' . $signature->getName();
                $photo->move('public/img/uploads/', $photoName);
                $signature->move('public/img/uploads/', $signatureName);
                $grad = $this->request->getPost('grad');
                $existingRecord['applicant_name_hindi'] = $this->request->getPost('hname');
                $existingRecord['applicant_father'] = $this->request->getPost('fname');
                $existingRecord['applicant_mother'] = $this->request->getPost('mname');
                $existingRecord['applicant_gender'] = $this->request->getPost('gender');
                $existingRecord['applicant_ug_status'] = $grad;
                $existingRecord['inter_passing_year'] = $this->request->getPost('interPassingYear');
                $existingRecord['inter_college_name'] = $this->request->getPost('interCollege');
                $existingRecord['inter_marks'] = $this->request->getPost('interMarks');
                $existingRecord['applicant_village'] = $this->request->getPost('village');
                $existingRecord['applicant_post'] = $this->request->getPost('post');
                $existingRecord['applicant_block'] = $this->request->getPost('block');
                $existingRecord['applicant_district'] = $this->request->getPost('district');
                $existingRecord['applicant_state'] = $this->request->getPost('state');
                $existingRecord['applicant_pin'] = $this->request->getPost('pin');
                $existingRecord['applicant_photo'] = $photoName;
                $existingRecord['applicant_signature'] = $signatureName;
                $existingRecord['application_date'] = $formattedDate;
                $existingRecord['status_flag'] = 2;
                if ($grad == 'Yes') {
                    $existingRecord['ug_passing_year'] = $this->request->getPost('graduationPassingYear');
                    $existingRecord['ug_college_name'] = $this->request->getPost('graduationCollege');
                    $existingRecord['ug_marks'] = $this->request->getPost('graduationMarks');
                }
                if ($model->update($userData['user_id'], $existingRecord)) {
                    $email = service('email');

                    // Set email parameters
                    $email->setFrom('ckg4155@gmail.com', 'Ketan Gupta'); // This line needs attention
                    $email->setTo($this->session->get('email'));
                    $email->setSubject('CCM Registration');
                    $email->setMessage('Thanks for registering for the Certificate course in Management, your are required to visit the Institue and pay the Course fee with the printout of the filled in application form.');

                    // Send the email
                    if ($email->send()) {
                        return $this->response->setJSON(['msg' => true, 'data' => $existingRecord]);
                    } else {
                        echo 'Error: ' . $email->printDebugger();
                    }
                } else {
                    return $this->response->setJSON(false);
                }
            } else {
                return $this->response->setJSON('Invalid data');
            }
        }
    }
    public function getApplicantRecord()
    {
        if ($this->session->has('logged_in') && $this->session->get('logged_in') === true) {
            $userData = $this->session->get();
            $userMobile = $userData['mobile'];
            $model = new ApplicationModel();
            $record = $model->where('applicant_mobile', $userMobile)->first();
            if ($record) {
                $sessionData = [
                    'status' => $record['status_flag'],
                ];
                $this->session->set($sessionData);
                return $this->response->setJSON($record);
            }
        }
    }

    public function states(){
        $model = new States();
        $states = $model->orderBy('name', 'asc')->findAll();
        if($states){
            return $this->response->setJSON($states);
        }
    }
    public function cities(){
        $model = new District();
        $sid = $this->request->getPost('id');
        $cities = $model->where('state_id',$sid)->orderBy('name', 'asc')->findAll();
        if($cities){
            return $this->response->setJSON($cities);
        }
    }
}