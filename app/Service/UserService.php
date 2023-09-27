<?php

namespace app\Service;

class UserService
{
    protected $response, $parameter;

    public function __construct($response, $parameter)
    {
        $this->response = $response;
        $this->parameter = $parameter;
    }

    public function getResponse()
    {
        $response = json_decode($this->response);
        $parameterValue = $response->{$this->parameter};
        return $parameterValue;
    }
}
