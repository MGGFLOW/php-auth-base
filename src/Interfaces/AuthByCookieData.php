<?php

namespace MGGFLOW\PhpAuth\Interfaces;

interface AuthByCookieData
{
    /**
     * Get User Object by id.
     *
     * @param $id
     * @return object|null
     */
    public function getUserById($id) : ?object;
}