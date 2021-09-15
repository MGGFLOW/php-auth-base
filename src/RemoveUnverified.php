<?php

namespace MGGFLOW\PhpAuth;

use MGGFLOW\PhpAuth\Interfaces\RemoveUnverifiedData;

class RemoveUnverified
{
    /**
     * Time for User Verification.
     *
     * @var int
     */
    public int $verifyInterval = 24 * 60 * 60;

    /**
     * Gate to handle data.
     *
     * @var RemoveUnverifiedData
     */
    protected RemoveUnverifiedData $dataGate;

    /**
     * Unverified Users created older this time will remove.
     *
     * @var int
     */
    protected int $untilTime;

    /**
     * Forward dependencies.
     *
     * @param RemoveUnverifiedData $dataGate
     */
    public function __construct(RemoveUnverifiedData $dataGate)
    {
        $this->dataGate = $dataGate;
    }

    /**
     * Remove Unverified User.
     */
    public function removeUnverifiedUsers()
    {
        $this->genUntilTime();
        $this->dataGate->deleteUnverifiedUsersOlderThan($this->untilTime);
    }

    /**
     * Generate Until time for Users removing.
     */
    protected function genUntilTime()
    {
        $this->untilTime = time() - $this->verifyInterval;
    }
}