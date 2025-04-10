<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $fillable = ['product_name','price'];

    use softDeletes;

    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'orders','product_id','client_id');
    }
}
