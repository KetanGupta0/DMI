<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DemoController extends BaseController
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
    public function english()
    {
        echo view('header1');
        echo view('english1');
        echo view('footer1');
    }
    public function hindi()
    {
        echo view('header1');
        echo view('hindi1');
        echo view('footer1');
    }
    public function login()
    {
        if ($this->session->has('logged_in') && $this->session->get('logged_in') === true){
            return redirect('/');
        } else {
            echo view('header1');
            echo view('login1');
            echo view('footer1');
        }
    }
}
