<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\applicationModel;
use App\Models\ContactUs;
use App\Models\States;
use CodeIgniter\HTTP\Message;

class AuthController extends BaseController
{
    /**
     * @var Session
     */
    protected $session;

    public function __construct()
    {
        // Load the session service
        $this->session = \Config\Services::session();
    }

    // Auth Views
    public function login()
    {
        if ($this->session->has('logged_in') && $this->session->get('logged_in') === true) {
            return redirect('/');
        } else {
            echo view('header');
            echo view('login');
            echo view('footer');
        }
    }
    public function register()
    {
        if ($this->session->has('logged_in') && $this->session->get('logged_in') === true) {
            return redirect('/');
        } else {
            echo view('header');
            echo view('register');
            echo view('footer');
        }
    }

    // Auth Logics
    public function loginSubmit()
    {
        $validation = service('validation');
        $validationRules = [
            'email' => 'required|valid_email',
            'password' => 'required',
        ];
        $validationMessages = [
            'email' => [
                'required' => 'Email address is required.',
                'valid_email' => 'Please enter a valid email address.',
            ],
            'password' => [
                'required' => 'Password is required.',
            ],
        ];
        $validation->setRules($validationRules, $validationMessages);
        if ($this->session->has('logged_in') && $this->session->get('logged_in') === true) {
            return redirect('/');
        } else {
            if ($validation->withRequest($this->request)->run()) {
                $model = new ApplicationModel();
                $valid = false;
                $user = $model->where('applicant_email', $this->request->getPost('email'))->first();
                if ($user) {
                    $dateTime = new \DateTime($user['applicant_dob']);
                    $formattedDate = $dateTime->format('d-m-Y');
                    $formattedDateWithoutHyphens = str_replace('-', '', $formattedDate);
                    if ($formattedDateWithoutHyphens == $this->request->getPost('password')) {
                        $valid = true;
                    } else {
                        $this->session->setFlashdata('alertType', 'danger');
                        $this->session->setFlashdata('alertMessage', 'Invalid password!');
                        return redirect()->back();
                    }
                } else {
                    $this->session->setFlashdata('alertType', 'danger');
                    $this->session->setFlashdata('alertMessage', 'Email not registered!');
                    return redirect()->back();
                }
                if ($valid) {
                    $sessionData = [
                        'user_id' => $user['application_id'],
                        'email' => $user['applicant_email'],
                        'name' => $user['applicant_name_english'],
                        'mobile' => $user['applicant_mobile'],
                        'dob' => $user['applicant_dob'],
                        'status' => $user['status_flag'],
                        'logged_in' => true,
                    ];
                    $this->session->set($sessionData);
                    $this->session->setFlashdata('alertType', 'success');
                    $this->session->setFlashdata('alertMessage', 'Login successful');
                    return redirect()->to('/form');
                } else {
                    $this->session->setFlashdata('alertType', 'danger');
                    $this->session->setFlashdata('alertMessage', 'Invalid email or password.');
                    return redirect()->back();
                }
            } else {
                $this->session->setFlashdata('alertType', 'danger');
                $this->session->setFlashdata('alertMessage', 'Invalid email or password.');
                return redirect()->back();
            }
        }
    }
    public function registerSubmit()
    {
        if ($this->session->has('logged_in') && $this->session->get('logged_in') === true) {
            return redirect()->to('/');
        } else {
            $model = new applicationModel();
            $isEmailAvailable = $model->where('applicant_email', $this->request->getPost('email'))->first();
            $isMobileAvailable = $model->where('applicant_mobile', $this->request->getPost('mobile'))->first();

            if ($isEmailAvailable) {
                $this->session->setFlashdata('alertType', 'danger');
                $this->session->setFlashdata('alertMessage', 'Email is already used!');
                return redirect()->to('register');
            }
            if ($isMobileAvailable) {
                $this->session->setFlashdata('alertType', 'danger');
                $this->session->setFlashdata('alertMessage', 'Mobile is already used!');
                return redirect()->to('register');
            }
            if ($this->request->getPost('name') != '' && $this->request->getPost('dob') != '' && $this->request->getPost('email') != '' && $this->request->getPost('mobile') != '') {
                $data = [
                    'applicant_name_english' => $this->request->getPost('name'),
                    'applicant_dob' => $this->request->getPost('dob'),
                    'applicant_email' => $this->request->getPost('email'),
                    'applicant_mobile' => $this->request->getPost('mobile')
                ];

                if ($model->insert($data)) {

                    $email = service('email');

                    // Set email parameters
                    $email->setFrom('ckg4155@gmail.com', 'Ketan Gupta'); // This line needs attention
                    $email->setTo($this->request->getPost('email'));

                    // Additional recipients (CC and BCC)
                    // $ccEmails = ['cc1@example.com', 'cc2@example.com'];
                    // $bccEmails = ['bcc1@example.com', 'bcc2@example.com'];

                    $email->setSubject('DMI Registration Acknowledgement');
                    $email->setMessage('Thanks for showing interest in the Certificate course in Management. To enable further process, you are required to fill in details by login to the portal with your date of birth as password.');

                    // Send the email
                    if ($email->send()) {
                        $this->session->setFlashdata('alertType', 'success');
                        $this->session->setFlashdata('alertMessage', 'Account created successfully!');
                        return redirect()->to('login');
                    } else {
                        echo 'Error: ' . $email->printDebugger();
                    }
                } else {
                    $this->session->setFlashdata('alertType', 'danger');
                    $this->session->setFlashdata('alertMessage', 'Something went wrong!');
                    return redirect()->to('register');
                }
            } else {
                $this->session->setFlashdata('alertType', 'danger');
                $this->session->setFlashdata('alertMessage', 'All fields are required!');
                return redirect()->to('register');
            }
        }
    }

    // Logout
    public function logout()
    {
        $session = \Config\Services::session();
        // Destroy the session
        $session->destroy();
        return redirect('/');
    }

    public function contactUsData()
    {
        $model = new ContactUs();
        $email = $this->request->getPost('email');
        $name = $this->request->getPost('name');
        $subject = $this->request->getPost('subject');
        $message = $this->request->getPost('message');
        if ($email == '' || $name == '' || $subject == '' || $message == '') {
            $this->session->setFlashdata('alertType', 'error');
            $this->session->setFlashdata('alertMessage', 'Required fields cannot be blank!');
            return redirect()->back();
        } else {
            $data = [
                'user_name' => $name,
                'user_email' => $email,
                'user_subject' => $subject,
                'user_description' => $message
            ];
            if ($model->insert($data)) {
                $this->session->setFlashdata('alertType', 'success');
                $this->session->setFlashdata('alertMessage', 'Record saved successfully!');
                return redirect()->back();
            } else {
                $this->session->setFlashdata('alertType', 'error');
                $this->session->setFlashdata('alertMessage', 'Please try after sometimes!');
                return redirect()->back();
            }
        }
    }

    // Test function
    public function test()
    {
        echo view('basic');
    }
}
