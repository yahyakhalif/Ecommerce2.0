<?php

namespace App\Controllers;

use App\Models\Role;
use App\Models\User;
use CodeIgniter\HTTP\Response;
use CodeIgniter\RESTful\ResourceController;
use Config\Services;
use Exception;

class UserController extends ResourceController
{
    protected $format = 'json';

    public function __construct() { Services::eloquent(); }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return Response
     */
    public function index(): Response
    {
        try {
            $users = (new User())->findAll();

            return $this->respond($users);
        } catch (Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    /**
     * Return the properties of a resource object
     *
     * @param null $id
     * @return mixed
     */
    public function show($id = null): mixed {
        try {
            $user = (new User())->find($id);

            return $this->respond($user);
        } catch (Exception $e) {
            return $this->failNotFound('User not found.');
        }
    }
}
