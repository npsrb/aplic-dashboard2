<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{

    public function index()
    {
        $data = [
            'controller'        => 'Home',
            'title'             => 'Aplic Dashboard Home Page',
            'whoami'            => $this->session->get("user_name"),
        ];

        return view('pages\home', $data);
    }
}
