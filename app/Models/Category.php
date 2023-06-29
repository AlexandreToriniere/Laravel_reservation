<?php

namespace App\Models;

use App\Models\Prestation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable =['name', 'image', 'description'];

    public function prestations()
    {
        return $this->belongsToMany(Prestation::class, 'category_presta');
    }
}
