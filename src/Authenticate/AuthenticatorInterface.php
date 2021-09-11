<?php

namespace MGGFLOW\PhpAuth\Authenticate;

interface AuthenticatorInterface
{
    public function auth() : ?object;
}