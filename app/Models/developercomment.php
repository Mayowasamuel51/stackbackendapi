<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class developercomment extends Model
{
    use HasFactory;
    protected $fillable = [
        'problem_descritpion',
    ];
    public function user(){
        return $this->belongsTo(Creategig::class);
    }
}
