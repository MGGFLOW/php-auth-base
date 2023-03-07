<?php

namespace MGGFLOW\AuthBase;

use MGGFLOW\AuthBase\Exceptions\CodeSendingFailed;
use MGGFLOW\AuthBase\Exceptions\UserAlreadyExists;
use MGGFLOW\AuthBase\Exceptions\UserCreationFailed;
use MGGFLOW\AuthBase\Interfaces\CodeSender;
use MGGFLOW\AuthBase\Interfaces\RegisterData;

class Register
{
    /**
     * Email sender.
     *
     * @var CodeSender
     */
    protected CodeSender $sender;

    /**
     * Gate to handle data.
     *
     * @var RegisterData
     */
    protected RegisterData $dataGate;

    /**
     * Email.
     *
     * @var string
     */
    protected string $email;

    /**
     * Username.
     *
     * @var string
     */
    protected string $username;

    /**
     * Password.
     *
     * @var string
     */
    protected string $password;

    /**
     * Hash generated for password.
     *
     * @var string
     */
    protected string $pwdHash;

    /**
     * Access Token generated for User.
     *
     * @var string
     */
    protected string $accessToken;

    /**
     * Verification Code generated for User.
     *
     * @var string
     */
    protected string $verificationCode;

    /**
     * Verification Flag.
     *
     * @var bool
     */
    protected bool $verified = false;

    /**
     * Time of Creation.
     *
     * @var int
     */
    protected int $createdAt;

    /**
     * Forward dependencies.
     *
     * @param RegisterData $dataGate
     * @param CodeSender $sender
     */
    public function __construct(RegisterData $dataGate, CodeSender $sender)
    {
        $this->dataGate = $dataGate;
        $this->sender = $sender;
    }

    /**
     * Email setter.
     *
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Username setter.
     *
     * @param $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Password setter.
     *
     * @param $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Register new User.
     *
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


    /**
     * Check User Credentials Uniqueness.
     *
     * @return bool
     */
    protected function emailOrLoginNonUnique(): bool
    {
        return $this->dataGate->existsByEmailOrUsername($this->email, $this->username);
    }

    /**
     * Set creation time.
     */
    protected function initCreatedAt()
    {
        $this->createdAt = time();
    }

    /**
     * Generate password hash.
     */
    protected function genPasswordHash()
    {
        $this->pwdHash = password_hash($this->password, PASSWORD_DEFAULT);
    }

    /**
     * Generate Access Token.
     */
    protected function genAccessToken()
    {
        $this->accessToken = md5($this->username . $this->pwdHash) . md5(microtime());
    }

    /**
     * Generate Verification Code.
     */
    protected function genVerificationCode()
    {
        $this->verificationCode = md5($this->username . rand(0, 1000) . microtime());
    }

    /**
     * Create User fields array.
     *
     * @return array
     */
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

    /**
     * Save new user.
     *
     * @param $userFields
     * @return bool
     */
    protected function createNewUser($userFields): bool
    {
        $id = $this->dataGate->createUser($userFields);

        return !empty($id);
    }

    /**
     * Send code for Verification.
     *
     * @return bool
     */
    protected function sendVerificationCode(): bool
    {
        return $this->sender->sendCode($this->email, $this->verificationCode);
    }
}