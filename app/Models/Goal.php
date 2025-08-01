<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Goal extends Model
{
    /** @use HasFactory<\Database\Factories\GoalFactory> */
    use HasFactory;
    protected $fillable = ['challenge_id','title','description','image','latitude','longitude','points','has_store_item','is_active'];

    public function challenge(): BelongsTo
    {
        return $this->belongsTo(Challenge::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_goal')
            ->withTimestamps();
    }

    public function storeItem(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'has_store_item');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeWithPointsMin($query, $min)
    {
        return $query->where('points', '>=', $min);
    }

    public function scopeNearby($query, $lat, $lng, $radius = 10)
    {
        return $query->selectRaw("*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance", [$lat, $lng, $lat])
            ->having('distance', '<=', $radius)
            ->orderBy('distance');
    }
}
