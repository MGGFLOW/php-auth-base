<?php

namespace MGGFLOW\AuthBase\Exceptions;

class CodeSendingFailed extends AuthBaseException
{
    protected $message = 'Failed to send code';
}