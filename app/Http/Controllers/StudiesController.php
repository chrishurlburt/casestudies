<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Http\Requests\StoreStudyRequest;
use App\Http\Requests\StorePublishRequest;

use App\Http\Controllers\Controller;
use \Auth;

use App\Study;
use App\Keyword;
use App\User;

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

        return view('layouts.admin.cases.manage')->with('studies', $studies);
    }


    /**
    * Store a new case study.
    *
    * @param StoreDraftRequest $StoreDraftRequest
    * @return Response
    */
    public function store(StoreStudyRequest $StoreStudyRequest)
    {

        if($StoreStudyRequest->has('draft')) {

            $this->storeStudy($StoreStudyRequest->all(), true);

            return redirect(route('admin.cases.drafts'));

        } else if($StoreStudyRequest->has('publish')) {

            $this->storeStudy($StoreStudyRequest->all(), false);

            return redirect(route('admin.cases.index'));

        } else {

            // @TODO: Someone messed with the name attribute and it doesn't have
            // draft or publish. redirect with error.

            dd('studies controller');

        }

    }


    /**
    * Create a new case study.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('layouts.admin.cases.create');
    }


    /**
     * Delete a case study.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy()
    {
        dd('delete a case study.');
    }


    /**
     * Update a case study.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($slug)
    {

        if(Request::has('publish-draft')) {

            $study = Study::where('slug', $slug)->firstOrFail();
            $input = Request::all();

            $study->name = $input['name'];
            $study->problem = $input['problem'];
            $study->solution = $input['solution'];
            $study->analysis = $input['analysis'];
            $study->slug = $input['slug'];
            $study->draft = false;

            $study->save();

            return redirect(route('admin.cases.index'));

        } else if(Request::has('update-draft') || Request::has('update')) {

            $study = Study::where('slug', $slug)->firstOrFail();
            $input = Request::all();

            $study->name = $input['name'];
            $study->problem = $input['problem'];
            $study->solution = $input['solution'];
            $study->analysis = $input['analysis'];
            $study->slug = $input['slug'];

            $study->save();


            if(Request::has('update')) {
                return redirect(route('admin.cases.index'));
            } else {
                return redirect(route('admin.cases.drafts'));
            }
        }

    }


    /**
     * Show a case study.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        dd('show a case study');
    }


    /**
     * Edit a case study
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $study = Study::where('slug', $slug)->firstOrFail();

        return view('layouts.admin.cases.edit')->with('study', $study);
    }


    /**
    * Show all the drafts.
    *
    * @return  \Illuminate\Http\Response
    */
    public function drafts()
    {

        $drafts = Study::where('draft', true)->latest()->get();

        return view('layouts.admin.cases.drafts')->with('drafts', $drafts);

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

        Auth::user()->studies()->save($study);

    }

}
