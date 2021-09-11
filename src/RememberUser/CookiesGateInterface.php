<?php

namespace MGGFLOW\PhpAuth\RememberUser;

interface CookiesGateInterface
{
    public function addCookie($key,$data,$expiredAt);
}