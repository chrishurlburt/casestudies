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

        if(Request::has('draft')) {

            return [
                'title' => 'required|unique:studies,title|min:6'
            ];

        } else if(Request::has('publish')) {

            return [
                'title' => 'required|unique:studies,title|min:10',
                'problem' => 'required',
                'solution' => 'required',
                'analysis' => 'required'
            ];

        }

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
            'title.unique' => 'The title has already been taken. Please Choose a different one.'
        ];

    }
}
