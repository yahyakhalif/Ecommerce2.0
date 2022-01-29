<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\OrdersDetail;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use CodeIgniter\HTTP\Response;
use CodeIgniter\RESTful\ResourceController;
use Config\Services;
use Exception;
use Illuminate\Support\Arr;
use Nabz\Models\DB;

class ProductController extends ResourceController
{
    protected $format = 'json';
    private $product;

    public function __construct()
    {
        Services::eloquent();

        $this->product = new Product();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return Response
     */
    public function index(): Response
    {
        try {
            $products = $this->product->findAll();
            $count = count($products);

            if(!$count) $products['message'] = 'No products found matching your query.';

            return $this->respond($products);
        } catch (Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    /**
     * Return the properties of a resource object
     *
     * @param null $id
     * @return Response
     */
    public function show($id = null): Response
    {
        try {
            $product = $this->product->find($id);

            return $this->respond($product);
        } catch (Exception $e) {
            return $this->failNotFound('Product not found.');
        }
    }
}
