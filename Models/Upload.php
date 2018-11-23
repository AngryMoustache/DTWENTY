<?php

class Upload extends Model
{
    public $relations = array(
        'hasOne' => array(
            'Media' => array(
                'foreignKey' => 'media_id',
                'targetForeignKey' => 'id',
            ),
            'User' => array(
                'foreignKey' => 'user_id',
                'targetForeignKey' => 'id',
                'displayField' => 'name',
            )
        ),
        'manyToMany' => array(
            'Tag' => array(
                'joinTable' => 'tags_uploads',
                'foreignKey' => 'upload_id',
                'targetForeignKey' => 'tag_id',
                'displayField' => 'name',
            ),
        ),
    );
}
