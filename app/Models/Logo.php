<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'file_path',
        'identifier',
        'style'
    ];

    public function templates(){
        return $this->hasMany(Template::class);
    }
}
