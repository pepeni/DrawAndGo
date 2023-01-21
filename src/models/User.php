<?php

namespace models;

class User
{
    private $email;
    private $password;
    private $nick;
    private $salt;
    private $admin;

    private $dateTime;

    public function __construct(string $email, string $password, string $nick, string $salt, bool $admin)
    {
        $this->email = $email;
        $this->password = $password;
        $this->nick = $nick;
        $this->salt = $salt;
        $this->admin = $admin;
    }


    public function getEmail(): string
    {
        return $this->email;
    }


    public function getPassword(): string
    {
        return $this->password;
    }

    public function getNick(): string
    {
        return $this->nick;
    }

    public function getSalt(): string
    {
        return $this->salt;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function setNick(string $nick)
    {
        $this->nick = $nick;
    }

    public function setSalt(string $salt)
    {
        $this->salt = $salt;
    }

    public function getAdmin(): bool
    {
        return $this->admin;
    }

    public function setAdmin(bool $admin)
    {
        $this->admin = $admin;
    }

    public function getDateTime():string
    {
        return $this->dateTime;
    }

    public function setDateTime(string $dateTime): void
    {
        $this->dateTime = $dateTime;
    }



}