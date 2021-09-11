<?php

namespace MGGFLOW\PhpAuth\Authenticate\ByCookie;

use MGGFLOW\PhpAuth\Authenticate\AuthenticatorInterface;

class UseCase implements AuthenticatorInterface
{
    protected object $cookie = (object)[];
    protected DataGateInterface $dataGate;

    public function __construct(DataGateInterface $dataGate)
    {
        $this->dataGate = $dataGate;
    }

    public function setCookie($cookie){
        if(is_string($cookie)){
            $cookie = json_decode($cookie);
        }
        $this->cookie = $cookie;
    }

    public function auth(): ?object
    {
        if(empty($this->cookie->userId)) return null;

        $userId = $this->cookie->userId;

        return $this->getCookieUser($userId);
    }

    protected function getCookieUser($userId): ?object
    {
        return $this->dataGate->getUserById($userId);
    }
}