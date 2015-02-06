<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Model_Chap extends \Orm\Model {

    protected static $_table_name = 'tblChap';
      protected  static $_properties = array(
    'id',
        'story_id' => array(
            'data_type' => 'int',
            'label' => 'Story Id',
            'validation' => array('required'),
        ),
        'title' => array(
            'data_type' => 'text',
            'label' => 'Name',
            'validation' => array('required'),                      
        ),
        
        'content' => array(
            'data_type' => 'text',
            'validation' => array('required'),
        ),
        
        'created_at' => array(
             'data_type' => 'timestamp',
            'label' => 'Create at',
        ),
        
        'updated_at' => array(
             'data_type' => 'timestamp',
            'label' => 'Update at',
        )
    );
   
    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => false,
        ),
        'Orm\Observer_UpdatedAt' => array(
            'events' => array('before_update'),
            'mysql_timestamp' => false,
        ),
    );
    public $story_id, $title, $content;

    public static function validate($factory) {
        $val = Validation::forge($factory);
        $val->add_field('title', 'Title', 'required|max_length[255]');
        $val->add_field('content', 'Content', 'required');
        $val->add_field('story_id', 'Story Id', 'required|valid_string[numeric]');
        return $val;
    }

}
