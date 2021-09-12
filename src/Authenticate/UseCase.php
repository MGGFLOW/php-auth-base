<?php

namespace MGGFLOW\PhpAuth\Authenticate;

class UseCase
{
    /**
     * Authenticator method Tool.
     *
     * @var AuthenticatorInterface
     */
    protected AuthenticatorInterface $authenticator;

    /**
     * Authenticated User data.
     *
     * @var object|null
     */
    protected ?object $currentUser;

    /**
     * Forward dependencies.
     *
     * @param AuthenticatorInterface $authenticator
     */
    public function __construct(AuthenticatorInterface $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    /**
     * Try to find User data by some method.
     */
    public function auth()
    {
        $this->currentUser = $this->authenticator->auth();
    }

    /**
     * Get current User data object.
     *
     * @return object|null
     */
    public function getCurrentUser(): ?object
    {
        return $this->currentUser;
    }

}