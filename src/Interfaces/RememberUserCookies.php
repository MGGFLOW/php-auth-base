<?php

namespace MGGFLOW\AuthBase\Interfaces;

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

    /**
     * Remove cookie
     *
     * @param $key
     * @return mixed
     */
    public function removeCookie($key);
}