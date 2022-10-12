<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;

    protected $table = 'files';
    protected $guarded = ['id'];

    public function generator(){
        return $this->belongsTo(Generator::class,'id');
    }
}
