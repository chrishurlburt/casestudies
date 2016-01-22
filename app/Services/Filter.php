<?php

namespace App\Services;

use App\Services\Contracts\FilterInterface as FilterInterface;
use Request;

// use Illuminate\Database\Eloquent\Collection as Collection;

class Filter implements FilterInterface
{


    public $filteredStudies;

    protected $request;

    public function __construct(Request $request)
    {

        $this->request = $request;

    }


    public function test()
    {
        return 'hello world';
    }


    /**
     * Filter studies by outcome.
     *
     * @param Collection $studiesToFilter
     * @return Collection
     */
    public function filterByOutcome($studiesToFilter)
    {
        $this->filteredStudies = $studiesToFilter->filter(function ($study) {
            $outcomes = $request->input('outcomes');

            foreach($outcomes as $outcome) {
                foreach($study->outcomes as $study_outcome) {
                    if($study_outcome->id == $outcome) {
                        return $study;
                    }
                }
            }
        });

        return $this->filteredStudies;
    }


    /**
     * Filter studies by course.
     *
     * @param Collection $studiesToFilter
     * @param boolean $courseOutcomes
     * @return Collection
     */
    public function filterByCourse()
    {
        // submitted filter
        $courses = $course->whereIn('id', $request->input('courses'))->with('outcomes')->get();
        $course_outcomes = $this->processCollection($courses->pluck('outcomes'));

        $studies = [];
        // look at each study we're filtering.
        foreach($this->studiesToFilter as $study) {
            // look at each of that study's learning outcomes.
            foreach($study->outcomes as $study_outcome) {
                // for each of that study's learning outcomes, check
                // to see if they match any of the courses' learning
                // outcomes submitted on the filter.
                foreach($course_outcomes as $outcome) {
                    if($outcome->id == $study_outcome->id) {
                        array_push($studies, $study);
                    }
                }
            }
        }

        $this->filteredStudies = collect($studies)->unique();

        return $this->filteredStudies;
    }


    /**
     * Collect, collapse, and eliminate duplicate models.
     *
     * @param  array $collection
     * @return Collection
     */
    private function processCollection($array)
    {
        $array_collapsed = collect($array)->collapse();
        $collection = $array_collapsed->unique(function($item) {
            return $item['id'];
        });

        return $collection;
    }
}