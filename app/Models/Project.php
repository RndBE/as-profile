<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';

    protected $guarded = [];

    public function imageProjects()
    {
        return $this->hasMany(ImageProject::class, 'projects_id');
    }

    public function clients()
    {
        return $this->belongsTo(Clients::class, 'clients_id');
    }

}
