<?php

namespace App\Models;

use App\Models\Template;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Element extends Model
{
    use HasFactory;

    protected $fillable = [
        'identifier',
        'class',
        'style',
        'content',
        'template_id',
        'hidden'
    ];

    public function template(){
        return $this->belongsTo(Template::class);
    }

}
