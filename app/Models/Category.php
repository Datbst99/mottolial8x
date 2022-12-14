<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $title
 * @property int $index
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $create_by
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreateBy($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $product
 * @property-read int|null $product_count
 * @property-read \App\Models\User|null $user
 */
class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'create_by');
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function createBy()
    {
        if($this->user) {
            return $this->user->name;
        }

        return '';
    }

    public function countProduct()
    {
        return $this->product()->count();
    }
}
