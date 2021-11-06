<?php

namespace App\Models;

use CodeIgniter\Model;

class Product extends Model
{
    protected $table = 'tbl_products';

    protected $allowedFields = [
        'product_name',
        'product_description',
        'unit-price',
        'available_quantity',
        'subcategory_id',
        'created_at',
        'added_by'
    ];

    public function checkProduct(string $product, int $sub_id)
    {
        if ($this->getWhere([
            'product_name' => $product,
            'subcategory_id' => $sub_id
        ])->getNumRows() > 0)
            return false;
        else
            return true;
    }
}
