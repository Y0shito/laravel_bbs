<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'twitter_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getUserInfo($id)
    {
        return self::where('id', $id)->withCount(['userFollowers' => function (Builder $query) {
            $query->where('user_id', Auth::id());
        }])->first();
    }

    public function userFollows()
    {
        return $this->belongsToMany(self::class, 'follow_user', 'user_id', 'following_id');
    }

    public function userFollowers()
    {
        return $this->belongsToMany(self::class, 'follow_user', 'following_id', 'user_id');
    }
}
