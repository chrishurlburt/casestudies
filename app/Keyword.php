<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{

    /**
     * A keyword can have many case studies.
     *
     * Get the case study associated with a given keyword.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function studies()
    {

        return $this->belongsToMany('App\Study', 'tagged_studies', 'keyword_id', 'study_id');

    }

}
