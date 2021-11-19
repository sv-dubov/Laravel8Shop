<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function order_detail()
    {
        return $this->hasOne(OrderDetail::class);
    }

    public function remove()
    {
        $this->delete();
    }

    public function getCategoryTitle()
    {
        return ($this->category != null) ? $this->category->category_name : 'No category';
    }

    public function getBrandTitle()
    {
        return ($this->brand != null) ? $this->brand->brand_name : 'No brand';
    }

    public function makeActive()
    {
        $this->status = 1;
        $this->save();
    }

    public function makeInactive()
    {
        $this->status = 0;
        $this->save();
    }

    public function toggleStatus()
    {
        return ($this->status == 0) ? $this->makeActive() : $this->makeInactive();
    }

}
