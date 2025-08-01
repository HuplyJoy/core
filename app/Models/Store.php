<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    /** @use HasFactory<\Database\Factories\StoreFactory> */
    use HasFactory;

    protected $fillable = ['title','description','image','points'];

    public function goals(): HasMany
    {
        return $this->hasMany(Goal::class, 'has_store_item');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_store')
            ->withPivot(['note','type'])
            ->withTimestamps();
    }

    public function scopeWithMinPoints($query, $min)
    {
        return $query->where('points', '>=', $min);
    }
}
