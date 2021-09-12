<?php

namespace MGGFLOW\PhpAuth\RemoveUnverified;

interface DataGateInterface
{
    /**
     * Delete unverified expired User notes.
     *
     * @param $untilTime
     * @return mixed
     */
    public function deleteUnverifiedUsersOlderThan($untilTime);
}