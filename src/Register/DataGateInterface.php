<?php

namespace MGGFLOW\PhpAuth\Register;

interface DataGateInterface
{
    public function createUser($fields);
    public function existsByEmailOrUsername($email,$username) : bool;
}