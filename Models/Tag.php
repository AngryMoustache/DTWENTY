<?php

class Tag extends Model
{
    public $relations = array(
        'belongsTo' => array(
            'User' => array(
                'foreignKey' => 'user_id',
                'relation' => 'id',
            )
        )
    );
}
