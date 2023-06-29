<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prestation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price','description', 'image' ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_presta');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
