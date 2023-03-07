<?php

namespace MGGFLOW\AuthBase\Exceptions;

class Exception extends AuthBaseException
{
    protected $code = 0;
    protected $message = 'Something went wrong';
}