<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutUs extends Model
{
    use HasFactory;
    protected $table = 'about_us';

    protected $guarded = [];

    public function features()
    {
        return $this->hasMany(AboutFeatures::class, 'about_id')->orderBy('urutan', 'asc');
    }
}
