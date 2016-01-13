<?php

namespace App\Http\Controllers;

use Request;
use Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;


use App\Http\Requests\SearchRequest;

use App\Study;
use App\Keyword;
use App\Outcome;
use App\Course;

// @TODO: Eager loading queries -- get rid of queries in loops.
//
// @TODO: pagination

class AppController extends Controller
{

    /**
     * The landing page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::forget(['search','results','studies_by_outcome','studies_by_course','outcomes_checked','courses_checked']);

        $outcomes = Outcome::latest()->get()->all();
        $courses = Course::latest()->get()->all();

        return view('layouts.app.landing')->with([
            'outcomes' => $outcomes,
            'courses'  =>$courses
        ]);

    }


    /**
     * Show a single case study.
     *
     * @return \Illuminate\Http\Response
     */
    public function single($slug)
    {

        $study = Study::where('slug', $slug)->firstOrFail();

        return view('layouts.app.single')->with('study', $study);
    }


    /**
     * Search for case studies by keyword, outcome or course.
     *
     * @param  Request $SearchRequest
     * @return \Illuminate\Http\Response
     */
    public function search(SearchRequest $SearchRequest)
    {

        // @TODO: if request is tampered with and has 2 inputs
        switch($SearchRequest->input()):

            case $SearchRequest->has('keywords'):

                $search_terms = $SearchRequest->keywords;
                $studies = $this->keywordsSearch($SearchRequest);

                if($studies && !$studies->isEmpty()) {

                    $search = [
                        'terms' => $search_terms,
                        'type'  => 'keywords'
                    ];

                    Session::put([
                        'results' => $studies,
                        'search' => $search
                    ]);

                    $studies = $this->paginate($studies);

                    return view('layouts.app.results')->with([
                        'studies' => $studies,
                        'search'  => $search
                    ]);

                } else {
                    return redirect(route('app.landing'))->withErrors('No results could be found for the entered keywords.');
                }

            break;

            case $SearchRequest->has('outcomes'):

                $search_terms = "outcomes go here";

                $search = [
                    'terms' => $search_terms,
                    'type'  => 'outcomes'
                ];

                $studies = $this->outcomesSearch($SearchRequest);

                Session::put(['results' => $studies, 'search' => $search]);

                $studies = $this->paginate($studies);

                return view('layouts.app.results')->with([
                    'studies' => $studies,
                    'search'  => $search
                ]);

            break;

            case $SearchRequest->has('courses'):

                $search_terms = "courses go here";

                $search = [
                    'terms' => $search_terms,
                    'type'  => 'courses'
                ];

                $search_terms = "courses go here";
                $studies = $this->coursesSearch($SearchRequest);

                Session::put(['results' => $studies, 'search' => $search]);

                $studies = $this->paginate($studies);

                return view('layouts.app.results')->with([
                    'studies' => $studies,
                    'search'  => $search
                ]);

            break;

            default:

                return redirect(route('app.landing'));

        endswitch;

    }

    /**
     * Filter Studies.
     *
     * @return  Response
     */
    public function filter()
    {
        // @TODO: preserve the state of the checked filters.
        //
        // @TODO: When blank form is submitted, undo all filters.

        $filter = Request::all();
        $studies_unfiltered = Session::get('results');
        $search = Session::get('search');

        // dd(Request::all());

        switch(Request::input()):

            case Request::has('outcomes'):
                //filter studies by learning outcomes.
                if(Session::has('studies_by_course') && $search['type'] == 'keywords') {
                    // the results have been filtered by course
                    // filter studies_by_course by learning outcome

                    $studies_by_course = Session::get('studies_by_course');
                    $study_ids = $studies_by_course->lists('id');

                    // eager load studies_by_course from db
                    // $studies_by_course = Study::with('outcomes')->findMany($study_ids);

                    $studies = $studies_by_course->filter(function($study){

                        $outcomes = Request::input('outcomes');

                        foreach($outcomes as $outcome){
                            foreach($study->outcomes as $study_outcome) {
                                // check all of a study's outcomes against each of the
                                // outcomes given.
                                if($study_outcome->id == $outcome){
                                    return $study;
                                }
                            }
                        }
                    });

                    // @TODO: since studies_by_course will already be eager loaded and stored in the session,
                    // it will not need to be eager loaded again.
                    //
                    // manually create pagintator using the $studies collection.
                    // ex.
                    // $test = new LengthAwarePaginator($studies,$studies->count(),5);
                    //
                    // results should always be returned as a paginator instance.

                    $courses_checked = Session::get('courses_checked');
                    $outcomes_checked = Request::input('outcomes');

                    $studies = Study::with('outcomes')->whereIn('id',$studies->lists('id'))->get();

                    Session::put([
                        'search'             => $search,
                        'studies_by_outcome' => $studies,
                        'outcomes_checked'   => $outcomes_checked,
                        'courses_checked'    => $courses_checked
                    ]);

                    $studies = $this->paginate($studies);

                    return view('layouts.app.results')->with([
                        'studies'          => $studies,
                        'search'           => $search,
                        'outcomes_checked' => $outcomes_checked,
                        'courses_checked'  => $courses_checked
                    ]);

                } else {
                    // filter by outcome
                    $studies = $studies_unfiltered->filter(function ($study) {

                        $outcomes = Request::input('outcomes');
                        foreach($outcomes as $outcome) {
                            if($study->outcomes()->where('outcome_id', $outcome)->get()->all()) {
                                return $study;
                            }
                        }
                    });

                    $studies = Study::with('outcomes')->whereIn('id',$studies->lists('id'))->get();
                    $outcomes_checked = Request::input('outcomes');

                    Session::put([
                        'studies_by_outcome' => $studies,
                        'outcomes_checked'   => $outcomes_checked
                    ]);

                    $studies = $this->paginate($studies);

                    return view('layouts.app.results')->with([
                        'studies'          => $studies,
                        'search'           => $search,
                        'outcomes_checked' => $outcomes_checked
                    ]);
                }

            break;

            // @TODO: this chunk is ineffecient. refactor
            // don't allow queries to be called in loops.
            case Request::has('courses'):
                //filter studies by course
                if(Session::has('studies_by_outcome') && $search['type'] == 'keywords'){
                    // the results have been filtered by outcome
                    // filter studies_by_outcome by course

                    $studies_by_outcome = Session::get('studies_by_outcome');

                    $studies = $studies_by_outcome->filter(function($study){

                        $courses = Course::find(Request::input('courses'));

                        // get all the outcomes for each study
                        foreach($study->outcomes()->get() as $outcome) {
                            // get studies by course
                            foreach($courses as $course) {
                                if($course->outcomes()->where('outcome_id', $outcome->id)->get()->all()) {
                                    return $study;
                                }
                            }
                        }
                    });

                    $studies = Study::with('outcomes')->whereIn('id',$studies->lists('id'))->get();
                    $courses_checked = Request::input('courses');
                    $outcomes_checked = Session::get('outcomes_checked');

                    Session::put([
                        'search'             => $search,
                        'studies_by_course'  => $studies,
                        'outcomes_checked'   => $outcomes_checked,
                        'courses_checked'    => $courses_checked
                    ]);

                    $studies = $this->paginate($studies);

                    return view('layouts.app.results')->with([
                        'studies'          => $studies,
                        'search'           => $search,
                        'courses_checked'  => $courses_checked,
                        'outcomes_checked' => $outcomes_checked
                    ]);

                } else {

                    $studies = $studies_unfiltered->filter(function($study){

                        $courses = Course::find(Request::input('courses'));

                        // get all the outcomes for each study
                        foreach($study->outcomes()->get() as $outcome) {
                            // get studies by course
                            foreach($courses as $course) {
                                if($course->outcomes()->where('outcome_id', $outcome->id)->get()->all()) {
                                    return $study;
                                }
                            }
                        }

                    });

                    // @TODO: these studies are sorted by course and may be sorted by outcomes,
                    // eager load outcomes for future use.

                    $studies = Study::with('outcomes')->whereIn('id',$studies->lists('id'))->get();
                    $courses_checked = Request::input('courses');

                    Session::put([
                        'studies_by_course' => $studies,
                        'courses_checked'   => $courses_checked
                    ]);

                    $studies = $this->paginate($studies);

                    return view('layouts.app.results')->with([
                        'studies'         => $studies,
                        'search'          => $search,
                        'courses_checked' => $courses_checked
                    ]);

                }

            break;

            default:
            // reset filters
            // @TODO: filter resets are fucked

                $courses_checked = [];
                $outcomes_checked =[];

                if(Request::has('outcomes_reset')) {

                    Session::forget('studies_by_outcome');

                    if(Session::has('studies_by_course') && $search['type'] == 'keywords') {
                        // reset the outcomes filter but leave courses filter intact
                        $studies = Session::get('studies_by_course');

                        $courses_checked = Session::get('courses_checked');

                    } else {
                        // there was no courses filter present in the session
                        $studies = Session::get('results');
                    }

                } elseif(Request::has('courses_reset')) {

                    Session::forget('studies_by_course');

                    if(Session::has('studies_by_outcome') && $search['type'] == 'keyword') {
                        // reset the courses filter but leave outcomes filter intact
                        $studies = Session::get('studies_by_outcome');
                        $outcomes_checked = Session::get('outcomes_checked');
                    } else {
                        // there was no outcomes filter present in the sesssion
                        $studies = Session::get('results');
                    }

                } else {
                    // request doesn't have a reset, courses, or outcomes.
                }

                $studies = $this->paginate($studies);

                return view('layouts.app.results')->with([
                    'studies'          => $studies,
                    'search'           => $search,
                    'courses_checked'  => $courses_checked,
                    'outcomes_checked' => $outcomes_checked
                ]);

            break;


        endswitch;

    }


    /**
     * Search case studies by keywords.
     *
     * @param  SearchRequest $SearchRequest
     * @return Collection
     */
    private function keywordsSearch(SearchRequest $SearchRequest)
    {
        $keywordIds = $this->keywordsLookup($SearchRequest->input('keywords'));

        if(empty($keywordIds)) {
            return false;
        } else {
            $studies = [];
            foreach($keywordIds as $keywordId) {
                array_push($studies, Keyword::findOrFail($keywordId)->studies()->where('draft', false)->get());
            }

            return $this->processCollection($studies);

        }
    }


    /**
     * Search case studies by learning outcomes.
     *
     * @param  SearchRequest $SearchRequest
     * @return Collection
     */
    private function outcomesSearch(SearchRequest $SearchRequest, $outcomes = null)
    {

        if(!$outcomes && $SearchRequest->has('outcomes')) {

            $outcomeIds = $SearchRequest->outcomes;

            $studies = [];
            foreach($outcomeIds as $outcomeId) {
                array_push($studies, Outcome::find($outcomeId)->studies()->where('draft', false)->get());
            }

            return $this->processCollection($studies);

        } elseif($outcomes && $SearchRequest->has('courses')) {
            // this conditional is hit when this method is called from coursesSearch
            // and is given a collection of outcomes to search studies for.

            $studies = [];
            foreach($outcomes as $outcome) {
                array_push($studies, Outcome::find($outcome->id)->studies()->where('draft', false)->get());
            }

            return $this->processCollection($studies);

        } else {

            //something went wrong
            dd('something went wrong');

        }

    }


    /**
     * Search case studies by courses.
     *
     * @param  SearchRequest $SearchRequest
     * @return Collection
     */
    private function coursesSearch(SearchRequest $SearchRequest)
    {
        $courseIds = $SearchRequest->courses;

        $outcomes = [];
        foreach($courseIds as $courseId) {
            array_push($outcomes, Course::findOrFail($courseId)->outcomes()->get());
        }

        $outcomes = $this->processCollection($outcomes);

        return $this->outcomesSearch($SearchRequest, $outcomes);

    }


    /**
     * Lookup given keywords and get IDs if present.
     *
     * @param  string $keywords
     * @return Array $keywordIds
     */
    private function keywordsLookup($keywords)
    {
        // explode string at commas and spaces and build array of keywords
        $keywords = array_map('trim', preg_split('~[\s,]+~', $keywords));

        $keywordIds = [];
        foreach($keywords as $keyword) {

            if(Keyword::where('name', $keyword)->first()) {
                array_push($keywordIds, Keyword::where('name', $keyword)->first()->id);
            }
        }
        return $keywordIds;
    }

    /**
     * Paginate a collection of studies.
     *
     * @param Collection $studies
     * @param int $items
     * @return LengthAwarePaginator
     */
    private function paginate($studies, $items = 5)
    {
        return new LengthAwarePaginator($studies,$studies->count(),$items);
    }


    /**
     * Collect, collapse, and eliminate duplicate models.
     *
     * @param  array $collection
     * @return Collection
     */
    private function processCollection(array $array)
    {
        $array_collapsed = collect($array)->collapse();
        $collection = $array_collapsed->unique(function($item) {
            return $item['id'];
        });

        return $collection;
    }

}
