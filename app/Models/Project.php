<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function type(){
        return $this->belongsTo(Types::class);
    }

    protected $fillable = [
        "name", "tecnology_id","image", "image_original_name", "slug", "description", "creation_date",
    ];
}
