<?php

namespace MGGFLOW\AuthBase\Exceptions;

class UserDoesntExist extends Exception
{
    protected $message = 'User doesn`t exist';
}