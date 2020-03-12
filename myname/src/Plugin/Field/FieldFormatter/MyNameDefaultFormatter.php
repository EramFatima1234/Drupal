<?php
/**
 * @file
 * Contains \Drupal\myName\Plugin\field\FieldFormatter\MyNameDefaultFormatter.
 */
namespace Drupal\myName\Plugin\Field\FieldFormatter;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Field\Annotation\FieldFormatter;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * @FieldFormatter(
 *     id = "myName_default",
 *     label = @Translation("MyName Default Formatter"),
 *     field_types = {
 *          "myName"
 *     }
 * )
 */

 class MyNameDefaultFormatter extends FormatterBase
 {
     /**
     * {@inheritdoc}
     */
    public function viewElements(FieldItemListInterface $items, $langcode)
    {
        $elements = [];
        foreach ($items as $delta => $item){
            $name = $item->value;
            if(ctype_alpha(str_replace(' ', '', $name)))  //removing spaces, beacuse ctype_alpha doesn't accept spaces
            {
                $elements[$delta] = [
                    '#type' => 'markup',
                    '#markup' => '<br><hr><br><footer>'.$name.'</footer>',
                ];
            } else 
            {
                $elements[$delta] = [
                    '#type' => 'markup',
                    '#markup' => '<br><hr><br><footer> INVALID NAME </footer>',
                ];
            }
        }


        return $elements;
    }
 }