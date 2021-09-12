<?php

namespace MGGFLOW\PhpAuth\Authenticate\ByCookie;

interface DataGateInterface
{
    /**
     * Get User Object by id.
     *
     * @param $id
     * @return object|null
     */
    public function getUserById($id) : ?object;
}