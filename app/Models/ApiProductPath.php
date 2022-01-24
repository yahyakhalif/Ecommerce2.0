<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApiProductPath extends Model
{
    protected $table = 'tbl_apiproductpaths';
    protected $primaryKey = 'apiproductpath_id';
    protected $fillable = [
        'added_by',
        'path'
    ];

    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
