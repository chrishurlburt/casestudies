<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Http\Requests\StoreStudyRequest;
use App\Http\Requests\UpdateStudyRequest;

use App\Http\Controllers\Controller;
use \Auth;
use \Sentinel;

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

        // check if user has permission to access this page.
        $user = Sentinel::findById(Auth::user()->id);

        if($user->hasAccess(['admin.cases.index'])) {

            $studies = Study::where('draft', false)->latest()->get();

            return view('layouts.admin.cases.manage')->with('studies', $studies);

        } else {

            return redirect(route('admin'))->withErrors('You do not have permission to access that location.');

        }
    }


    /**
    * Store a new case study.
    *
    * @param StoreDraftRequest $StoreDraftRequest
    * @return Response
    */
    public function store(StoreStudyRequest $StoreStudyRequest)
    {

        // @TODO: every study must always have a slug. if no custom url is present
        // in the form, slugify the title.

        if($StoreStudyRequest->has('publish')) {

            $user = Sentinel::findById(Auth::user()->id);

            // check if user has permissions to publish.
            if($user->hasAccess(['publish'])) {

                // user is authorized to publish
                $this->storeStudy($StoreStudyRequest->all(), false);
                return redirect(route('admin.cases.index'));

            } else {

                //user is not authorized to publish. Flash request to session and redirect with error.
                return redirect(route('admin.cases.create'))->withErrors('You do not have permission to publish.')->withInput($StoreStudyRequest->all());

            }

        } else {

            // must be a draft if not publish. request validation will have
            // already determined it must be either publish or draft.
            $this->storeStudy($StoreStudyRequest->all(), true);

            return redirect(route('admin.cases.drafts'));

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
    public function update(UpdateStudyRequest $UpdateStudyRequest, $slug)
    {

        // @TODO: every study must always have a slug. if no custom url is present
        // in the form, slugify the title.


        $user = Sentinel::findById(Auth::user()->id);

        if($UpdateStudyRequest->has('publish-draft')) {
            // check if user has permissions to publish.
            if($user->hasAccess(['publish'])) {

                // user has permission to publish
                $study = Study::where('slug', $slug)->firstOrFail();
                $input = $UpdateStudyRequest->all();

                $keywordIds = $this->storeKeywords($input['keywords']);

                $study->title = $input['title'];
                $study->problem = $input['problem'];
                $study->solution = $input['solution'];
                $study->analysis = $input['analysis'];
                $study->slug = $input['slug'];
                $study->draft = false;

                $study->save();
                $study->keywords()->sync($keywordIds);

                return redirect(route('admin.cases.index'));

            } else {
                //user doesn't have permission to publish
                return redirect(route('admin.cases.edit'))->withErrors('You do not have permission to publish.')->withInput($UpdateStudyRequest->all());
            }

        } else if($UpdateStudyRequest->has('update-draft')) {

            $study = Study::where('slug', $slug)->firstOrFail();
            $input = $UpdateStudyRequest->all();

            $keywordIds = $this->storeKeywords($input['keywords']);

            $study->title = $input['title'];
            $study->problem = $input['problem'];
            $study->solution = $input['solution'];
            $study->analysis = $input['analysis'];
            $study->slug = $input['slug'];

            $study->save();
            $study->keywords()->sync($keywordIds);

            return redirect(route('admin.cases.drafts'));

        } else {
            //UpdateStudyRequest->has('update')

            if($user->hasAccess(['publish'])) {

                $study = Study::where('slug', $slug)->firstOrFail();
                $input = $UpdateStudyRequest->all();

                $keywordIds = $this->storeKeywords($input['keywords']);

                $study->title = $input['title'];
                $study->problem = $input['problem'];
                $study->solution = $input['solution'];
                $study->analysis = $input['analysis'];
                $study->slug = $input['slug'];

                $study->save();
                $study->keywords()->sync($keywordIds);

                return redirect(route('admin.cases.index'));


            } else {
                //user doesn't have permission to update a pubished case study.
                 return redirect(route('admin.cases.edit', $slug))->withErrors('You do not have permission to update a published study.')->withInput($UpdateStudyRequest->all());

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

        $keywords = $this->stringifyKeywords($study->keywords()->get());

        return view('layouts.admin.cases.edit')->with('study', $study)->with('keywords', $keywords);
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
    * Check if the keyword already exists in the DB and build up
    * an array of ID's to be attached to a study.
    *
    * @param array $keywords
    * @return null
    */
    private function storeKeywords($keywords)
    {

        $keywords = array_map('trim', explode(',',$keywords));

        $keywordIds = [];
        foreach($keywords as $keyword) {

            if(Keyword::where('name', $keyword)->first()) {

                array_push($keywordIds, Keyword::where('name', $keyword)->first()->id);

            } else {

                $k = new Keyword;
                $k->name = $keyword;
                $k->save();
                $lastInsertId = $k->id;

                array_push($keywordIds, $lastInsertId);
            }
        }

        return array_map('intval', $keywordIds);
    }



    /**
    * Stringifies a collection of keywords.
    *
    * @return string
    */
    private function stringifyKeywords($keywords)
    {
        $keywordString = "";
        foreach($keywords as $keyword) {
            $keywordString = $keywordString . $keyword->name . ', ';
        }

        return $keywordString;
    }


    /**
     * Store a case study in the DB.
     *
     * @param  array $input
     * @param  bool $isDraft
     * @return null
     */
    private function storeStudy($input, $isDraft)
    {

        $keywordIds = $this->storeKeywords($input['keywords']);

        $study = new Study;

        $study->title = $input['title'];
        $study->problem = $input['problem'];
        $study->solution = $input['solution'];
        $study->analysis = $input['analysis'];
        $study->slug = $input['slug'];
        $study->draft = $isDraft;

        Auth::user()->studies()->save($study);

        $study->keywords()->attach($keywordIds);

    }

}
