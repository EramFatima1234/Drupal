<?php
namespace Drupal\myservice;

use Drupal\Core\Controller\ControllerBase;
use Drupal\myservice;

class MyServiceController extends ControllerBase
{
    public function work($pw)
    {
        $hash = \Drupal::service('myservice');
        return array('#markup' => '<table><thead><tr><th>Hash</th><th>Password</th></tr></thead><tbody><tr><td>' . $this->t($hash->getHash($pw) . '</td><td>' . $pw . '</td></tr></tbody></table>'));
    }

    public function worker()
    {
        $hello = \Drupal::service('myservice');
        return array('#markup' => $this->t($hello->whoIsYourOwner().' : '.$hello->whoIsYourOwnerName()));
    }
}
