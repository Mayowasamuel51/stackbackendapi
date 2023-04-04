<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class comment extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'comments';

    protected $fillable = [
        'problem_descritpion',
        'images',
        // 'user_id'
    ];


    public function comments(){
        return $this->belongsTo(Creategig::class,'user_id');
    }
}
