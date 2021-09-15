<?php

namespace MGGFLOW\PhpAuth;

use MGGFLOW\PhpAuth\Exceptions\NoVerificationCode;
use MGGFLOW\PhpAuth\Exceptions\VerificationFailed;
use MGGFLOW\PhpAuth\Interfaces\VerifyRegData;

class VerifyRegistration
{
    /**
     * Gate to handle data.
     *
     * @var VerifyRegData
     */
    protected VerifyRegData $dataGate;

    /**
     * Verification Code.
     *
     * @var string
     */
    protected string $verificationCode;

    /**
     * Forward dependencies.
     *
     * @param VerifyRegData $dataGate
     */
    public function __construct(VerifyRegData $dataGate)
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