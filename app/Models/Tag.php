<?php
/**
 * Tag.php
 * Copyright (c) 2019 james@firefly-iii.org
 *
 * This file is part of Firefly III (https://github.com/firefly-iii).
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */
declare(strict_types=1);

namespace FireflyIII\Models;

use Carbon\Carbon;
use Eloquent;
use FireflyIII\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class Tag.
 *
 * @property Collection                      $transactionJournals
 * @property string                          $tag
 * @property int                             $id
 * @property Carbon                          $date
 * @property int                             zoomLevel
 * @property float                           latitude
 * @property float                           longitude
 * @property string                          description
 * @property string                          amount_sum
 * @property string                          tagMode
 * @property Carbon                          created_at
 * @property Carbon                          updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int                             $user_id
 * @property-read User                       $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static Builder|Tag onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereTagMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereZoomLevel($value)
 * @method static Builder|Tag withTrashed()
 * @method static Builder|Tag withoutTrashed()
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|Attachment[] $attachments
 * @property-read int|null                                              $attachments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Location[]   $locations
 * @property-read int|null                                              $locations_count
 * @property-read int|null                                              $transaction_journals_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $tagMode
 * @property string|null $description
 * @property float|null $latitude
 * @property float|null $longitude
 * @property int|null $zoomLevel
 */
class Tag extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts
        = [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
            'date'       => 'date',
            'zoomLevel'  => 'int',
            'latitude'   => 'float',
            'longitude'  => 'float',
        ];
    /** @var array Fields that can be filled */
    protected $fillable = ['user_id', 'tag', 'date', 'description', 'tagMode'];

    protected $hidden = ['zoomLevel', 'latitude', 'longitude'];

    /**
     * Route binder. Converts the key in the URL to the specified object (or throw 404).
     *
     * @param string $value
     *
     * @throws NotFoundHttpException
     * @return Tag
     */
    public static function routeBinder(string $value): Tag
    {
        if (auth()->check()) {
            $tagId = (int) $value;
            /** @var User $user */
            $user = auth()->user();
            /** @var Tag $tag */
            $tag = $user->tags()->find($tagId);
            if (null !== $tag) {
                return $tag;
            }
        }
        throw new NotFoundHttpException;
    }

    /**
     * @codeCoverageIgnore
     * @return MorphMany
     */
    public function locations(): MorphMany
    {
        return $this->morphMany(Location::class, 'locatable');
    }

    /**
     * @codeCoverageIgnore
     * @return MorphMany
     */
    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    /**
     * @codeCoverageIgnore
     * @return BelongsToMany
     */
    public function transactionJournals(): BelongsToMany
    {
        return $this->belongsToMany(TransactionJournal::class);
    }

    /**
     * @codeCoverageIgnore
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
