<?php

class User extends Model
{
    public $relations = array(
        'manyToMany' => array(
            'Tag' => array(
                'joinTable' => 'tags_users',
                'foreignKey' => 'user_id',
                'targetForeignKey' => 'tag_id',
            )
        ),
    );

    public $validation = array(
        'username' => array('notNull'),
        'password' => array('notNull'),
    );
}