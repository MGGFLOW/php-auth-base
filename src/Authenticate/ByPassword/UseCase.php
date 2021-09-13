<?php

namespace MGGFLOW\PhpAuth\Authenticate\ByPassword;

use MGGFLOW\PhpAuth\Exceptions\UserDoesntExist;
use MGGFLOW\PhpAuth\Exceptions\UserUnverified;
use MGGFLOW\PhpAuth\Exceptions\WrongPassword;

class UseCase
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
     * @var DataGateInterface
     */
    protected DataGateInterface $dataGate;

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
    public function auth(): ?object
    {
        if (!empty($this->email)) {
            $user = $this->dataGate->getUserByEmail($this->email);
        } elseif (!empty($this->username)) {
            $user = $this->dataGate->getUserByUsername($this->username);
        } else {
            return null;
        }

        if (empty($user)) {
            throw new UserDoesntExist();
        }

        if (empty($user->verified)) {
            throw new UserUnverified();
        }

        if (!$this->passwordEqualHash($this->password, $user->pwdHash)) {
            throw new WrongPassword();
        }

        return $user;
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