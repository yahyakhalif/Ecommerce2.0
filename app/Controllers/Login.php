<?php

namespace App\Controllers;

use App\Libraries\OAuth\OAuth;
use App\Models\ApiUser;
use App\Models\User;
use App\Models\UserLogin;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use DateTime;
use DateTimeZone;
use OAuth2\Request;

class Login extends BaseController
{
    use ResponseTrait;

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
                    $user = new UserLogin();
                    $timezone = new DateTimeZone('Africa/Nairobi');
                    $date = new DateTime('now', $timezone);

                    $login = [
                        'user_id' => $data['user_id'],
                        'user_ip' => $this->request->getIPAddress(),
                        'login_time' => $date->format('Y-m-d H:i:s')
                    ];
                    $login_id = $user->login($login);

                    $ses_data = [
                        'id' => $data['user_id'],
                        'name' => $data['first_name'],
                        'email' => $data['email'],
                        'isLoggedIn' => TRUE,
                        'orders' => [],
                        'login_id' => $login_id
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

    public function apiLogin(): Response
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $userModel = new User();
        $user = $userModel->where('email', $email)->first();

        if($password !== $user['password'] ?? null) {
            return $this->failForbidden('Invalid credentials');
        }

        unset($user['password']);

        $apiKey = ApiUser::whereAddedBy($user['user_id'])->first()['key'];

        return $this->respond(['message' => 'Login successful', 'user' => $user, 'api_key' => $apiKey]);
    }
}
