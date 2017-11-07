<?php

namespace App\Classes\Data;


use Particle\Validator\Validator;
use Predis\Client;

abstract class Data
{
    /**
     * @var Client
     */
    protected $cache;

    /**
     * @var Validator
     */
    protected $validator;

    /**
     * @var array
     */
    protected $error_messages = [];

    public $error = null;

    public function __construct(Client $cache, Validator $validator)
    {
        $this->setCache($cache);
        $this->setValidator($validator);
    }

    /**
     * @param $data
     * @return bool
     */
    protected function validate($data)
    {
        $validate = $this->getValidator()->validate($data);

        if ($validate->isValid()) {
            return true;
        }

        foreach ($validate->getMessages() as $message) {
            $this->addError($message);
        }

        return false;
    }

    /**
     * @param $message
     */
    protected function addError($message)
    {
        if (is_array($message)) {
            foreach ($message as $item) {
                $this->error_messages[] = $item;
            }
        } else {
            $this->error_messages[] = $message;
        }

    }

    protected function handleErrors()
    {
        $this->error = json_encode($this->error_messages);
    }

    /**
     * @return Client
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * @param Client $cache
     */
    public function setCache($cache)
    {
        $this->cache = $cache;
    }

    /**
     * @return Validator
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * @param Validator $validator
     */
    public function setValidator($validator)
    {
        $this->validator = $validator;
    }
}