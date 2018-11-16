<?php

class Tag extends Model
{
    public $relations = array(
        'hasOne' => array(
            'User' => array(
                'foreignKey' => 'user_id',
                'targetForeignKey' => 'id',
            )
        )
    );
}
