<?php

namespace MGGFLOW\PhpAuth\Register;

use MGGFLOW\PhpAuth\Exceptions\CodeSendingFailed;
use MGGFLOW\PhpAuth\Exceptions\UserAlreadyExists;
use MGGFLOW\PhpAuth\Exceptions\UserCreationFailed;

class UseCase
{
    protected SenderInterface $sender;
    protected DataGateInterface $dataGate;

    protected string $email;
    protected string $username;
    protected string $password;

    protected string $pwdHash;
    protected string $accessToken;
    protected string $verificationCode;
    protected bool $verified = false;
    protected int $createdAt;

    public function __construct(DataGateInterface $dataGate,SenderInterface $sender)
    {
        $this->dataGate = $dataGate;
        $this->sender = $sender;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @throws CodeSendingFailed
     * @throws UserCreationFailed
     * @throws UserAlreadyExists
     */
    public function register()
    {
        if ($this->emailOrLoginNonUnique()) {
            throw new UserAlreadyExists();
        }

        $this->initCreatedAt();
        $this->genPasswordHash();
        $this->genAccessToken();
        $this->genVerificationCode();

        $userFields = $this->createNewUserFields();
        if (!$this->createNewUser($userFields)) {
            throw new UserCreationFailed();
        }

        if (!$this->sendVerificationCode()) {
            throw new CodeSendingFailed();
        }
    }


    protected function emailOrLoginNonUnique(): bool
    {
        return  $this->dataGate->existsByEmailOrUsername($this->email,$this->username);
    }

    protected function initCreatedAt()
    {
        $this->createdAt = time();
    }

    protected function genPasswordHash()
    {
        $this->pwdHash = password_hash($this->password, PASSWORD_DEFAULT);
    }

    protected function genAccessToken()
    {
        $this->accessToken = md5($this->username . $this->pwdHash) . md5(microtime());
    }

    protected function genVerificationCode()
    {
        $this->verificationCode = md5($this->username . rand(0, 1000) . microtime());
    }

    protected function createNewUserFields(): array
    {
        return [
            'username' => $this->username,
            'email' => $this->email,
            'access_token' => $this->accessToken,
            'verified' => $this->verified,
            'created_at' => $this->createdAt,
            'verification_code' => $this->verificationCode,
            'pwd_hash' => $this->pwdHash,
        ];
    }

    protected function createNewUser($userFields): bool
    {
        $id = $this->dataGate->createUser($userFields);

        return !empty($id);
    }

    protected function sendVerificationCode(): bool
    {
        return $this->sender->sendCode($this->email, $this->verificationCode);
    }
}