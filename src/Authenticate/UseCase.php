<?php

namespace MGGFLOW\PhpAuth\Authenticate;

class UseCase
{
    protected AuthenticatorInterface $authenticator;

    protected ?object $currentUser;

    public function __construct(AuthenticatorInterface $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    public function auth(){
        $this->currentUser = $this->authenticator->auth();
    }

    public function getCurrentUser(): ?object
    {
        return $this->currentUser;
    }

}