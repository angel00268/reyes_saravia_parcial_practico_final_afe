<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'dui',
        'nit',
        'address',
    ];

    public function user (): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function products (): HasMany
    {
        return $this->hasMany(Product::class,'seller_id');
    }
}
