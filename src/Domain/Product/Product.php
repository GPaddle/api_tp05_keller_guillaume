<?php

declare(strict_types=1);

namespace App\Domain\Product;

use App\Domain\Category\Category;
use App\Domain\MetaData\MetaData;
use App\Domain\ProductCategory\ProductCategory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'id',
        'title',
        'description_',
        'price',
        'categories',
        'icon',
        'metaData',
    ];

    protected $with = [
        'categories',
        'metadata'
    ];

    public $timestamps = false;

    public $id;
    public $title;
    public $description_;
    public $price;
    public $icon;
    /**
     * @var Category[] An Array of Categories     
     */
    public $categories;
    /**
     * @var MetaData[] An Array of metaData     
     */
    public $metaData;

    /**
     * @return Category[] get the related categories
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function product_categories()
    {
        return $this->hasMany(ProductCategory::class);
    }

    /**
     * @return MetaData[] get the related categories
     */
    public function metadata()
    {
        return $this->hasMany(MetaData::class, 'product_id');
    }
}
