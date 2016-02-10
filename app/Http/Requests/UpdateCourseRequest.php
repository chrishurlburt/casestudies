<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateCourseRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {


        return [
            'subject_name'    => 'required|min:2|max:6',
            'course_number'   => 'required|max:5',
            'course_name'     => 'required|min:5|max:75'
            'outcomes'        => 'required'
        ];
    }
}
