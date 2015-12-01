<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{

    /**
     * The table associated with this model.
     *
     * @var string
     */
    protected $table = 'studies';


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
        'slug',
    ];


    /**
     * A case study can have many keywords.
     *
     * Get the keywords associated with a given case study.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function keywords()
    {

        return $this->belongsToMany('App\Keyword', 'tagged_studies', 'study_id', 'keyword_id');

    }

    /**
     * A case study may have many courses.
     *
     * Get the courses for a given case study.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {

        return $this->belongsToMany('App\Course', 'tagged_studies', 'study_id', 'course_id');

    }

    /**
     * A case study may have many outcomes.
     *
     * Get the outcomes for a given case study.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function outcomes()
    {

        return $this->belongsToMany('App\Outcome', 'tagged_studies', 'study_id', 'outcome_id');

    }



}
