<?php

namespace MGGFLOW\PhpAuth\Exceptions;

class Exception extends \Exception
{
    protected $code = 0;
    protected $message = 'Something went wrong';
}