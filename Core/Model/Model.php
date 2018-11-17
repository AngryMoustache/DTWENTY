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
        $_return = array();

        // Get the selector from options, otherwise it's just everything
        if (!array_key_exists('select', $options) || $options['select'] == '*') {
            $_select = '*';
        } else {
            $_select = implode($options['select'], ', ');
        }

        $_sql .= 'SELECT ' . $_select . ' FROM ' . $this->tablename;

        $_return = Database::SQLselect($_sql);

        for ($i = 0; $i < count($_return); $i++)
        {
            // Joining tables
            if (array_key_exists('relations', $options))
            {
                // TODO
            }
            else
            {
                // Has One
                if (isset($this->relations['hasOne']))
                {
                    foreach ($this->relations['hasOne'] as $key => $value)
                    {
                        $_return[$i][$key] = $this->_hasOne($key, $value, $_return[$i]['id']);
                    }
                }


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
            }
        }

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
        else include_once('Models/' . $model . '.php');

        return new $model();
    }

    /**
    *   hasOne relationship
    *   @var array
    */
    private function _hasOne($model, $relation, $currentId)
    {
        $this->{$model} = $this->loadModel($model);

        $sql = 'select * from ' . $this->tablename .
                ' join ' . $this->{$model}->tablename .
                ' on ' . $this->{$model}->tablename .
                '.' . $relation['targetForeignKey'] .
                ' = ' . $this->tablename .
                '.' . $relation['foreignKey'] .
                ' where ' . $this->tablename . '.id = ' . $currentId;

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
            // Debug::dump($data);
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

        if ($errors == array()) return true;
        return $errors;
    }
}
