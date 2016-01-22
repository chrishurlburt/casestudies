<?php

namespace App\Services\Contracts;

interface FilterInterface
{
    public function filterByOutcome();
    public function filterByCourse();
}