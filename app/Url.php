<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Url
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $title
 * @property string|null $original_url
 * @property string|null $shortened_url
 * @property int|null $visits
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $redirect_path
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Url newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Url newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Url query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Url whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Url whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Url whereOriginalUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Url whereShortenedUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Url whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Url whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Url whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Url whereVisits($value)
 * @mixin \Eloquent
 */
class Url extends Model
{
    protected $fillable = [
        'original_url',
        'title'
    ];

    protected $appends = [
        'redirect_path'
    ];

    protected static function booted(): void
    {
        static::creating(fn ($url) => $url->shortened_url = Str::random(6));
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function getRouteKeyName(): string
    {
        return 'shortened_url';
    }

    public function getRedirectPathAttribute()
    {
        return url("u/{$this->shortened_url}");
    }
}
