<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutFeatures extends Model
{
    use HasFactory;
    protected $table = 'about_features';

    protected $guarded = [];

    public function about()
    {
        return $this->belongsTo(AboutUs::class, 'about_id');
    }
}
