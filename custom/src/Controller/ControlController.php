<?php

namespace Drupal\custom\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class ControlController.
 */
class ControlController extends ControllerBase
{

    /**
     * Hello.
     *
     * @return string
     *   Return Hello string.
     */
    public function showdatas($name)
    {

        // you can write your own query to fetch the data I have given my example.

        $result = \Drupal::database()->select('formdata2', 'u')
            ->fields('u', array('id', 'name', 'phone', 'email', 'gender', 'address', 'city'))
            ->execute()->fetchAllAssoc('id');
        //Create the row element.
        $rows = array();
        foreach ($result as $row => $content) {
            $rows[] = array(
                'data' => array($content->id, $content->name, $content->phone, $content->email, $content->address, $content->city, $content->gender));
        }

        // Create the header.
        $header = array('id', 'name', 'phone', 'email', 'address', 'gender', 'city');
        $output = array(
            '#theme' => 'table', // Here you can write #type also instead of #theme.
            '#header' => $header,
            '#rows' => $rows,
            //'#caption' => $name,
        );

        
        return $output;
    }
}
