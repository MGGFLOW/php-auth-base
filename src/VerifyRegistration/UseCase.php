<?php

namespace MGGFLOW\PhpAuth\VerifyRegistration;

use MGGFLOW\PhpAuth\Exceptions\NoVerificationCode;
use MGGFLOW\PhpAuth\Exceptions\VerificationFailed;

class UseCase
{
    /**
     * Gate to handle data.
     *
     * @var DataGateInterface
     */
    protected DataGateInterface $dataGate;

    /**
     * Verification Code.
     *
     * @var string
     */
    protected string $verificationCode;

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
     * Verification Code setter.
     *
     * @param $code
     */
    public function setVerificationCode($code)
    {
        $this->verificationCode = $code;
    }

    /**
     * Verify User by Verification Code.
     *
     * @throws NoVerificationCode
     * @throws VerificationFailed
     */
    public function verify()
    {
        if (empty($this->verificationCode)) {
            throw new NoVerificationCode();
        }

        if (!$this->verifyUserByCod()) {
            throw new VerificationFailed();
        }
    }

    /**
     * Change User state to Verified.
     *
     * @return bool
     */
    protected function verifyUserByCod(): bool
    {
        return $this->dataGate->setUserVerifiedByCode($this->verificationCode);
    }

}