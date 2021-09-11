<?php

namespace MGGFLOW\PhpAuth\RemoveUnverified;

class UseCase
{
    public $verifyInterval = 24 * 60 * 60;
    protected DataGateInterface $dataGate;
    protected int $untilTime;

    public function __construct(DataGateInterface $dataGate)
    {
        $this->dataGate = $dataGate;
    }

    public function removeUnverifiedUsers()
    {
        $this->genUntilTime();
        $this->dataGate->deleteUnverifiedUsersOlderThan($this->untilTime);
    }

    protected function genUntilTime()
    {
        $this->untilTime = time() - $this->verifyInterval;
    }
}