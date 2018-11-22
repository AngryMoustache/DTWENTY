<?php

class MenuItem extends Model
{
    public $tablename = 'menu_items';

    public $relations = array(
        'hasOne' => array(
            'Menu' => array(
                'foreignKey' => 'menu_id',
                'targetForeignKey' => 'id',
                'displayField' => 'name',
            ),
            'StaticString' => array(
                'foreignKey' => 'static_string_id',
                'targetForeignKey' => 'id',
            ),
        )
    );
}
