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
        return Database::SQLselect('SELECT ' . $select . ' FROM ' . $this->tablename);
    }
}
