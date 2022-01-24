<?php

namespace App\Controllers;

use App\Libraries\OAuth\OAuth;
use App\Models\User;
use App\Models\UserLogin;
use CodeIgniter\API\ResponseTrait;
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

    public function apiLogin() {
        $oAuth = new OAuth();

        $request = new Request();
        $response = $oAuth->server->handleTokenRequest($request->createFromGlobals());

        $code = $response->getStatusCode();
        $body = $response->getResponseBody();

        return $this->respond(json_decode($body), $code);
    }
}
