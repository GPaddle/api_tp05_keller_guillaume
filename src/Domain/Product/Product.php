<?php

declare(strict_types=1);

namespace App\Domain\Product;

use App\Domain\Category\Category;
use App\Domain\Category_Product\Category_Product;
use App\Domain\MetaData\MetaData;
use App\Domain\ProductCategory\ProductCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as DB;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'id',
        'title',
        'description_',
        'price',
        'icon',
    ];

    protected $with = [
        'metadata',
        'categories'
    ];

    public $timestamps = false;

    /**
     * @return Category[] get the related categories
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function category_product()
    {
        return $this->hasMany(Category_Product::class);
    }

    /**
     * @return MetaData[] get the related metaData
     */
    public function metadata()
    {
        return $this->hasMany(MetaData::class, 'product_id');
    }
}
