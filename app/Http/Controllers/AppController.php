<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\SearchRequest;

use App\Study;
use App\Keyword;
use App\Outcome;
use App\Course;

class AppController extends Controller
{

    /**
     * The landing page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outcomes = Outcome::latest()->get()->all();
        $courses = Course::latest()->get()->all();

        return view('layouts.app.landing')->with('outcomes', $outcomes)->with('courses', $courses);

    }


    /**
     * Search for case studies by keyword, outcome or course.
     *
     * @param  Request $SearchRequest
     * @return \Illuminate\Http\Response
     */
    public function search(SearchRequest $SearchRequest)
    {
        // @TODO: dont return drafts in search results

        // @TODO: if request is tampered with and has 2 inputs
        switch($SearchRequest->input()):

            case $SearchRequest->has('keywords'):

                $studies = $this->keywordsSearch($SearchRequest);

                if($studies && !$studies->isEmpty()) {
                    return view('layouts.app.results')->with('studies', $studies);
                } else {
                    return redirect(route('app.landing'))->withErrors('No results could be found for the entered keywords.');
                }

            break;

            case $SearchRequest->has('outcomes'):

                $studies = $this->outcomesSearch($SearchRequest);
                return view('layouts.app.results')->with('studies', $studies);

            break;

            case $SearchRequest->has('courses'):

                $studies = $this->coursesSearch($SearchRequest);
                return view('layouts.app.results')->with('studies', $studies);

            break;

            default:

                return redirect(route('app.landing'));

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
                array_push($studies, Keyword::findOrFail($keywordId)->studies()->get());
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
                array_push($studies, Outcome::find($outcomeId)->studies()->get());
            }

            return $this->processCollection($studies);

        } elseif($outcomes && $SearchRequest->has('courses')) {
            // this conditional is hit when this method is called from coursesSearch
            // and is given a collection of outcomes to search studies for.

            $studies = [];
            foreach($outcomes as $outcome) {
                array_push($studies, Outcome::find($outcome->id)->studies()->get());
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
