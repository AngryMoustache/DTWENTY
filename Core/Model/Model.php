<?php

/*
*
*   The Model class for everything model related
*
*/
class Model
{
    /*
    *
    *   The name of the model
    *
    */
    public $name;

    /*
    *
    *   The tablename for the model
    *
    */
    public $tablename;

    /*
    *
    *   The fields for the model in the database
    *
    */
    public $fields;

    /*
    *
    *   Construct
    *   (1) Set the model name
    *   (2) Autofill the tablename
    *   (3) Set the model labels
    *   (4) Get the fields and the types
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

        // 4
        $_fields = Database::fields($this->tablename);
        foreach ($_fields as $field) {
            $this->fields[$field['COLUMN_NAME']] = array(
                'columnname' => $field['DATA_TYPE'],
                'human' => ucwords(str_replace('_', ' ', $field['COLUMN_NAME']))
            );
        }
    }

    /*
    *
    *   A select statement for the model
    *
    */
    public function find($select = '*', $options = array())
    {
        if ($options == array())
        {
            return Database::SQLselect('SELECT ' . $select . ' FROM ' . $this->tablename);
        }
        else
        {
            $sql = 'SELECT ' . $select . ' FROM ' . $this->tablename;

            foreach ($options as $key => $value)
            {
                $sql .= ' ' . $key . ' ' . $value;
            }

            if ($options['limit'] != 1)
                return Database::SQLselect($sql);
            return Database::SQLselect($sql)[0];
        }
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
}
