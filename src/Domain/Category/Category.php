<?php

declare(strict_types=1);

namespace App\Domain\Category;

use App\Domain\Category_Product\Category_Product;
use App\Domain\Product\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name_',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function category_product()
    {
        return $this->hasMany(Category_Product::class);
    }
}
