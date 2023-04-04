<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creategig extends Model{
    use HasFactory;

    
    protected $table = 'creategigs';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'ptitle',
        'language_category',
        'problem_descritpion',
        'email',
        'portfolio_url',
        'images',
        'tags'
    ];

    // get comment for blog post
    public function posts(){
        return $this->hasMany(comment::class, 'user_id');
    }
}
