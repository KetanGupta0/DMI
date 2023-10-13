<?php

namespace App\Controllers;

class Home extends BaseController
{
    /**
     * @var Session
     */
    protected $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        return redirect('index1');
    }
    public function english()
    {
        echo view('header');
        echo view('english');
        echo view('footer');
    }
    public function hindi()
    {
        echo view('header');
        echo view('hindi');
        echo view('footer');
    }
    public function form()
    {
        if ($this->session->has('logged_in') && $this->session->get('logged_in') === true) {
            echo view('header');
            echo view('form');
            echo view('footer');
        } else {
            return redirect('login');
        }
    }
}
