<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Study;

class UpdateStudyRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return true;

        // user's permissions checked on StudiesController after data validation.

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $study = Study::where('slug', $this->slug)->firstOrFail();

        if(Request::has('publish-draft') || Request::has('update')) {

            return [
                // On update, the title must be unique to avoid changing a title to one
                // that is already in use. However, the validation must exclude
                // the current title from the uniqueness test so that it can
                // be updated with the same title.
                'title'    => 'required|unique:studies,title,'.$study->id.'|min:10',
                'problem'  => 'required',
                'solution' => 'required',
                'analysis' => 'required',
                'keywords' => 'required'
            ];

        } else if(Request::has('update-draft')) {

            return [

                // See above. Need to be able to update a draft using the same title
                // it was already added to the DB with while avoiding changing the
                // title to one already in use.
                'title'    => 'required|unique:studies,title,'.$study->id.'min:10',
            ];

        } else {

            // Name attribute was changed on the form and publish or draft do not exist.
            // Since one of two are required, return an error. Only need to check
            // for the existence of one or the other.
            return [
                'publish-draft' => 'required'
            ];
        }

    }

    /**
     * Custom error messages.
     *
     * @return array
     */
    public function  messages()
    {

        return [
            'publish-draft.required' => 'Something went wrong, please try resubimiting.',
            'title.unique' => 'The title has already been taken. Please Choose a different one.'
        ];

    }
}