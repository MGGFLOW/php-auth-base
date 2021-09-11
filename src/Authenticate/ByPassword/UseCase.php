<?php

namespace MGGFLOW\PhpAuth\Authenticate;

use MGGFLOW\PhpAuth\Authenticate\ByPassword\DataGateInterface;
use MGGFLOW\PhpAuth\Exceptions\UserDoesntExist;
use MGGFLOW\PhpAuth\Exceptions\UserUnverified;
use MGGFLOW\PhpAuth\Exceptions\WrongPassword;

class UseCase
{
    protected string $email = '';
    protected string $username = '';
    protected string $password = '';

    protected DataGateInterface $dataGate;

    public function __construct(DataGateInterface $dataGate)
    {
        $this->dataGate = $dataGate;
    }

    public function setEmail(string $email){
        $this->email = $email;
    }

    public function setUsername(string $username){
        $this->username = $username;
    }

    public function setPassword(string $pass){
        $this->password = $pass;
    }

    /**
     * @throws UserUnverified
     * @throws UserDoesntExist
     * @throws WrongPassword
     */
    public function auth(): ?object
    {
        if(!empty($this->email)){
            $user = $this->dataGate->getUserByEmail($this->email);
        }elseif (!empty($this->username)){
            $user = $this->dataGate->getUserByUsername($this->username);
        }else{
            return null;
        }

        if(empty($user)){
            throw new UserDoesntExist();
        }

        if(empty($user->verified)){
            throw new UserUnverified();
        }

        if(!$this->passwordEqualHash($this->password,$user->pwdHash)){
            throw new WrongPassword();
        }

        return $user;
    }

    /**
     * Compare password with hash
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