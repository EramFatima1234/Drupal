<?php

namespace Drupal\custom\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ControlForm.
 */
class ControlForm extends FormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'control_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Name'),
            '#description' => $this->t('Name of The Person'),
            '#maxlength' => 64,
            '#size' => 64,
            '#weight' => '0',
        ];
        $form['gender'] = [
            '#type' => 'radios',
            '#title' => $this->t('Gender'),
            '#options' => ['Male' => $this->t('Male'), 'Female' => $this->t('Female'), 'Others' => $this->t('Others')],
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
        $form['address'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Address'),
            '#weight' => '0',
        ];
        $form['city'] = [
            '#type' => 'textfield',
            '#title' => $this->t('City'),
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

        \Drupal::messenger()->addMessage('Hurray! you have added  your name');

        \Drupal::database()
            ->insert('formdata2')
            ->fields([
                'name' => $form_state->getValue('name'),
                'phone' => $form_state->getValue('phone_number'),
                'email' => $form_state->getValue('email_id'),
                'gender' => $form_state->getValue('gender'),
                'address' => $form_state->getValue('address'),
                'city' => $form_state->getValue('city')
            ])
            ->execute();

    }

}
