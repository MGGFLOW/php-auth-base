<?php

namespace MGGFLOW\AuthBase\Exceptions;

class CodeSendingFailed extends Exception
{
    protected $message = 'Failed to send code';
}