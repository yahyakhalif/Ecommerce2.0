<?php

namespace App\Filters;

use App\Libraries\OAuth\OAuth;
use App\Models\ApiUser;
use App\Models\User;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Exception;
use Myth\Auth\Password;
use OAuth2\Request;

class BasicAuthFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @throws Exception
     */
    public function before(RequestInterface $request, $arguments = null) {
        service('eloquent');

        $authRequest = Request::createFromGlobals();

        $apiKey = $authRequest->headers('api_key');
        header('Content-Type: application/json');
        if(!(isset($apiKey) && ApiUser::where('key', $apiKey)->exists())) {
            echo json_encode([
                'status'  => false,
                'code'  => 401,
                'message' => "Unauthorized access"
            ]);
            die;
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        //
    }
}