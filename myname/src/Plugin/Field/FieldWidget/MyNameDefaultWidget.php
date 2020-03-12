<?php

namespace Drupal\myName\Plugin\Field\FieldWidget;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Field\Annotation\FieldWidget;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
/**
 * @FieldWidget(
 *     id = "myName_default",
 *     label = @Translation("MyName default Widget"),
 *     field_types = {
 *          "myName"
 *     }
 * )
 */
class MyNameDefaultWidget extends WidgetBase
{
    /**
     * {@inheritdoc}
     */
    public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state)
    {
        $elements = [];

        $elements['value'] = [
            '#type' => 'textfield',
            '#title' => t('Your name'),
            '#default_value' => t('Eram Fatima'),
            '#size' => 60,
            '#maxlength' => 128,
            '#required' => TRUE,
        ];

        return $elements;
    }
}
