<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    /** @use HasFactory<\Database\Factories\AreaFactory> */
    use HasFactory;

    protected $fillable = ['title','description','image','location','total_points','is_active'];

    public function challenges(): HasMany
    {
        return $this->hasMany(Challenge::class);
    }

    public function activeChallenges(): HasMany
    {
        return $this->challenges()->where('is_active', true);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
