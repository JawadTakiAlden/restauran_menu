<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Template extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function setImageAttribute ($image){
        if (!$image){
            return $this->attributes['image'] = fake()->imageUrl;
        }
        $newImageName = uniqid() . '_' . 'template'. now()->timestamp . '.' . $image->extension();
        $image->move(public_path('template_images') , $newImageName);
        return $this->attributes['image'] =  '/'.'template_images'.'/' . $newImageName;
    }

    public function templateColors() : HasMany{
        return $this->hasMany(TemplateColor::class);
    }

    public function templateTranslations() : HasMany{
        return $this->hasMany(TemplateTranslation::class);
    }
}
