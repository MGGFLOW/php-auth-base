<?php

namespace MGGFLOW\AuthBase;

use MGGFLOW\AuthBase\Interfaces\AuthByCookieData;
use MGGFLOW\AuthBase\Interfaces\Authenticator;

class AuthByCookie extends Authentication implements Authenticator
{
    /**
     * Authentication cookie data object.
     *
     * @var object
     */
    protected object $cookie;

    /**
     * Gate to handle data.
     *
     * @var AuthByCookieData
     */
    protected AuthByCookieData $dataGate;

    /**
     * Forward dependencies.
     *
     * @param AuthByCookieData $dataGate
     */
    public function __construct(AuthByCookieData $dataGate)
    {
        $this->cookie = (object)[];
        $this->dataGate = $dataGate;
    }

    /**
     * Cookie data setter.
     *
     * @param $cookie
     */
    public function setCookie($cookie)
    {
        if (is_string($cookie)) {
            $cookie = json_decode($cookie);
        }
        $this->cookie = $cookie;
    }

    /**
     * Authenticate User by cookie.
     *
     * @return AuthByCookie
     */
    public function auth(): self
    {
        $this->currentUser = $this->getCookieUser();

        return $this;
    }

    /**
     * Get User data object by id from Cookie.
     *
     * @return object|null
     */
    protected function getCookieUser(): ?object
    {
        if (empty($this->cookie->userId)) return null;

        return $this->dataGate->getUserById($this->cookie->userId);
    }
}