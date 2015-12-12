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

        return $this->belongsToMany('App\Study', 'tagged_studies', 'outcome_id', 'study_id');

    }


}
