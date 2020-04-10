<?php

namespace Drupal\custom\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class register.
 */
class register extends FormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'register';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Name'),
            '#weight' => '0',
        ];
        $form['phone_number'] = [
            '#type' => 'number',
            '#title' => $this->t('Phone Number'),
            '#weight' => '0',
        ];
        $form['email_id'] = [
            '#type' => 'email',
            '#title' => $this->t('Email Id'),
            '#weight' => '0',
        ];
        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state)
    {

        if (mb_strlen($form_state->getValue('phone_number') < 10) || mb_strlen($form_state->getValue('phone_number')) > 10) {
            $form_state->setErrorByName('phone_number', $this->t('Phone Number should be 10 digits.'));
        }
        if (!filter_var($form_state->getValue('email_id'), FILTER_VALIDATE_EMAIL)) {
            $form_state->setErrorByName('email_id', $this->t('invalid email'));
        }
        if (!ctype_alpha(str_replace(' ', '', $form_state->getValue('name')))) {
            $form_state->setErrorByName('name', $this->t('Name is invalid'));
        }

        // @TODO: Validate fields.

        parent::validateForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // Display result.
        // foreach ($form_state->getValues() as $key => $value) {
        //     \Drupal::messenger()->addMessage($key . ': ' . ($key === 'text_format' ? $value['value'] : $value));

        \Drupal::messenger()->addMessage('Record Added Successfully!');

        \Drupal::database()
            ->insert('registration')
            ->fields([
                'name' => $form_state->getValue('name'),
                'phone_number' => $form_state->getValue('phone_number'),
                'email_id' => $form_state->getValue('email_id'),
            ])
            ->execute();

    }

}
