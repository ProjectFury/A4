<?php


namespace Rentit;


final class App
{
    public static function run(): void
    {
        Session::init();

        $request = new Request();

        $controller = $request->getController();
        $action = $request->getAction();
        $class = '\\Rentit\\Controllers\\' . ucfirst($controller) . 'Controller';

        if (class_exists($class)) {
            $objCont = new $class();

            if (is_callable([$objCont, $action])) {
                echo $objCont->$action($request);
                return;
            }
        }

        echo "-ERROR 404-";
    }
}

