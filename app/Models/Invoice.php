<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Invoice
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $total
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUserId($value)
 * @mixin \Eloquent
 * @property string $code
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $classify
 * @property-read int|null $classify_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCode($value)
 */
class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $guarded = ['id'];

    const STATUS_PENDING = 'pending';
    const STATUS_TRANSPORT = 'transport';
    const STATUS_PAID = 'paid';

    public function classify()
    {
        return $this->hasMany(Order::class, 'invoice_id');
    }

    public function thumbnail()
    {
        return $this->classify()->first()->product->thumbnail;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getCreatedAtAttribute($date)
    {
        if($date) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('H:i:s d-m-Y');
        }

        return null;
    }

    public function statusHtml()
    {
        if($this->status == self::STATUS_PENDING) {
            return "<btn class='btn btn-secondary btn-sm'> Đang xử lý </btn>";
        } elseif ($this->status == self::STATUS_TRANSPORT) {
            return "<div class='btn btn-primary'> Đang giao hàng </div>";
        } else {
            return "<div class='btn btn-success'> Hoàn thành </div>";
        }
    }

    public function statusText()
    {
        if($this->status == self::STATUS_PENDING) {
            return " Đang xử lý ";
        } elseif ($this->status == self::STATUS_TRANSPORT) {
            return "Đang giao hàng";
        } else {
            return "Hoàn thành";
        }
    }

    public function statusColor()
    {
        if($this->status == self::STATUS_PENDING) {
            return "btn-secondary";
        } elseif ($this->status == self::STATUS_TRANSPORT) {
            return "btn-primary";
        } else {
            return "btn-success";
        }
    }

    public static function createCode()
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = null;
        do {
            $code = substr(str_shuffle($permitted_chars), 0, 8);

            $count = self::where('code', $code)->exists();
        } while($count);

        return $code;
    }
}
