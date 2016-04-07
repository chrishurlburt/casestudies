<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreStudyRequest extends Request
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

        if($this->has('draft')) {

            return [
                'title'    => 'required|unique:studies,title|min:6',
                'slug'     => 'unique:studies,slug',
                'keywords' => 'required'
            ];

        } else if($this->has('publish')) {

            return [
                'title'              => 'required|unique:studies,title|min:10',
                'problem'            => 'required',
                'solution'           => 'required',
                'analysis'           => 'required',
                'slug'               => 'unique:studies,slug',
                'keywords'           => 'required',
                'outcomes'           => 'required',
                'schedule_impact'    => 'in:yes,no',
                'budget_impact'      => 'in:yes,no',
                'delivery_method'    => 'min:10,max:50',
                'estimated_schedule' => 'integer|min:1,max:3',
                'contract_value'     => 'regex:/[0-9]+(,[0-9]+)*/|min:4,max:12',
                'market_sector'      => 'string|min:5,max:45',
                'topic'              => 'string|min:5,max:50',
                'location'           => 'string|min:4,max:20'
            ];

        } else

        // Name attribute was changed on the form and publish or draft do not exist.
        // Since one of two are required, return an error. Only need to check
        // for the existence of one or the other.
        return [
            'draft' => 'required'
        ];

    }

    /**
     * Custom error messages.
     *
     * @return array
     */
    public function  messages()
    {

        return [
            'draft.required' => 'Something went wrong, please try resubimiting.',
            'title.unique'   => 'The title has already been taken. Please choose a different one.',
            'slug.unique'    => 'The custom URL is already in use by another case study. Please choose a different one.'
        ];

    }
}
