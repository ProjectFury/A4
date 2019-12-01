<?php


namespace Rentit;


abstract class Controller
{
    public function error(){
        echo 'Error 404';
    }

    protected function view(string $template): View
    {
        return new View($template);
    }
}