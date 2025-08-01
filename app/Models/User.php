<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Interfaces\Wallet;

class User extends Authenticatable implements Wallet
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, HasWallet;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'user_store')
            ->withPivot(['note','type'])
            ->withTimestamps();
    }

    public function storesOfType(string $type)
    {
        return $this->stores()->wherePivot('type', $type);
    }

    public function goals()
    {
        return $this->belongsToMany(Goal::class, 'user_goal')
            ->withTimestamps();
    }

    public function scopeHasAnyGoals($query)
    {
        return $query->whereHas('goals');
    }

    public function scopeHasStoreItem($query)
    {
        return $query->whereHas('stores', fn($q) => $q->where('type', 'store'));
    }
}
