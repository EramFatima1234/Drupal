<?php
namespace Drupal\register\Controller;

use Drupal\Core\Controller\ControllerBase;
use \Drupal\Core\Form\FormState; 
/**
 * Register controller.
 */

class RegisterController extends ControllerBase {

  /**
   * Returns a render-able array for a test page.
   */
  public function content() {
    
    $form_state = new FormState();
    $form_state->setRebuild();
    $myForm = \Drupal::formBuilder()->buildForm('Drupal\register\Form\RegisterForm', $form_state);
    \Drupal\register\Form\RegisterForm::submitMyForm($form_state);
    //Get Data From Database
    $database = \Drupal::database();
    $query = $database->select('register','u')
    ->fields('u', ['id', 'name', 'phone', 'email']);
    $rows = $query->execute();
    $result = array();
    if($rows)
    {
      while($row = $rows->fetchAssoc())
      {
        $arr = array($row['id'], $row['name'], $row['phone'], $row['email']);
        array_push($result, $arr);
      }
    }
    //A Blank form
    $newForm = \Drupal::formBuilder()->buildForm('Drupal\register\Form\RegisterForm', new FormState());
    $myData = $result;

    return array(
      //Your theme hook name
      '#theme' => 'register_theme_hook',      
      //Your variables
      '#variable2' => $newForm,
      '#variable1' => $myData,
    );
  }
}