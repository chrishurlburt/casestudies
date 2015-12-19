<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\Helpers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;

use App\Course;
use App\Outcome;


class CoursesController extends Controller
{

    /**
     * Show all of the courses.
     *
     * @return  Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::latest()->get()->all();

        return view('layouts.admin.courses.manage')->with('courses', $courses);
    }


    /**
     * Create a new course.
     *
     * @return  Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.admin.courses.create');
    }


    /**
     * Store a course.
     *
     * @return Response
     */
    public function store(StoreCourseRequest $StoreCourseRequest)
    {
        // @TODO: user authorization

        Course::create($StoreCourseRequest->all());
        Helpers::flash('The course has been successfully added.');

        return redirect(route('admin.courses.index'));

    }


    /**
    * Update a course.
    *
    * @return  Response
    */
    public function update(UpdateCourseRequest $UpdateCourseRequest, $id)
    {
        // @TODO: user authorization

        $course = Course::findOrFail($id);

        $course->update($UpdateCourseRequest->all());
        Helpers::flash('The course has been successfully updated');

        return redirect(route('admin.courses.index'));
    }


    /**
     * Edit a course.
     *
     * @return  Illuminate\Http\Response
     */
    public function edit($id)
    {
        // @TODO: user authorization

        $course = Course::findOrFail($id);

        return view('layouts.admin.courses.edit')->with('course', $course);

    }


    /**
     * Show a course.
     *
     * @return json
     */
    public function show($id)
    {
        $course = Course::findOrFail($id);

        if(Request::ajax()) {
            return $course;
        } else {
            // url was entered manually, user is probably trying to edit.
            return redirect(route('admin.courses.edit', $id));
        }
    }


    /**
     * Delete a course.
     *
     * @return  null
     */
    public function destroy($id)
    {
        // @TODO: user authorization

        $course = Course::findOrFail($id);
        $course->delete();

        Helpers::flash('The course has been successfully deleted.');
        return redirect(route('admin.courses.index'));

    }

}
