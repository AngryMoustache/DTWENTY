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
    *   The tablename for the model
    *
    */
    public $tablename;

    /*
    *
    *   Construct
    *   - Autofill the tablename
    *
    */
    public function __construct()
    {
        if (!$this->tablename) {
            $this->tablename = strtolower(get_called_class() . 's');
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
}
