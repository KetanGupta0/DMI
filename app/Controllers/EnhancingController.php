<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class EnhancingController extends BaseController
{
    public function entry(){
        echo view('header');
        echo view('enhancing');
        echo view('footer');
    }
}
