<?php

namespace MGGFLOW\PhpAuth\VerifyRegistration;

use MGGFLOW\PhpAuth\Exceptions\NoVerificationCode;
use MGGFLOW\PhpAuth\Exceptions\VerificationFailed;

class UseCase
{
    protected DataGateInterface $dataGate;
    protected string $verificationCode;

    public function __construct(DataGateInterface $dataGate)
    {
        $this->dataGate = $dataGate;
    }

    public function setVerificationCode($code){
        $this->verificationCode = $code;
    }

    /**
     * @throws VerificationFailed
     * @throws NoVerificationCode
     */
    public function verify(){
        if(empty($this->verificationCode)){
            throw new NoVerificationCode();
        }

        if(!$this->verifyUserByCod()){
            throw new VerificationFailed();
        }
    }

    protected function verifyUserByCod(): bool
    {
        return $this->dataGate->setUserVerifiedByCode($this->verificationCode);
    }

}