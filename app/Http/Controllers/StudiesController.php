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
use App\Notification;
use App\Outcome;

// @TODO: Eager loading queries -- get rid of queries in loops.

class StudiesController extends Controller
{

    /**
    * Show all of the case studies.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        // check if user has permission to access this page.
        if($this->checkAccess()) {

            $studies = Study::where('draft', false)->latest()->paginate(20);

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
        $outcomes = Outcome::latest()->get()->all();

        return view('layouts.admin.cases.create')->with('outcomes', $outcomes);
    }


    /**
     * Delete a case study.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        // @TODO: soft deletes

        $study = Study::where('slug', $slug)->firstOrFail();

        if($study->draft) {
        // study is a draft, any user can delete

            $study->delete();

            Session::flash('flash_message', 'The draft has been deleted.');
            return redirect(route('admin.cases.drafts'));

        } else {
        // study is not a draft, check user permissions

            if(Sentinel::findById(Auth::user()->id)->hasAccess(['publish'])) {
            // user can delete
                $study->delete();

                Session::flash('flash_message', 'The case study has been deleted.');

                return redirect(route('admin.cases.index'));

            } else {
                return redirect(route('admin.cases.drafts'))->withErrors('You do not have permission to delete case studies.');
            }
        }
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

        // @TODO: refactor to switch

        if($UpdateStudyRequest->has('publish-draft')) {
            // check if user has permissions to publish.
            if($user->hasAccess(['publish'])) {
                // user has permission to publish

                // @TODO: modify to recieve entire form request
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
     * Respond to an AJAX request with a study.
     *
     * @return json
     */
    public function show($slug)
    {
        $study = Study::where('slug', $slug)->firstOrFail();
        $keywords = $study->keywords()->get();

        if(Request::ajax()) {
            return array('study' => $study, 'keywords' => $keywords);
        } else {
            // url was entered manually, user is probably trying to edit.
            return redirect(route('admin.cases.edit', $slug));
        }
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
        $outcomes = Outcome::latest()->get()->all();


        if($study->draft) {
        // any user can edit a draft, no permissions check.
            return view('layouts.admin.cases.edit')->with('study', $study)->with('keywords', $keywords)->with('outcomes', $outcomes);
        } else {
        // it's not a draft, make sure the user has permission to edit non-drafts.
            if(Sentinel::findById(Auth::user()->id)->hasAccess(['publish'])) {
            // user can edit published studies
                return view('layouts.admin.cases.edit')->with('study', $study)->with('keywords', $keywords)->with('outcomes', $outcomes);
            } else {
            // user cannot edit published studies.
                return redirect(route('admin.cases.drafts'))->withErrors('You do not have permission to edit a published study.');
            }
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
     * Sync learning outcomes with a study.
     *
     * @param Study $study
     * @param array $outcomes
     */

    private function syncOutcomes(Study $study, array $outcomes)
    {
        $study->outcomes()->sync($outcomes);
    }

    /**
     * Sync keywords with a study.
     *
     * @param  Study  $study
     * @param  array  $keywords
     */
    private function syncKeywords(Study $study, array $keywords)
    {
        $study->keywords()->sync($keywords);
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
        // @TODO: keywords can be entered delimited by comma or space.
        // on frontend search, spaces are delimiters so they must be
        // on the backend, too.

        $study = new Study;

        $study->title = $input['title'];
        $study->problem = $input['problem'];
        $study->solution = $input['solution'];
        $study->analysis = $input['analysis'];
        $study->draft = $isDraft;

        // make a slug
        if(empty($input['slug'])) {
            $study->slug = $this->slugify($study->title);
        } else {
            $study->slug = $this->slugify($input['slug']);
        }

        // save the study
        Auth::user()->studies()->save($study);

        // save keywords if not already in the DB and sync
        $this->syncKeywords($study, $this->storeKeywords($input['keywords']));

        // sync learning outcomes
        $this->syncOutcomes($study, $input['outcomes']);

        // set success messages and notifications
        $notification = new Notification;

        if($study->draft) {
            $this->flash('The draft has been added.');
            $notification->notification = "A new draft has been added.";
        } else {
            $this->flash('The case study has been published.');
            $notification->notification = "A new case study has been published.";
        }

        // send notifications
        $this->notifier($notification, $study, Sentinel::findRoleBySlug('admin')->users()->get());
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
        // setup the study
        $study->title = $input['title'];
        $study->problem = $input['problem'];
        $study->solution = $input['solution'];
        $study->analysis = $input['analysis'];
        $study->draft = $isDraft;

        // make a slug
        if(empty($input['slug'])) {
            $study->slug = $this->slugify($study->title);
        } else {
            $study->slug = $this->slugify($input['slug']);
        }

        // update the study
        $study->save();

        // save keywords if not already in the DB and sync
        $this->syncKeywords($study, $this->storeKeywords($input['keywords']));

        // @TODO: once params are adjusted, use form request object not request facade.
        if(Request::has('outcomes')) {
        // sync learning outcomes
            $this->syncOutcomes($study, $input['outcomes']);
        }

        //set success messages and notifications
        $notification = new Notification;

        if(Request::has('update')) {
            $this->flash('The case study has been updated.');
            $notification->notification = "A case study has been updated.";
        } else if(Request::has('publish-draft')) {
            $this->flash('The draft has been published.');
            $notification->notification = "A draft has been published.";
        } else {
            $this->flash('The draft has been updated.');
            $notification->notification = "A draft has been updated.";
        }

        $this->notifier($notification, $study, Sentinel::findRoleBySlug('admin')->users()->get());

    }

    /**
     * Send a notification to a group of a users.
     *
     * @param Notification $notification
     * @param User $users
     * @return null
     */
    private function notifier(Notification $notification, Study $study, $users)
    {
        $notification->study()->associate($study);
        $notification->save();

        //attaches notification to users
        foreach($users as $user) {
            // dont send a notification to the author
            if($user->id !== Auth::user()->id) {
                $notification->users()->attach($user->id);
            }
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

    /**
     * Flash a message to the session
     *
     * @param string $message
     * @return null
     */
    private function flash($message)
    {
        return Session::flash('flash_message', $message);
    }

}


