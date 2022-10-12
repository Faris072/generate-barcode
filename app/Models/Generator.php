<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class generator extends Model
{
    use HasFactory;

    protected $table = 'generator';
    protected $guarded = ['id'];

    public function files(){
        return $this->hasMany(Files::class, 'generator_id', 'id');
    }
}
