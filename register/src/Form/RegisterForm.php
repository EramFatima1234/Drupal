<?php

namespace Drupal\register\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a register form.
 */
class RegisterForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'register_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#required' => TRUE,
    ];

    $form['phone'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Phone Number'),
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email ID'),
      '#required' => TRUE,
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save Data'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (mb_strlen($form_state->getValue('phone')) < 10) {
      $form_state->setErrorByName('name', $this->t('Phone Number should be at least 10 digits.'));
    }
    //We can add the rest of validation here
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  
  }
  public static function submitMyForm(FormStateInterface $form_state) {

    if($form_state->getValue('name') != '')
    {
      \Drupal::database()
      ->insert('register')
      ->fields([
      'name' => $form_state->getValue('name'),
      'phone' => $form_state->getValue('phone'),
      'email' => $form_state->getValue('email'),
    ])
      ->execute();
    }
    $form_state->setRedirect('/register/data');
  }
}
