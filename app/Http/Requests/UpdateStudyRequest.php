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
        // Remove whitespace to prevent nearly duplicate titles/slugs. There is probably
        // a better place to do this, maybe on the Request class.
        $input = $this->all();
        $input['title'] = trim($input['title']);
        $input['slug']  = trim($input['slug']);
        $this->replace($input);

        // If the slug is updated, request will be unable to find the study
        // by the new slug because it doesn't exist in the DB yet. To correct this,
        // a hidden input is placed on the form containing the old slug so the
        // study can still be found in the DB by the old slug.

        $study = Study::where('slug', $this->_old_slug)->firstOrFail();

        if($this->has('publish-draft') || $this->has('update')) {

            return [
                // On update, the title must be unique to avoid changing a title to one
                // that is already in use. However, the validation must exclude
                // the current title from the uniqueness test so that it can
                // be updated with the same title.
                'title'              => 'required|unique:studies,title,'.$study->id.'|min:10|string',
                'problem'            => 'required',
                'solution'           => 'required',
                'keywords'           => 'required',
                'outcomes'           => 'required',
                'slug'               => 'unique:studies,slug,'.$study->id.'|min:5|string',
                'schedule_impact'    => 'in:yes,no',
                'budget_impact'      => 'in:yes,no',
                'delivery_method'    => 'min:10,max:50',
                'estimated_schedule' => 'integer|min:1,max:3',
                'contract_value'     => 'regex:/[0-9]+(,[0-9]+)*/|min:4,max:12',
                'market_sector'      => 'string|min:5,max:45',
                'topic'              => 'string|min:5,max:50',
                'location'           => 'string|min:4,max:20'
            ];

        } else if($this->has('update-draft') || $this->has('redraft')) {

            return [

                // See above. Need to be able to update a draft using the same title
                // it was already added to the DB with while avoiding changing the
                // title to one already in use.
                'title'    => 'required|unique:studies,title,'.$study->id.'min:10|string',
                'slug'     => 'unique:studies,slug,'.$study->id.'|min:5|string'
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
            'title.unique'           => 'The title has already been taken. Please Choose a different one.',
            'slug.unique'            => 'The custom URL is already in use by another case study. Please choose a different one.'
        ];

    }
}