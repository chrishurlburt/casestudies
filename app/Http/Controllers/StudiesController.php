<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Study;
use App\Keyword;

class StudiesController extends Controller
{

    /**
    * Show all of the case studies in the admin panel.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {

        $studies = Study::where('draft', false)->latest()->get();

        return view('layouts.admin.studies.manage')->with('studies', $studies);
    }


    /**
    * Create a new case study.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('layouts.admin.studies.create');
    }


    /**
    * Store a new case study.
    *
    * @return \Illuminate\Http\Response
    */
    public function store()
    {

        if(Request::has('draft')) {

            $this->storeStudy(Request::all(), true);

            return redirect(route('admin.studies.drafts'));

        } else if(Request::has('publish')) {


            // @TODO: Check the user's permissions before allowing them to publish...
            // even if user does not have publish button available on view, they
            // could change the name attribute to 'publish' and hit this condtional.
            $this->storeStudy(Request::all(), false);

            return redirect(route('admin.studies'));

        } else {

            // @TODO: Someone messed with the name attribute and it doesn't have
            // draft or publish. redirect with error.

        }

    }


    /**
    * Show all the drafts.
    *
    * @return  \Illuminate\Http\Response
    */
    public function drafts()
    {

        $drafts = Study::where('draft', true)->latest()->get();

        return view('layouts.admin.studies.drafts')->with('drafts', $drafts);

    }


    /**
    * Update an existing case study.
    *
    * @return \Illuminate\Http\Response
    */
    public function update()
    {
        dd('update a case study -- studies controller');
    }


    /**
    * Get the keyword string from $input and format to an array.
    *
    * @param array $input
    * @return array
    */
    private function getKeywords($input)
    {
        return array_map('trim', explode(',',$input['keywords']));
    }


    /**
    * Get the keyword string from $input and format to an array.
    *
    * @param array $keywords
    * @return null
    */
    private function storeKeywords($keywords)
    {
        foreach($keywords as $k) {
            $keyword = new Keyword;
            $keyword->name = $k;
            $keyword->save();
        }
    }


    /**
     * Store a case study in the DB.
     * @param  array $input
     * @param  bool $isDraf
     * @return null
     */
    private function storeStudy($input, $isDraft)
    {
        $keywords = $this->getKeywords($input);
        $this->storeKeywords($keywords);

        // @TODO: attach keywords with case study
        // get the ids of the keywords by name that were just added, then pass the array
        // of ids to $study->keywords()->attach($keywordIds)

        $study = new Study;

        $study->name = $input['title'];
        $study->problem = $input['problem'];
        $study->solution = $input['solution'];
        $study->analysis = $input['analysis'];
        $study->slug = $input['slug'];
        $study->draft = $isDraft;

        $study->save();

    }

}
