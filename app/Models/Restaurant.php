<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Restaurant extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function setLogoAttribute ($logo){
        if (!$logo){
            return $this->attributes['logo'] = fake()->imageUrl;
        }
        $newImageName = uniqid() . '_' . 'logo_'. now()->timestamp . '.' . $logo->extension();
        $logo->move(public_path('restaurant_images/logos') , $newImageName);
        return $this->attributes['logo'] =  '/restaurant_images/logos/'. $newImageName;
    }

    public function setCoverAttribute ($cover){
        if (!$cover){
            return $this->attributes['cover'] = fake()->imageUrl;
        }
        $newImageName = uniqid() . '_' . 'cover_'. now()->timestamp . '.' . $cover->extension();
        $cover->move(public_path('restaurant_images/covers') , $newImageName);
        return $this->attributes['cover'] =  '/restaurant_images/covers/'. $newImageName;
    }

    protected static function boot()
    {
        parent::boot();
        static::created(function ($restaurant){
            $id = Crypt::encryptString($restaurant->id);
            $menu_link = "https://goma.menu.food?mid=$id&mn=$restaurant->name";
            $restaurant->menu_link = $menu_link;
            $fileName = $restaurant->id . '-' . now()->timestamp .'.svg';
            $filePath = public_path('qr-codes/' . $fileName);

            $restaurant->qr = '/qr-codes/' . $fileName;

            if (!File::exists(public_path('qr-codes'))) {
                File::makeDirectory(public_path('qr-codes'), 0755, true);
            }

            QrCode::format('svg')
                ->size(300)
                ->generate($menu_link, $filePath);

            $restaurant->save();
        });
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function template(){
        return $this->belongsTo(Template::class);
    }

    public function restaurantTranslations(){
        return $this->hasMany(RestaurantTranslation::class);
    }

    public function subscription(){
        return $this->hasMany(RestaurantSubscription::class);
    }

}
