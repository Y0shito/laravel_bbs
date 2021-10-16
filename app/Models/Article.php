<?php

namespace App\Models;

use App\Enums\PublicStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'title', 'body', 'public_status'];
    protected $dates = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOpenArticles($query)
    {
        $query->where('public_status', PublicStatus::OPEN);
    }
}
