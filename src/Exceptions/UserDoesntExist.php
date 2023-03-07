<?php

namespace MGGFLOW\AuthBase\Exceptions;

class UserDoesntExist extends AuthBaseException
{
    protected $message = 'User doesn`t exist';
}