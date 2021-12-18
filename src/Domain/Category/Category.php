<?php

declare(strict_types=1);

namespace App\Domain\Category;

use App\Domain\Product\Product;
use App\Domain\ProductCategory\ProductCategory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name_',
    ];

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name_;

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }

    public function product_categories()
    {
        return $this->hasMany(ProductCategory::class);
    }

}
