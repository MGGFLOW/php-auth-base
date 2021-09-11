<?php

namespace MGGFLOW\PhpAuth\Authenticate\ByCookie;

interface DataGateInterface
{
    public function getUserById($id) : ?object;
}