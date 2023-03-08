<?php

namespace MGGFLOW\AuthBase\Interfaces;

use MGGFLOW\AuthBase\Exceptions\AuthBaseException;

interface Authenticator
{
    /**
     * Authenticate by looking up User data.
     *
     * @return Authenticator
     * @throws AuthBaseException
     */
    public function auth(): self;
}