<?php

namespace Mvdnbrk\Laravel\ActiveAnts\Endpoints;

class ActiveAnts
{
    protected Authentication $auth;

    public function __construct()
    {
        $this->auth = new Authentication;
    }
}
