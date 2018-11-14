<?php

/*
*
*   The Model class for everything model related
*
*/
class Model
{
    /**
    *
    *   The name of the model
    *   @var string
    *
    */
    public $name;

    /**
    *
    *   The tablename for the model
    *   @var string
    *
    */
    public $tablename;

    /**
    *
    *   Relations of the model
    *   @var array
    *
    */
    public $relations;

    /*
    *
    *   Construct
    *   (1) Set the model name
    *   (2) Autofill the tablename
    *   (3) Set the model labels
    *
    */
    public function __construct()
    {
        // 1
        $this->name = get_called_class();

        // 2
        if (!$this->tablename) {
            $this->tablename = strtolower(get_called_class() . 's');
        }

        // 3
        $this->labels = array(
            'name' => $this->name,
            'namePlural' => $this->name . 's',
            'machineName' => strtolower($this->name),
            'machineNamePlural' => strtolower($this->name) . 's',
        );
    }

    /**
    *
    *   A select statement for the model
    *   @var array
    *
    */
    public function find($options = array())
    {
        $_sql = '';

        // Get the selector from options, otherwise it's just everything
        if (!array_key_exists('select', $options) || $options['select'] == '*') {
            $_select = '*';
        } else {
            $_select = implode($options['select'], ', ');
        }

        $_sql .= 'SELECT ' . $_select . ' FROM ' . $this->tablename;

        // Joining tables
        if (array_key_exists('relations', $options)) {
            // TODO
        }
        else {
            // Perform all joins
            if (isset($this->relations['belongsTo']))
            {
                foreach ($this->relations['belongsTo'] as $key => $value) {
                    $this->{$key} = $this->loadModel($key);

                    $_sql .= ' join ' . $this->{$key}->tablename .
                             ' on ' . $this->{$key}->tablename .
                             '.' . $value['relation']  .
                             ' = ' . $this->tablename .
                             '.' . $value['foreignKey'];
                }
            }
        }

        // TODO
        // - where

        return Database::SQLselect($_sql);
    }

    /*
    *
    *   Save a new item in the database
    *
    */
    public function create($data = array())
    {
        $keys = '';
        $values = '';

        foreach ($data as $key => $value)
        {
            $keys .= '`' . $key . '`, ';
            $values .= '"' . $value . '", ';
        }

        $keys = substr($keys, 0, -2);
        $values = substr($values, 0, -2);

        $sql = 'INSERT INTO ' . $this->tablename . ' (' . $keys . ') VALUES (' . $values . ');';
        return Database::SQL($sql);
    }

    /*
    *
    *   Load a new model
    *
    */
    public function loadModel($model, $plugin = null)
    {
        $path = 'Models/' . $model . '.php';
        if ($plugin != null) {
            $path = 'Plugins/' . $plugin . '/Models/' . $model . '.php';
        }

        if (is_file($path)) include_once($path);
        else include_once('Models/' . $model . '.php');

        return new $model();
    }
}
