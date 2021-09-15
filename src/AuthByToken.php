<?php

namespace MGGFLOW\PhpAuth;

use MGGFLOW\PhpAuth\Interfaces\AuthByTokenData;
use MGGFLOW\PhpAuth\Interfaces\Authenticator;

class AuthByToken extends Authentication implements Authenticator
{
    /**
     * Access Token.
     *
     * @var string
     */
    protected string $accessToken;

    /**
     * Gate to handle data.
     *
     * @var AuthByTokenData
     */
    protected AuthByTokenData $data;

    /**
     * Forward dependencies.
     *
     * @param AuthByTokenData $dataGate
     */
    public function __construct(AuthByTokenData $dataGate)
    {
        $this->data = $dataGate;
    }

    /**
     * Access Token setter.
     *
     * @param string $token
     */
    public function setToken(string $token)
    {
        $this->accessToken = $token;
    }

    /**
     * Authenticate by Access Token.
     *
     * @return AuthByToken
     */
    public function auth(): self
    {
        $this->currentUser = $this->getTokenUser();

        return $this;
    }

    /**
     * Get User data.
     *
     * @return object|null
     */
    protected function getTokenUser(): ?object
    {
        return $this->data->getUserByToken($this->accessToken);
    }
}