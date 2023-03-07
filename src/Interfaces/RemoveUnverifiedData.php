<?php

namespace MGGFLOW\AuthBase\Interfaces;

interface RemoveUnverifiedData
{
    /**
     * Delete unverified expired User notes.
     *
     * @param $untilTime
     * @return mixed
     */
    public function deleteUnverifiedUsersOlderThan($untilTime);
}