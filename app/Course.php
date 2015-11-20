<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The table associated with this model.
     *
     * @var string
     */
    protected $table = 'courses';

    /**
     * A course may have many case studies.
     *
     * Get the case studies for a given course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function studies()
    {

        return $this->belongsToMany('App\Study', 'tagged_studies', 'course_id', 'study_id');

    }

}
