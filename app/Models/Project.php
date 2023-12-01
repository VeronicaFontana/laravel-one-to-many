<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    public function tecnology(){
        return $this->belongsTo(Tecnology::class);
    }

    protected $fillable = [
        "name", "tecnology_id","image", "image_original_name", "slug", "description", "creation_date",
    ];
}
