<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApiUser extends Model
{
    protected $table = 'tbl_apiusers';
    protected $primaryKey = 'apiuser_id';
    protected $fillable = [
        'added_by',
        'username',
        'key',
    ];
    public const UPDATED_AT = 'updated_on';

    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * RELATIONSHIP FUNCTIONS
     */
    public static function findByUsername($username): ApiUser|bool
    {
        return self::whereUsername($username)->first() ?? false;
    }
}
