<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_name', 'brand_logo'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public static function add($fields)
    {
        $brand = new static;
        $brand->fill($fields);
        $brand->save();
        return $brand;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function remove()
    {
        $this->removeLogo();
        $this->delete();
    }

    public function uploadLogo($image)
    {
        if($image == null) { return; }
        $this->removeLogo();
        $filename = Str::random(10) . '.' . $image->extension();
        $image->storeAs('upload/brands_logos', $filename);
        $this->brand_logo = $filename;
        $this->save();
    }

    public function removeLogo()
    {
        if($this->brand_logo != null)
        {
            Storage::delete('upload/brands_logos/' . $this->brand_logo);
        }
    }

    public function getLogo()
    {
        if($this->brand_logo == null)
        {
            return '/upload/no_image.jpg';
        }
        return '/upload/brands_logos/' . $this->brand_logo;
    }
}
