<?php
declare(strict_types = 1);
/**
 * RuleGroup.php
 * Copyright (C) 2016 thegrumpydictator@gmail.com
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace FireflyIII\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class RuleGroup
 *
 * @package FireflyIII\Models
 * @property integer                                                                 $id
 * @property \Carbon\Carbon                                                          $created_at
 * @property \Carbon\Carbon                                                          $updated_at
 * @property string                                                                  $deleted_at
 * @property integer                                                                 $user_id
 * @property integer                                                                 $order
 * @property string                                                                  $title
 * @property string                                                                  $description
 * @property boolean                                                                 $active
 * @property-read \FireflyIII\User                                                   $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\FireflyIII\Models\Rule[] $rules
 * @method static \Illuminate\Database\Query\Builder|\FireflyIII\Models\RuleGroup whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\FireflyIII\Models\RuleGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\FireflyIII\Models\RuleGroup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\FireflyIII\Models\RuleGroup whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\FireflyIII\Models\RuleGroup whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\FireflyIII\Models\RuleGroup whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\FireflyIII\Models\RuleGroup whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\FireflyIII\Models\RuleGroup whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\FireflyIII\Models\RuleGroup whereActive($value)
 * @mixin \Eloquent
 */
class RuleGroup extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'order', 'title', 'description', 'active'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('FireflyIII\User');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rules()
    {
        return $this->hasMany('FireflyIII\Models\Rule');
    }

    /**
     * @param RuleGroup $value
     *
     * @return Rule
     */
    public static function routeBinder(RuleGroup $value)
    {
        if (Auth::check()) {
            if ($value->user_id == Auth::user()->id) {
                return $value;
            }
        }
        throw new NotFoundHttpException;
    }
}
