<?php

namespace Drupal\custom\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class RegisterController.
 */
class RegisterController extends ControllerBase
{

    /**
     * Hello.
     *
     * @return string
     *   Return Hello string.
     */

    public function showdata($name)
    {

        // you can write your own query to fetch the data I have given my example.

        $result = \Drupal::database()->select('registration', 'n')
            ->fields('n', array('id', 'name', 'phone_number', 'email_id'))
            ->execute()->fetchAllAssoc('id');
        //Create the row element.
        $rows = array();
        foreach ($result as $row => $content) {
            $rows[] = array(
                'data' => array($content->id, $content->name, $content->phone_number, $content->email_id));
        }
        
        
        // Create the header.
        $header = array('id', 'name', 'phone_number', 'email_id');
        $output = array(
            '#theme' => 'custom_theme_hook', // Here you can write #type also instead of #theme.
            '#header' => $header,
            '#rows' => $rows,
            '#caption' => 'MyTable',
            //'#caption' => $name,
        );
        return $output;
    }

    // public function showname($name)
    // {

    //     // you can write your own query to fetch the data I have given my example.

    //     $result = \Drupal::database()->select('registration', 'n')
    //         ->fields('n', array('id', 'name', 'phone_number', 'email_id'))
    //         ->condition('name', $name)
    //         ->execute()->fetchAllAssoc('id');
    //     //Create the row element.
    //     $rows = array();
    //     foreach ($result as $row => $content) {
    //         $rows[] = array(
    //             'data' => array($content->id, $content->name, $content->phone_number, $content->email_id));
    //     }
    //     var_dump($rows);
    //     // Create the header.
    //     $header = array('id', 'name', 'phone_number', 'email_id');
    //     $output = array(
    //         '#theme' => 'table', // Here you can write #type also instead of #theme.
    //         '#header' => $header,
    //         '#rows' => $rows,
    //     );
    //     return $output;
    // }


}
