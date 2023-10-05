<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dimension extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'width',
        'height'
    ];

    public function templates(){
        return $this->hasMany(Template::class);
    }
}
