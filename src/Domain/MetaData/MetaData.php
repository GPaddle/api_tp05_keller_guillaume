<?php

declare(strict_types=1);

namespace App\Domain\MetaData;

use App\Domain\Product\Product;
use Illuminate\Database\Eloquent\Model;

class MetaData extends Model
{

    protected $table = 'metadata';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name_',
        'value_',
        'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
