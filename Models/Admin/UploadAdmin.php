<?php

class UploadAdmin extends AdminModel
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
            )
        ),
        'manyToMany' => array(
            'Tag' => array(
                'joinTable' => 'tags_uploads',
                'foreignKey' => 'upload_id',
                'targetForeignKey' => 'tag_id',
            ),
        ),
    );

    public $adminFields = array(
        'media_id' => array('type' => 'Media'),
        'user_id' => array('type' => 'Select'),
        'tags' => array('type' => 'ManyToMany'),
    );

    public $imageFields = array(
        'avatar',
    );
}
