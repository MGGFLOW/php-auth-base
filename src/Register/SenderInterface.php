<?php

namespace MGGFLOW\PhpAuth\Register;

interface SenderInterface
{
    public function sendCode($email,$code) : bool;
}