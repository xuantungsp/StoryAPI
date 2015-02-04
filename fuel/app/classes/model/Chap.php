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
        
        'create_at' => array(
             'data_type' => 'timestamp',
            'label' => 'Create at',
        ),
        
            'update_at' => array(
             'data_type' => 'timestamp',
            'label' => 'Update at',
        )
    );
    
    public $story_id, $title, $content;
}