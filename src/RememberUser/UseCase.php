<?php

namespace MGGFLOW\PhpAuth\RememberUser;

use MGGFLOW\PhpAuth\Exceptions\InvalidCurrentUser;

class UseCase
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
     * @var CookiesGateInterface
     */
    protected CookiesGateInterface $cookies;

    /**
     * Forward dependencies.
     *
     * @param CookiesGateInterface $cookies
     */
    public function __construct(CookiesGateInterface $cookies)
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