<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Http\Requests\StoreStudyRequest;
use App\Http\Requests\UpdateStudyRequest;

use App\Http\Controllers\Controller;
use \Auth;
use \Sentinel;
use \Session;

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
        if($this->checkAccess()) {

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

        $user = Sentinel::findById(Auth::user()->id);
        $study = Study::where('slug', $slug)->firstOrFail();
        $input = $UpdateStudyRequest->all();

        if($UpdateStudyRequest->has('publish-draft')) {
            // check if user has permissions to publish.
            if($user->hasAccess(['publish'])) {
                // user has permission to publish

                $this->updateStudy($study, $input, false);

                return redirect(route('admin.cases.index'));

            } else {
                //user doesn't have permission to publish
                return redirect(route('admin.cases.edit'))->withErrors('You do not have permission to publish.')->withInput($UpdateStudyRequest->all());
            }

        } else if($UpdateStudyRequest->has('update-draft')) {

            $this->updateStudy($study, $input, true);

            return redirect(route('admin.cases.drafts'));

        } else {
            // UpdateStudyRequest->has('update')
            // updating a published study

            if($user->hasAccess(['publish'])) {

                $this->updateStudy($study, $input, false);

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
    * @param  object $keywords
    * @return string
    */
    private function stringifyKeywords($keywords)
    {
        $keywordString = "";

        if($keywords) {

            foreach($keywords as $keyword) {
                $keywordString = $keywordString . $keyword->name . ', ';
            }

            return trim($keywordString, ' ,');

        } else {

        return $keywordString;

        }

    }


    /**
    * Slugifies a string.
    *
    * @param  string $text
    * @return string
    */
    private function slugify($text)
    {
    // replace non letter or digits by -
    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
    // trim
    $text = trim($text, '-');
    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // lowercase
    $text = strtolower($text);
    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text)){
            return false;
        }
      return $text;
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
        $study->draft = $isDraft;

        if(empty($input['slug'])) {
            $study->slug = $this->slugify($study->title);
        } else {
            $study->slug = $input['slug'];
        }

        Auth::user()->studies()->save($study);

        $study->keywords()->attach($keywordIds);

        if($study->draft) {
            Session::flash('flash_message', 'The draft has been added.');
        } else {
            Session::flash('flash_message', 'The case study has been published.');
        }

    }


    /**
     * Update a case study in the DB.
     *
     * @param  object $study
     * @param  array $input
     * @param  bool $isDraft
     * @return null
     */
    private function updateStudy($study, $input, $isDraft)
    {

        $keywordIds = $this->storeKeywords($input['keywords']);

        $study->title = $input['title'];
        $study->problem = $input['problem'];
        $study->solution = $input['solution'];
        $study->analysis = $input['analysis'];
        $study->draft = $isDraft;

        // Every study must have a slug in the DB. If no custom URL is present,
        // slugify the title.
        if(empty($input['slug'])) {
            $study->slug = $this->slugify($study->title);
        } else {
            $study->slug = $input['slug'];
        }

        Auth::user()->studies()->save($study);

        $study->keywords()->sync($keywordIds);

        if(Request::has('update')) {
            Session::flash('flash_message', 'The case study has been updated.');
        } else if(Request::has('publish-draft')) {
            Session::flash('flash_message', 'The draft has been published.');
        } else {
            Session::flash('flash_message', 'The draft has been updated.');
        }

    }


    /**
     * Check if a user has access to a route.
     *
     * @return bool
     */
    private function checkAccess()
    {

        $user = Sentinel::findById(Auth::user()->id);

        if($user->hasAccess([Request::route()->getName()])) {
            return true;
        } else {
            return false;
        }

    }

}
