<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\SearchKeywordRequest;

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

        return view('layouts.app.landing');

    }

    /**
     * Search for case studies tagged with a given keyword.
     *
     * @param  Request $SearchKeywordRequest
     * @return \Illuminate\Http\Response
     */
    public function search(SearchKeywordRequest $SearchKeywordRequest)
    {

        $keywordIds = $this->keywordLookup($SearchKeywordRequest->input('keywords'));

        if(empty($keywordIds)) {

            return view('layouts.app.landing')->withErrors('No results could be found for the entered keywords.');

        } else {

            $studies = [];
            foreach($keywordIds as $keywordId) {

                array_push($studies, Keyword::find($keywordId)->studies()->get());

            }

            $studies_collapsed = collect($studies)->collapse();

            $studies = $studies_collapsed->unique(function($item) {
                return $item['id'];
            });

            return view('layouts.app.results')->with('studies', $studies);

        }

    }


    /**
     * Lookup given keywords and get IDs if present.
     *
     * @param  string $keywords
     * @return Array $keywordIds
     */
    private function keywordLookup($keywords)
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
