<?php

namespace MGGFLOW\PhpAuth\Authenticate\ByCookie;

use MGGFLOW\PhpAuth\Authenticate\AuthenticatorInterface;

class UseCase implements AuthenticatorInterface
{
    /**
     * Authentication cookie data object.
     *
     * @var object
     */
    protected object $cookie = (object)[];

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
     * @return object|null
     */
    public function auth(): ?object
    {
        return $this->getCookieUser();
    }

    /**
     * Get User data object by id from Cookie.
     *
     * @param $userId
     * @return object|null
     */
    protected function getCookieUser(): ?object
    {
        if (empty($this->cookie->userId)) return null;

        $userId = $this->cookie->userId;

        return $this->dataGate->getUserById($userId);
    }
}