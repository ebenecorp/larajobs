<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'tags', 'company', 'email', 'location', 'website', 'description', 'path'
    ];


    public function scopeFilter($query, array $filter)
    {
        if ($filter['tag'] ?? false) {
            $query->where('tags', 'like', '%' . $filter['tag'] . '%');
        }
        if ($filter['search'] ?? false) {
            $query->where('title', 'like', '%' . $filter['search'] . '%')
            ->orWhere('description', 'like', '%' . $filter['search'] . '%')
            ->orWhere('location', 'like', '%' . $filter['search'] . '%')
            ->orWhere('tags', 'like', '%' . $filter['search'] . '%');
        }
    }
}
