<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Challenge extends Model
{
    /** @use HasFactory<\Database\Factories\ChallengeFactory> */
    use HasFactory;

    protected $fillable = ['area_id','title','description','latitude','longitude','image','is_active'];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function goals(): HasMany
    {
        return $this->hasMany(Goal::class);
    }

    public function activeGoals(): HasMany
    {
        return $this->goals()->where('is_active', true);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInArea($query, $areaId)
    {
        return $query->where('area_id', $areaId);
    }
}
