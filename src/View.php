<?php


namespace Rentit;


final class View
{
    private $template;
    private $variables = [];

    public function __construct(string $template)
    {
        $this->template = $template;
    }

    public function assign(string $variable, $value): self
    {
        $this->variables[$variable] = $value;

        return $this;
    }

    public function show(): string
    {
        $var = function (string $variable) {
            return $this->var($variable);
        };
        $auth = function (): bool {
            return $this->auth();
        };
        $session = function (string $key) {
            return $this->session($key);
        };
        $url = function (string $url = ''): string {
            return $this->url($url);
        };
        //Initialize output buffer
        ob_start();

        try {
            extract($this->variables);

            require TEMPLATES . $this->template . '.php';
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        //Get, clean and return output buffer
        return ob_get_clean();
    }

    private function var(string $variable)
    {
        if (isset($this->variables[$variable])) {
            return $this->variables[$variable];
        }

        return null;
    }

    private function auth(): bool
    {
        return Session::exists('user_id');
    }

    private function session(string $key)
    {
        return Session::get($key);
    }

    private function url(string $url = ''): string
    {
        $path = Registry::getInstance()->get('path');

        return $path . $url;
    }
}
