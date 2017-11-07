<?php

namespace App\Controllers;

use App\Classes\Data\Data;
use JsonRpc\Server;

abstract class Controller
{

    /**
     * @var Data
     */
    protected $dataClass;

    public function receive()
    {
        $this->createServer()->receive();
    }

    /**
     * @return Server
     */
    protected function createServer()
    {
        return new Server($this->getDataClass());
    }

    /**
     * @return Data
     */
    protected function getDataClass()
    {
        return $this->dataClass;
    }

    /**
     * @param Data $dataClass
     */
    protected function setDataClass(Data $dataClass)
    {
        $this->dataClass = $dataClass;
    }

}
