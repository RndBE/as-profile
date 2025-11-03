<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImageProject extends Model
{
    use HasFactory;
    protected $table = 'image_projects';

    protected $guarded = [];

    public function projects()
    {
        return $this->belongsTo(Project::class, 'projects_id');
    }
}
