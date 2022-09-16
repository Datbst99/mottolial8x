<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductClassify
 *
 * @property int $id
 * @property int $product_id
 * @property string|null $name
 * @property int|null $price
 * @property int|null $sale_price
 * @property int|null $amount
 * @property int|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductClassify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductClassify newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductClassify query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductClassify whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductClassify whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductClassify whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductClassify whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductClassify wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductClassify whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductClassify whereSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductClassify whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductClassify whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductClassify extends Model
{
    use HasFactory;

    protected $table = 'product_classifies';

    protected $guarded = ['id'];
}
