<?php

namespace MGGFLOW\PhpAuth\RememberUser;

interface CookiesGateInterface
{
    /**
     * Set cookie or add to queue.
     *
     * @param $key
     * @param $data
     * @param $expiredAt
     * @return mixed
     */
    public function addCookie($key, $data, $expiredAt);
}