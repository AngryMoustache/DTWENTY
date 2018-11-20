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

    /**
    *   Default valuefield
    *   @var string
    */
    public $valueField = 'id';

    /**
    *   Default displayfield
    *   @var string
    */
    public $displayField = 'name';

    /**
    *
    *   The validation rules of the model
    *   - notNull
    *   
    *   @var array
    *
    */
    public $validation;

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
        if (!$this->name) {
            $this->name = get_called_class();
        }

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
        $_options = '';
        $_return = array();

        // Get the selector from options, otherwise it's just everything
        if (!array_key_exists('select', $options) || $options['select'] == '*') {
            $_select = '*';
        } else {
            $_select = implode($options['select'], ', ');
        }

        // where
        if (array_key_exists('where', $options))
        {
            $i = 0;
            foreach ($options['where'] as $value)
            {
                if ($i == 0) $_word = ' where ';
                else $_word = ' and ';
                if ($value[2] == null)
                {
                    if ($value[1] == '=') $value[1] = 'is';
                    $_options .= $_word . ' ' . $value[0] . ' ' . $value[1] . ' null';
                }
                else
                {
                    $_options .= $_word . ' ' . $value[0] . ' ' . $value[1] . ' "' . $value[2] . '"';
                }
                $i++;
            }
        }

        // order by (default)
        if (!array_key_exists('orderBy', $options))
        {
            $_options .= ' order by id ';
        }

        // order by
        if (array_key_exists('orderBy', $options))
        {
            $_options .= ' order by ' . $options['orderBy'];
        }

        // limit
        if (array_key_exists('limit', $options))
        {
            $_options .= ' limit ' . $options['limit'];
        }

        $_sql .= 'SELECT ' . $_select . ' FROM ' . $this->tablename . ' ' . $_options;

        $_return = Database::SQLselect($_sql);

        for ($i = 0; $i < count($_return); $i++)
        {
            // Has One
            if (isset($this->relations['hasOne']))
            {
                foreach ($this->relations['hasOne'] as $key => $value)
                {
                    $_return[$i][$key] = $this->_hasOne($key, $value, $_return[$i][strtolower($key) . '_id']);
                }
            }

            // // Joining tables
            // if (array_key_exists('relations', $options))
            // {
            //     // TODO
            // }
            // else
            // {
                // if (isset($this->relations['manyToMany']))
                // {
                //     foreach ($this->relations['manyToMany'] as $key => $value) {
                //         $this->{$key} = $this->loadModel($key);

                //         $_sql .= ' left outer join ' . $value['joinTable'] .
                //                  ' on ' . $this->tablename . '.id = ' . $value['joinTable'] . '.' . $value['foreignKey'] .
                //                  ' and ' . $value['joinTable'] . '.' . $value['foreignKey'] . ' = 1' .
                //                  ' left outer join tags' .
                //                  ' on ' . $value['joinTable'] . '.tag_id = tags.id';
                //     }
                // }
            // }
        }

        if (array_key_exists('limit', $options) && $options['limit'] == 1)
            return $_return[0];
        return $_return;
    }

    /*
    *
    *   Save a new item in the database
    *
    */
    public function create($data = array())
    {
        $validation = $this->_validate($data);
        if ($validation === true)
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
        else
        {
            return array('errors' => $validation);
        }
    }

    /**
    *   Edit a row
    */
    public function edit($id, $data = array())
    {
        $validation = $this->_validate($data);
        if ($validation === true)
        {
            $_updates = '';

            foreach ($data as $key => $value)
            {
                $_updates .= '`' . $key . '` = "' . $value . '", ';
            }

            $_updates = substr($_updates, 0, -2);

            $sql = 'UPDATE ' . $this->tablename . ' SET ' . $_updates . ' WHERE id = ' . $id;

            return Database::SQL($sql, true);
        }
        else
        {
            return array('errors' => $validation);
        }
    }

    /**
    *   Delete a row
    *   @var bool
    */
    public function delete($id)
    {
        if (Database::SQL('DELETE FROM ' . $this->tablename . ' WHERE id = ' . $id, false))
            return true;
        return false;
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
        else if (is_file($path)) include_once('Models/' . $model . '.php');

        return new $model();
    }

    /**
    *   hasOne relationship
    *   @var array
    */
    private function _hasOne($model, $relation, $currentId)
    {
        $this->{$model} = $this->loadModel($model);

        // $sql = 'select * from ' . $this->tablename .
        //         ' join ' . $this->{$model}->tablename .
        //         ' on ' . $this->{$model}->tablename .
        //         '.' . $relation['targetForeignKey'] .
        //         ' = ' . $this->tablename .
        //         '.' . $relation['foreignKey'] .
        //         ' where ' . $this->tablename . '.id = ' . $currentId;

        $sql = 'select * from ' . $this->{$model}->tablename . ' where ' . $relation['targetForeignKey'] . ' = ' . $currentId . ';';
        return Database::SQLselect($sql)[0];
    }

    /**
    *   Validate the model during save
    *   @var boolean
    */
    private function _validate($data)
    {
        $errors = array();

        foreach ($data as $key => $value)
        {
            if ($this->validation[$key])
            {
                foreach ($this->validation[$key] as $validation)
                {
                    switch ($validation)
                    {
                        case 'notNull':
                            if ($value == '') $errors[] = 'The ' . $key . ' field cannot be empty.';
                            break;
                        default:
                            throw new D20Exception('Validation rule "' . $validation . '" not found.');
                            break;
                    }
                }
            }
        }

        if ($errors == array()) return true;
        return $errors;
    }
}
