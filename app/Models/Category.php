<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['category', 'subcategory', 'url'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_subcategory', 'subcategory_id', 'user_id');
    }

    /**
     * Get all available main categories
     */
    public static function getMainCategories()
    {
        return [
            'Ezoterija',
            'Fitnesas ir Sveikatingumas',
            'Grožio Paslaugos',
            'IT Pagalba',
            'Kūrybinės Paslaugos',
            'Meistrai ir remontas',
            'Namų priežiūra ir valymas',
            'Perkraustymo ir pakavimo paslaugos',
            'Remontas',
            'Renginių Pagalba',
            'Sodininkystės ir lauko paslaugos',
            'Statyba',
            'Transporto paslaugos',
            'Turizmas',
        ];
    }
}
