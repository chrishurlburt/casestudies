<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use \Route;

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

        $course = Route::current()->parameters();

        return [
            'name'    => 'required|unique:courses,name,'.intval($course['courses']).'|min:4'
        ];
    }
}
