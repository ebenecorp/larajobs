<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
