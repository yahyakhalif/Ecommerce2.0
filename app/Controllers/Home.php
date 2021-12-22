<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        session();
        $notThere['num'] = 1;

        if (isset($_SESSION['name']))
            echo view('/frontend/homepage', $_SESSION);
        else
            echo view('frontend/login', $notThere);
    }
}
