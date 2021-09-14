<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['coupon', 'discount'];

    public static function add($fields)
    {
        $coupon = new static;
        $coupon->fill($fields);
        $coupon->save();
        return $coupon;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }
}
