<?php

namespace App\Controllers;

use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    public function index()
    {
        echo view('frontend/login');
    }


    public function logout()
    {
        session();
        session_destroy();

        return redirect()->to('/login');
    }

    public function loginCheck(): ResponseInterface {
        $input = $this->request->getVar();

        if (filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
            $userModel = new User();
            $data = $userModel->where('email', $input['email'])->first();

            if ($data) {
                $pass = $data['password'];

                $authenticatePassword = $input['password'] == $pass;

                if ($authenticatePassword) {
                    $ses_data = [
                        'id' => $data['user_id'],
                        'name' => $data['first_name'],
                        'email' => $data['email'],
                        'isLoggedIn' => TRUE
                    ];

                    $session = session();
                    $session->set($ses_data);

                    $string = [
                        'message' => "Login Successful",
                        'role' => $data['role']
                    ];
                } else {

                    $string = ["message" => "Invalid Credentials"];
                }
            } else {

                $string = ["message" => "No such Record"];
            }
        } else {
            $string = ["message" => "Not a valid email"];
        }

        return $this->response->setJSON($string);
    }
}
