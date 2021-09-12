<?php

namespace MGGFLOW\PhpAuth\RemoveUnverified;

class UseCase
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
     * @var DataGateInterface
     */
    protected DataGateInterface $dataGate;

    /**
     * Unverified Users created older this time will remove.
     *
     * @var int
     */
    protected int $untilTime;

    /**
     * Forward dependencies.
     *
     * @param DataGateInterface $dataGate
     */
    public function __construct(DataGateInterface $dataGate)
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