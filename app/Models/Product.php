<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int|null $category_id
 * @property string $thumbnail
 * @property string|null $description
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $create_by
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreateBy($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductClassify[] $classify
 * @property-read int|null $classify_count
 * @property-read \App\Models\User|null $user
 */
class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $guarded = ['id'];

    public function classify()
    {
        return $this->hasMany(ProductClassify::class, 'product_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'create_by');
    }

    public function createBy()
    {
        if($this->user) {
            return $this->user->name;
        }

        return '';
    }

    public function classifyName()
    {
        $arr = $this->classify()->pluck('name')->toArray();


        return implode(', ', $arr);
    }

    public function classifyPrice()
    {
        $minPrice = $this->classify()->orderBy('price')->first();

        $maxPrice = $this->classify()->orderByDesc('price')->first();


        $showPrice = number_format($minPrice ? $minPrice->price : 0 );

        if($maxPrice) {
            $showPrice = $showPrice . ' - ' . number_format($maxPrice? $maxPrice->price : 0);
        }

        return $showPrice;
    }

    public function classifySalePrice()
    {
        $minPrice = $this->classify()->orderBy('sale_price')->first();

        $maxPrice = $this->classify()->orderByDesc('sale_price')->first();

        $showPrice = number_format($minPrice ? $minPrice->sale_price : 0);

        if($maxPrice) {
            $showPrice = $showPrice . ' - ' . number_format($maxPrice ? $maxPrice->sale_price : 0);
        }

        return $showPrice;
    }

    public function classifyAmount()
    {
        return $this->classify()->sum('amount');
    }


}
