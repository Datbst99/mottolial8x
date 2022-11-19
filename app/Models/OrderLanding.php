<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderLanding
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $username
 * @property string|null $phone
 * @property string|null $color
 * @property string|null $size
 * @property int|null $amount
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLanding newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLanding newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLanding query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLanding whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLanding whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLanding whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLanding whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLanding whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLanding wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLanding whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLanding whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLanding whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLanding whereUsername($value)
 * @mixin \Eloquent
 * @property string|null $price
 * @property string|null $sale
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLanding wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLanding whereSale($value)
 */
class OrderLanding extends Model
{
    use HasFactory;
    protected $table = 'order_landings';

    protected $guarded = ['id'];
}
