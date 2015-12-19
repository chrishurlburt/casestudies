<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreCourseRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // authorize user on controller
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
            'name'    => 'required|unique:courses,name|min:4',
       ];
    }
}
