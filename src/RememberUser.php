<?php

namespace MGGFLOW\PhpAuth;

use MGGFLOW\PhpAuth\Exceptions\InvalidCurrentUser;
use MGGFLOW\PhpAuth\Interfaces\RememberUserCookies;

class RememberUser
{
    /**
     * Key for Authentication Cookie.
     *
     * @var string
     */
    public string $cookieKey = 'au';

    /**
     * Duration of User remembering state.
     *
     * @var int|float
     */
    public int $rememberTime = 7 * 24 * 60 * 60;

    /**
     * Current User data object.
     *
     * @var object|null
     */
    protected ?object $currentUser;

    /**
     * Gate to handle data.
     *
     * @var RememberUserCookies
     */
    protected RememberUserCookies $cookies;

    /**
     * Forward dependencies.
     *
     * @param RememberUserCookies $cookies
     */
    public function __construct(RememberUserCookies $cookies)
    {
        $this->cookies = $cookies;
    }

    /**
     * Current User setter.
     *
     * @param $currentUser
     */
    public function setCurrentUser($currentUser)
    {
        $this->currentUser = $currentUser;
    }

    /**
     * Remember authenticated User.
     *
     * @throws InvalidCurrentUser
     */
    public function remember()
    {
        $cookie = $this->genCookieValue();
        if (empty($cookie)) throw new InvalidCurrentUser();
        $expiredAt = $this->genExpiredTime();

        $this->cookies->addCookie($this->cookieKey, $cookie, $expiredAt);
    }

    public function forget(){
        $this->cookies->removeCookie($this->cookieKey);
    }

    /**
     * Generate cookie value.
     *
     * @return false|string
     */
    protected function genCookieValue()
    {
        if (empty($this->currentUser->id)) return false;

        return json_encode([
            'userId' => $this->currentUser->id,
        ]);
    }

    /**
     * Generate Cookie expired date.
     *
     * @return float|int
     */
    protected function genExpiredTime()
    {
        return time() + $this->rememberTime;
    }
}