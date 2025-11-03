<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clients extends Model
{
    use HasFactory;
    protected $table = 'clients';

    protected $guarded = [];

    public function projects()
    {
        return $this->hasMany(Project::class, 'clients_id');
    }

}
