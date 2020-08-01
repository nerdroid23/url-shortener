<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Url
 *
 * @property int $id
 * @property string|null $original_url
 * @property string|null $shortened_url
 * @property int|null $visits
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Url newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Url newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Url query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Url whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Url whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Url whereOriginalUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Url whereShortenedUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Url whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Url whereVisits($value)
 * @mixin \Eloquent
 */
class Url extends Model
{
    //
}
