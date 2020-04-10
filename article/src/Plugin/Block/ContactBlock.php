<?php
/**
 * @file
 * Contains \Drupal\article\Plugin\Block\ContactBlock.
 */

namespace Drupal\article\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;  


/**
 * Provides a 'contact' block.
 *
 * @Block(
 *   id = "contact_block",
 *   admin_label = @Translation("Contact Us"),
 *   category = @Translation("Custom contact us block")
 * )
 */
class ContactBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    // Retrieve existing configuration for this block.
    $config = $this->getConfiguration();

    // Add a form field to the existing block configuration form.

    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Name:'),
      '#default_value' => isset($config['name'])? $config['name'] : '',
    );
    
   
    $form['mobile'] = array(
      '#type' => 'number',
      '#title'=> t('Mobile:'),
      '#default_value' => isset($config['phn'])? $config['mobile'] : '',
    );
   
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    // Save our custom settings when the form is submitted.
    $this->setConfigurationValue('name', $form_state->getValue('name'));
    
    $this->setConfigurationValue('mobile', $form_state->getValue('mobile'));
   
  }



  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();

    $name = isset($config['name']) ? $config['name'] : '';
  
    $mobile = isset($config['mobile']) ? $config['mobile'] : '';
    

    return array(
      '#markup' => $this->t('Name :@name <br> Mobile: @mobile', array('@mobile'=> $mobile,'@name'=> $name)),
    );

  }

  /**
   * {@inheritdoc}
   */
  public function blockValidate($form, FormStateInterface $form_state) {
    $name = $form_state->getValue('name');
    $mobile = $form_state->getValue('mobile');

    if (is_numeric($name)) {
      drupal_set_message('needs to be an integer', 'error');
      $form_state->setErrorByName('name', t('Name should not be numeric'));
    }
    if (!preg_match('/^[0-9]{10,11}$/',$mobile)) {
      drupal_set_message('Number is Invalid', 'error');
      $form_state->setErrorByName('mobile', t('Number should be of 10 digits'));
      
    }
  }
}
