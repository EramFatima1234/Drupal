<?php
namespace Drupal\myservice;

use Drupal\Core\Password\PhpassHashedPassword;
use Drupal\Core\Session\AccountProxy;

class MyService
{
    private $password;
    private $user;
    public function __construct(PhpassHashedPassword $password, AccountProxy $user)
    {
        $this->password = $password;
        $this->user = $user;
    }

    public function getHash($pw)
    {
        return $this->password->hash($pw);
    }

    public function whoIsYourOwner()
    {
        return $this->user->getEmail();
    }

    public function whoIsYourOwnerName()
    {
        return $this->user->getDisplayName();
    }
}
