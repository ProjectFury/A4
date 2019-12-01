<?php


namespace Rentit;


trait Singleton
{
    private static $instance;

    public static function getInstance(): self
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}