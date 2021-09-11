<?php

namespace MGGFLOW\PhpAuth\Authenticate\ByPassword;

interface DataGateInterface
{
    public function getUserByEmail($email) : ?object;
    public function getUserByUsername($username) : ?object;
}