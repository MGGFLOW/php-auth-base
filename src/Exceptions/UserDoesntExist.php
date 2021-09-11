<?php

namespace MGGFLOW\PhpAuth\Exceptions;

class UserDoesntExist extends Exception
{
    protected $message = 'User doesn`t exist';
}