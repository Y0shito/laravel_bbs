<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PublicStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Kyslik\ColumnSortable\Sortable;

class Article extends Model
{
    use HasFactory, SoftDeletes, Sortable;

    protected $fillable = ['user_id', 'title', 'body', 'public_status', 'category'];
    protected $dates = ['created_at', 'updated_at'];
    public $sortable = ['title', 'views', 'bookmarks', 'created_at'];

    // protected static function booted()
    // {
    //     static::addGlobalScope('public_status', function (Builder $builder) {
    //         $builder->where('public_status',  PublicStatus::OPEN);
    //     });
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookmark()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeOpenArticles($query)
    {
        $query->where('public_status', PublicStatus::OPEN);
    }

    public static function getArticles()
    {
        return self::openArticles()->with(['user', 'category'])
            ->withCount(['bookmark' => function (Builder $query) {
                $query->where('user_id', Auth::id());
            }]);
    }
}
