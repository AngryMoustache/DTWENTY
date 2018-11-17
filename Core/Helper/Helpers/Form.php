<?php

class Form extends Helper
{
    /**
    *   Start a form
    *   @var string
    */
    public function start($options = array())
    {
        $input = '<form ' . $this->_parseOptions($options) . ' >';
        return $input;
    }

    /**
    *   End a form
    *   @var string
    */
    public function end()
    {
        $input = '</form>';
        return $input;
    }

    /**
    *   Create a freeform field
    *   @var string
    */
    public function field($options)
    {
        $input = '<input ' . $this->_parseOptions($options) . ' >';
        return $input;
    }

    /**
    *   Create an input field
    *   @var string
    */
    public function input($name, $value = '')
    {
        if ($value == '' && isset($_POST[$name])) $value = $_POST[$name];

        return '<input type="text" ' .
                'name="' . $name . '" ' .
                'placeholder="' . ucfirst($name) . '" ' .
                'value="' . $value . '" ' .
                '>';
    }

    /**
    *   Create a password field
    *   @var string
    */
    public function password($name = 'password')
    {
        return '<input type="password" ' .
                'name="' . $name . '" ' .
                'placeholder="' . ucfirst($name) . '" ' .
                'value="' . $_POST['username'] . '" ' .
                '>';
    
    }

    /**
    *   Create a submit button
    *   @var string
    */
    public function submit()
    {
        return '<input type="submit">';
    }

    /**
    *   Parse $options
    *   @var string
    */
    public function _parseOptions($options)
    {
        $_return = '';
        foreach ($options as $key => $value)
            $_return .= ' ' . $key . '="' . $value . '" ';
        return $_return;
    }
}
