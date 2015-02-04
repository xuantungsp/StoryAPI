<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Model_Story extends \Orm\Model {
    
    protected static $_table_name = "tblStory";
    
    protected static $_properties = array(
        'id',
        'title' => array(
            'data_type' => 'varchar',
            'label' => 'Title',
            'validation' => array('required'),
        ),
        
        'number_view' => array(
            'data_type' => 'int',
            'label' => 'Number Views',
            'default' => 0,
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
    
    
    public $title;
}