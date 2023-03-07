<?php

namespace MGGFLOW\AuthBase\Exceptions;

class Exception extends \Exception
{
    protected $code = 0;
    protected $message = 'Something went wrong';
}