<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Http\Requests\StoreStudyRequest;
use App\Http\Requests\StorePublishRequest;

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

        $study->name = $input['title'];
        $study->problem = $input['problem'];
        $study->solution = $input['solution'];
        $study->analysis = $input['analysis'];
        $study->slug = $input['slug'];
        $study->draft = $isDraft;

        Auth::user()->studies()->save($study);

        // $study->keywords()->attach($keywordIds);

    }

}
