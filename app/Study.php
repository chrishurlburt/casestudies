<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Study extends Model
{
    use SoftDeletes;

    /**
     * Enable revisioning for this model.
     */
    use \Venturecraft\Revisionable\RevisionableTrait;

    protected $historyLimit = 5;


    /**
     * The table associated with this model.
     *
     * @var string
     */
    protected $table = 'studies';


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'problem',
        'solution',
        'analysis',
        'excerpt',
        'slug',
        'draft',
        'schedule_impact',
        'budget_impact',
        'delivery_method',
        'estimated_schedule',
        'contract_value',
        'market_sector',
        'topic',
        'location'
    ];


    /**
     * Attributes that can be set to null.
     *
     * @var array
     */
    protected $nullable = [
        'schedule_impact',
        'budget_impact',
        'delivery_method',
        'estimated_schedule',
        'contract_value',
        'market_sector',
        'topic',
        'location'
    ];


    /**
     * Listen for save event.
     *
     * @return bool
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function($study)
        {
            self::setNullables($study);
        });
    }


    /**
     * Set empty nullable fields to null.
     *
     * @param object $model
     */
    protected static function setNullables($model)
    {
        foreach($model->nullable as $field) {
            if(empty($model->{$field})) {
                $model->{$field} = null;
            }
        }
    }


    /**
     * A case study can have many keywords.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function keywords()
    {

        return $this->belongsToMany('App\Keyword', 'keyword_study', 'study_id', 'keyword_id');

    }


    /**
     * A case study may have many outcomes.
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function outcomes()
    {

        return $this->belongsToMany('App\Outcome', 'outcome_study', 'study_id', 'outcome_id');

    }


    /**
     * A study may have one author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User')->withTrashed();
    }


    /**
     * A study may have one notification.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function notification()
    {
        return $this->hasOne('App\Notification');
    }


    /**
     * Change to lower case.
     *
     * @return  string
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtolower($value);
    }


    /**
     * Change first letter of each word to uppercase.
     *
     * @return  string
     */
    public function getTitleAttribute($value)
    {
        return ucwords($value);
    }


    /**
     * Strip tags.
     *
     * @return  string
     */
    public function getProblemAttribute($value)
    {
        return strip_tags($value, '<p><h2><h3><h4><h5><h6><strong><em><blockquote><sup><sub><code><br>');
    }


    /**
     * Strip tags.
     *
     * @return  string
     */
    public function getSolutionAttribute($value)
    {
        return strip_tags($value, '<p><h2><h3><h4><h5><h6><strong><em><blockquote><sup><sub><code><br>');
    }


    /**
     * Strip tags.
     *
     * @return  string
     */
    public function getAnalysisAttribute($value)
    {
        return strip_tags($value, '<p><h2><h3><h4><h5><h6><strong><em><blockquote><sup><sub><code><br>');
    }


    /**
     * Change to boolean.
     *
     * @return bool
     */
    public function getDraftAttribute($value)
    {
        return (bool) $value;
    }


    /**
     * Change to uppercase.
     *
     * @return bool
     */
    public function getTopicAttribute($value)
    {
        return $this->prepareString($value);
    }


    /**
     * Change to uppercase.
     *
     * @return bool
     */
    public function getLocationAttribute($value)
    {
        return $this->prepareString($value);
    }


    /**
     * Change to uppercase.
     *
     * @return bool
     */
    public function getScheduleImpactAttribute($value)
    {
        return $this->prepareString($value);
    }


    /**
     * Change to uppercase.
     *
     * @return bool
     */
    public function getBudgetImpactAttribute($value)
    {
        return $this->prepareString($value);
    }


    /**
     * Change to uppercase.
     *
     * @return bool
     */
    public function getMarketSectorAttribute($value)
    {
        return $this->prepareString($value);
    }


    /**
     * Change to uppercase.
     *
     * @return bool
     */
    public function getDeliveryMethodAttribute($value)
    {
        return $this->prepareString($value);
    }


    /**
     * Words first letter to uppercase if string is not null.
     *
     * @return string
     */
    private function prepareString($value)
    {
        if($value) {
            return ucwords($value);
        }

        return $value;
    }

}
