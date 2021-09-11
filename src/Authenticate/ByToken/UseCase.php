<?php

namespace MGGFLOW\PhpAuth\Authenticate;

use MGGFLOW\PhpAuth\Authenticate\ByToken\DataGateInterface;

class UseCase
{
    protected string $accessToken;
    protected DataGateInterface $dataGate;

    public function __construct(DataGateInterface $dataGate)
    {
        $this->dataGate = $dataGate;
    }

    public function setToken(string $token){
        $this->accessToken = $token;
    }

    public function auth(): ?object
    {
        return $this->getTokenUser();
    }

    protected function getTokenUser(): ?object
    {
        return $this->dataGate->getUserByToken($this->accessToken);
    }
}