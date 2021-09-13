<?php

namespace MGGFLOW\PhpAuth\Authenticate\ByToken;

class UseCase
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
     * @var DataGateInterface
     */
    protected DataGateInterface $dataGate;

    /**
     * Forward dependencies.
     *
     * @param DataGateInterface $dataGate
     */
    public function __construct(DataGateInterface $dataGate)
    {
        $this->dataGate = $dataGate;
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
     * @return object|null
     */
    public function auth(): ?object
    {
        return $this->getTokenUser();
    }

    /**
     * Get User data.
     *
     * @return object|null
     */
    protected function getTokenUser(): ?object
    {
        return $this->dataGate->getUserByToken($this->accessToken);
    }
}