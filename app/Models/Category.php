<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function setImageAttribute ($image){
        if (!$image){
            return $this->attributes['image'] = fake()->imageUrl;
        }
        $newImageName = uniqid() . '_' . 'category_'. now()->timestamp . '.' . $image->extension();
        $image->move(public_path('category_images') , $newImageName);
        return $this->attributes['image'] =  '/'.'category_images'.'/' . $newImageName;
    }

    public function category() : BelongsTo {
        return $this->belongsTo(Category::class , 'parent_id');
    }

    public function categories() : HasMany {
        return $this->hasMany(Category::class , 'parent_id');
    }

    public function products() : HasMany{
        return $this->hasMany(Product::class);
    }

    public function categoryTranslations(){
        return $this->hasMany(CategoryTranslation::class);
    }
}
