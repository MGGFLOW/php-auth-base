<?php

namespace MGGFLOW\PhpAuth\Exceptions;

class CodeSendingFailed extends Exception
{
    protected $message = 'Failed to send code';
}