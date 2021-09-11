<?php

namespace MGGFLOW\PhpAuth\RememberUser;

use MGGFLOW\PhpAuth\Exceptions\InvalidCurrentUser;

class UseCase
{
    public string $cookieKey = 'au';
    public int $rememberTime = 7 * 24 * 60 * 60;

    protected ?object $currentUser;

    protected CookiesGateInterface $cookies;

    public function __construct(CookiesGateInterface $cookies)
    {
        $this->cookies = $cookies;
    }

    public function setCurrentUser($currentUser){
        $this->currentUser = $currentUser;
    }

    /**
     * @throws InvalidCurrentUser
     */
    public function remember()
    {
        $cookie = $this->genCookieValue();
        if(empty($cookie)) throw new InvalidCurrentUser();
        $expiredAt = $this->genExpiredTime();

        $this->cookies->addCookie($this->cookieKey, $cookie, $expiredAt);
    }

    protected function genCookieValue()
    {
        if (empty($this->currentUser->id)) return false;

        return json_encode([
            'userId' => $this->currentUser->id,
        ]);
    }

    protected function genExpiredTime()
    {
        return time() + $this->rememberTime;
    }
}