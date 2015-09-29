<?php

if (!defined('FLUIDFRAME')) {
    exit(1);
}

/**
 * Table Definition for Role
 */

class Role extends Managed_DataObject
{

    public $__table = 'role';                          // table name
    public $id;
    public $name;
    public $description;
    public $status;
    public $created;
    public $modified;
    public static function schemaDef() {
        $def = array (
                'description' => 'Roles',
                'fields' => array (
                        'id' => array (
                                'type' => 'serial',
                                'not null' => true,
                                'description' => 'unique identifier'
                        ),
                        'name' => array (
                                'type' => 'varchar',
                                'length' => 64,
                                'description' => 'Role name.'
                        ),
                        'description' => array (
                                'type' => 'varchar',
                                'length' => 255,
                                'description' => 'Role description',
                                'collate' => 'utf8_general_ci'
                        ),
                        'status' => array(
                                'type'=>'tinyint',
                                'length'=>1,
                                'description'=>'role status'
                        ),
                        'created' => array (
                                'type' => 'datetime',
                                'not null' => true,
                                'description' => 'date this record was created'
                        ),
                        'modified' => array (
                                'type' => 'timestamp',
                                'not null' => true,
                                'description' => 'date this record was modified'
                        )
                ),
                'primary key' => array (
                        'id'
                )
        );
    
        return $def;
    }
}