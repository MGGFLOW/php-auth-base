<?php

namespace MGGFLOW\PhpAuth\RemoveUnverified;

interface DataGateInterface
{
    public function deleteUnverifiedUsersOlderThan($untilTime);
}