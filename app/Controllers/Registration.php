<?php

namespace App\Controllers;

use App\Models\Role;
use App\Models\User;

class Registration extends BaseController
{
    public function index()
    {
        return view('frontend/register');
    }

    public function regCheck()
    {
        $data = $this->request->getVar();
//        echo "<pre>"; print_r($data); die;
//        echo "<pre>"; print_r((new Role())->where('role_name', 'User')->first()['role_id']); die;

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

                $newUser['role'] = $data['role'] ?? (new Role())->where('role_name', 'User')->first()['role_id'];

                $id = $userModel->createUser($newUser);

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

    public function apiRegister() {
        $rules = [
            'first_name'            => 'required|min_length[2]|max_length[50]',
            'last_name'             => 'required|min_length[2]|max_length[50]',
            'email'                 => 'required|valid_email|is_unique[users.email]',
            'gender'                => 'required|in_list[male,female]',
            'password'              => 'required|min_length[7]|max_length[20]',
            'password_confirmation' => 'required|matches[password]',
        ];
        $messages = [
            'password_confirmation' => [
                'matches' => 'Your passwords do not match.'
            ],
            'email'                 => ['is_unique' => 'The email provided is already in use.']
        ];

        $data = $this->request->getVar();

        try {
            $data['role_id'] = Role::whereName('Api User')->value('id');
            $data['username'] = $data['username'] ?? $data['email'];
            $data['key'] = uniqid('cf_api-', true);

            if(!$this->validate($rules, $messages)) {
                return $this->failValidationErrors($this->validator->getErrors());
            }

            $data['password'] = Password::hash($this->request->getVar('password'));

            $user = User::create($data);
            $apiUser = $user->apiUser()->create($data);
            $apiUser->user = $user;

            return $this->respondCreated($apiUser, 'User created successfully! ✔');
        } catch (Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e->getMessage()]);
            return $this->failServerError($e->getMessage());
        }
    }
}
