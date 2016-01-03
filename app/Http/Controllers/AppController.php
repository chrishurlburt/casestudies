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

        // @TODO: if request is tampered with and has 2 inputs
        switch($SearchRequest->input()):

            case $SearchRequest->has('keywords'):

                $studies = $this->keywordsSearch($SearchRequest);

                if($studies) {
                    return view('layouts.app.results')->with('studies', $studies);
                } else {
                    return redirect(route('app.landing'))->withErrors('No results could be found for the entered keywords.');
                }

            break;

            case $SearchRequest->has('outcomes'):

                // $studies = $this->outcomesSearch($SearchRequest);
                // return view('layouts.app.results')->with('studies', $studies);

            break;

            case $SearchRequest->has('courses'):

                // $studies = $this->coursesSearch($SearchRequest);
                // return view('layouts.app.results')->with('studies', $studies);

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
                array_push($studies, Keyword::find($keywordId)->studies()->get());
            }

            $studies_collapsed = collect($studies)->collapse();
            $studies = $studies_collapsed->unique(function($item) {
                return $item['id'];
            });

            return $studies;
        }
    }


    /**
     * Search case studies by learning outcomes.
     *
     * @param  SearchRequest $SearchRequest
     * @return Collection
     */
    private function outcomesSearch(SearchRequest $SearchRequest)
    {

    }


    /**
     * Search case studies by courses.
     *
     * @param  SearchRequest $SearchRequest
     * @return Collection
     */
    private function coursesSearch(SearchRequest $SearchRequest)
    {

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

}
