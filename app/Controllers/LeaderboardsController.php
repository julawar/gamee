<?php

namespace App\Controllers;

use App\Classes\Data\LeaderboardsData;

class LeaderboardsController extends Controller
{
    /**
     * LeaderboardsController constructor.
     * @param LeaderboardsData $dataClass
     */
    public function __construct(LeaderboardsData $dataClass)
    {
        $this->setDataClass($dataClass);
    }

}
