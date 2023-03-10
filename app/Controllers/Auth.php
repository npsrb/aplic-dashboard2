<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {
        echo "authentication controller";
    }
    public function login()
    {
        $response = array();
        if ($this->request->getPost()) {
            $data = $this->request->getPost();
            if ($this->userModel->where(['user_name' => $data["user_name"], 'user_password' => $data["user_password"]])->first()) {

                $yoursession = [
                    'username'  => $data['user_name'],
                    'logged_in' => TRUE
                ];

                $this->session->set($yoursession); // starting session
                $response['success'] = true;
                $response['messages'] = lang("App.login-success");
            } else {
                $response['success'] = false;
                $response['messages'] = lang("App.login-failed");
            }


            return $this->response->setJSON($response);
        }
        $data = [
            'controller'        => 'Auth',
            'title'             => 'Login Page',
        ];

        return view('pages\login', $data);
    }
    public function profil()
    {
        echo "profil";
    }
    public function forget()
    {
        $data = [
            'controller'        => 'Auth',
            'title'             => 'Forgot Password',
        ];

        return view('pages\forget_password', $data);
    }
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('login'));
    }
}
