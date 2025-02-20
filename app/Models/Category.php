<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['category', 'subcategory'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_subcategory', 'subcategory_id', 'user_id');
    }

}
