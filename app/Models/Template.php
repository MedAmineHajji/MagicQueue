<?php

namespace App\Models;

use App\Models\Element;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Template extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
    ];

    public function elements(){
        return $this->hasMany(Element::class);
    }

    public function dimensions(){
        return $this->belongsTo(Dimension::class);
    }

    public function logos(){
        return $this->belongsTo(Logo::class);
    }

}
