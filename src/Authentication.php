<?php

namespace MGGFLOW\AuthBase;

class Authentication
{
    /**
     * Authenticated User data.
     *
     * @var object|null
     */
    protected ?object $currentUser;

    /**
     * Get current User data object.
     *
     * @return object|null
     */
    public function getCurrentUser(): ?object
    {
        return $this->currentUser;
    }

}