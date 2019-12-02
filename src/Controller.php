<?php


namespace Rentit;


abstract class Controller
{
    public function error(){
        echo 'Error 404';
    }

    /**
     * Print screen function
     * @param string $template
     * @return View
     */
    protected function view(string $template): View
    {
        return new View($template);
    }
}