<?php

namespace MGGFLOW\AuthBase;

use MGGFLOW\AuthBase\Interfaces\AuthByPasswordData;
use MGGFLOW\AuthBase\Interfaces\Authenticator;
use MGGFLOW\AuthBase\Exceptions\UserDoesntExist;
use MGGFLOW\AuthBase\Exceptions\UserUnverified;
use MGGFLOW\AuthBase\Exceptions\WrongPassword;

class AuthByPassword extends Authentication implements Authenticator
{
    /**
     * Email.
     *
     * @var string
     */
    protected string $email = '';

    /**
     * Username.
     *
     * @var string
     */
    protected string $username = '';

    /**
     * Password.
     *
     * @var string
     */
    protected string $password = '';

    /**
     * Gate to handle data.
     *
     * @var AuthByPasswordData
     */
    protected AuthByPasswordData $dataGate;

    /**
     * Forward dependencies.
     *
     * @param AuthByPasswordData $dataGate
     */
    public function __construct(AuthByPasswordData $dataGate)
    {
        $this->dataGate = $dataGate;
    }

    /**
     * Email setter.
     *
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * Username setter.
     *
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * Password setter.
     *
     * @param string $pass
     */
    public function setPassword(string $pass)
    {
        $this->password = $pass;
    }

    /**
     * Authenticate by Password.
     *
     * @throws UserUnverified
     * @throws UserDoesntExist
     * @throws WrongPassword
     */
    public function auth(): self
    {
        if (!empty($this->email)) {
            $user = $this->dataGate->getUserByEmail($this->email);
        } elseif (!empty($this->username)) {
            $user = $this->dataGate->getUserByUsername($this->username);
        }

        if (empty($user)) {
            throw new UserDoesntExist();
        }

        if (empty($user->verified)) {
            throw new UserUnverified();
        }

        if (!$this->passwordEqualHash($this->password, $user->pwd_hash)) {
            throw new WrongPassword();
        }

        $this->currentUser = $user;

        return $this;
    }

    /**
     * Compare password with hash.
     *
     * @param string $password
     * @param string $hash
     * @return bool
     */
    protected function passwordEqualHash(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

}