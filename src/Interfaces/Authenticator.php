<?php

namespace MGGFLOW\PhpAuth\Interfaces;

interface Authenticator
{
    /**
     * Authenticate by looking up User data.
     *
     * @return Authenticator
     */
    public function auth(): self;
}