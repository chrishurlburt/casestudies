<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{

    /**
     * An outcome may have many case studies.
     *
     * Get the case studies for a given outcome.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function studies()
    {

        return $this->belongsToMany('App\Study', 'outcome_study', 'outcome_id', 'study_id');

    }


    /**
     * An outcome may have many courses.
     *
     * Get the courses for a given outcome.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {

        return $this->belongsToMany('App\Course', 'course_outcome', 'outcome_id', 'course_id');

    }


}
