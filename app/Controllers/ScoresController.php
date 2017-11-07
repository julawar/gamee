<?php

namespace App\Controllers;

use App\Classes\Data\ScoresData;

class ScoresController extends Controller
{

    /**
     * ScoresController constructor.
     * @param ScoresData $dataClass
     */
    public function __construct(ScoresData $dataClass)
    {
        $this->setDataClass($dataClass);
    }

}
