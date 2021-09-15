<?php

namespace MGGFLOW\PhpAuth\Interfaces;

interface RememberUserCookies
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