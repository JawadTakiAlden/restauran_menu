<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function setImageAttribute ($image){
        if (!$image){
            return $this->attributes['image'] = fake()->imageUrl;
        }
        $newImageName = uniqid() . '_' . 'product_'. now()->timestamp . '.' . $image->extension();
        $image->move(public_path('product_images') , $newImageName);
        return $this->attributes['image'] =  '/'.'product_images'.'/' . $newImageName;
    }

    public function productTranslations() : HasMany{
        return $this->hasMany(ProductTranslation::class);
    }
}
