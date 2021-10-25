<?php declare(strict_types=1);

namespace App\Models;

use App\Enums\PublicStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'title', 'body', 'public_status'];
    protected $dates = ['created_at', 'updated_at'];

    protected static function booted()
    {
        static::addGlobalScope('public_status', function (Builder $builder) {
            $builder->where('public_status',  PublicStatus::OPEN);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function scopeOpenArticles($query)
    // {
    //     $query->where('public_status', PublicStatus::OPEN);
    // }
}
