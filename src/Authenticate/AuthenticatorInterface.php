<?php

namespace MGGFLOW\PhpAuth\Authenticate;

interface AuthenticatorInterface
{
    /**
     * Authenticate by looking up User data.
     *
     * @return object|null
     */
    public function auth(): ?object;
}