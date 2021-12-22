<?php

namespace App\Controllers;

use App\Models\User;

class Registration extends BaseController
{
    public function index() {
        return view('frontend/register');
    }

    public function regCheck() {
        $data = $this->request->getVar();
//        echo "<pre>"; print_r($data); die;

        if(filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {

            $userModel = new User();

            $check = $userModel->where('email', $data['email'])->first();

            if($check) {
                $string = ["message" => "Email already exists"];
            } else {

                $newUser = [
                    'first_name' => $data['first_name'],
                    'last_name'  => $data['last_name'],
                    'email'      => $data['email'],
                    'password'   => $data['pass'],
                    'gender'     => $data['gender'],
                ];

                $newAdmin = $newUser;
                $newAdmin['role'] = $data['role'] ?? null;

                if(!isset($data['role'])) $id = $userModel->createUser($newUser); else
                    $id = $userModel->createUser($newAdmin);

                if(is_int($id)) {

                    $ses_data = $newUser;
                    $ses_data['id'] = $id;
                    $ses_data['isLoggedIn'] = true;

                    $session = session();
                    $session->set($ses_data);
                    $string = ["message" => "Registration Successful"];
                } else {
                    $string = ["message" => "Registration Failed"];
                }
            }
        } else {
            $string = ["message" => "Not a valid email"];
        }
        return $this->response->setJSON($string);
    }
}
