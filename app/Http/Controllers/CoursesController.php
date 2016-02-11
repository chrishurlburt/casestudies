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

// @TODO: Eager loading queries

class CoursesController extends Controller
{

    public function __construct()
    {
        $this->middleware('authorize');
    }

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
        $outcomes = Outcome::latest()->get()->all();

        if(!$outcomes){
            return redirect(route('admin'))->withErrors('You need to create some learning outcomes before you can create courses.');
        } else {
            return view('layouts.admin.courses.create')->with('outcomes', $outcomes);
        }
    }


    /**
     * Store a course.
     *
     * @return Response
     */
    public function store(StoreCourseRequest $StoreCourseRequest)
    {
        $course = Course::create($StoreCourseRequest->all());

        if($StoreCourseRequest->has('outcomes')) {
            $this->syncOutcomes($course, $StoreCourseRequest->input('outcomes'));
        }

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
        $course = Course::findOrFail($id);
        $course->update($UpdateCourseRequest->all());

        $this->syncOutcomes($course, $UpdateCourseRequest->input('outcomes'));

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

        $course = Course::findOrFail($id);
        $outcomes = Outcome::latest()->get()->all();

        return view('layouts.admin.courses.edit')->with('course', $course)->with('outcomes', $outcomes);

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
        $course = Course::destroy($id);

        Helpers::flash('The course has been successfully deleted.');
        return redirect(route('admin.courses.index'));

    }

    /**
     * Sync outcomes with a course.
     *
     * @param  Course $course
     * @param  array  $outcomes
     */
    private function syncOutcomes(Course $course, array $outcomes)
    {
        $course->outcomes()->sync($outcomes);
    }

}
