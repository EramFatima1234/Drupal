<?php
namespace Drupal\myName\Plugin\Field\FieldType;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Field\Annotation\FieldType;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;
/**
 * Plugin implementation of the 'myName' field type.
 *
 * @FieldType(
 *   id = "myName",
 *   label = @Translation("My Name field"),
 *   description = @Translation("This field stores name of the developer, thats me!. "),
 *   default_widget = "myName_default",
 *   default_formatter = "myName_default"
 * )
 */

 class MyNameItem extends FieldItemBase
 {
     /**
     * {@inheritdoc}
     */

    public static function schema(FieldStorageDefinitionInterface $field_definition)
    {
        return [
            'columns' => [
                'value' => [
                    'type' => 'varchar',
                    'description' => t('MyName'),
                    'length' => 20,
                    'not null' => FALSE,
                ],
            ],
            'indexes' => [
                'value' => ['value'],
            ]
        ];
    }

    
    /**
     * {@inheritdoc}
     */
    public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition)
    {
        $properties['value'] = DataDefinition::create('string')
            ->setLabel(t('MyName'));
        return $properties;
    }

 }