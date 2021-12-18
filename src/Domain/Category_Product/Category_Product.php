<?php

declare(strict_types=1);

namespace App\Domain\Category_Product;

use App\Domain\Category\Category;
use App\Domain\Product\Product;
use Illuminate\Database\Eloquent\Model;

class Category_Product extends Model
{

	protected $table = 'category_product';
	protected $fillable = [
		'id',
		'product_id',
		'category_id',
	];
	public $timestamps = false;

	/**
	 * @var int
	 */
	private $id;
	/**
	 * @var int
	 */
	private  $product_id;

	/**
	 * @var int
	 */
	private  $category_id;

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}
}
