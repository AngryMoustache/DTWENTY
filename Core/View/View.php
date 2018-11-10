<?php

/*
*
*   Class for everything views related
*
*/
class View
{
    /*
    *
    *   Render a view
    *
    */
    public function render($content)
    {
        $this->content = $content;
        include_once('Views/Main/main.dng');
    }

    /*
    *
    *   Render the content
    *
    */
    public function content($content = null)
    {
        if ($content == null)
            $content = $this->content;

        include_once('Views/' . $content . '.dng');
    }

    /*
    *
    *   Set variables for the view
    *
    */
    public function set($values)
    {
        foreach ($values as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
