<?php


namespace Rentit;


final class View
{
    private $template;
    private $variables = [];

    /**
     * View constructor.
     * @param string $template
     */
    public function __construct(string $template)
    {
        $this->template = $template;
    }

    /**
     * @param string $variable
     * @param $value
     * @return View
     */
    public function assign(string $variable, $value): self
    {
        $this->variables[$variable] = $value;

        return $this;
    }

    /**
     * @return string
     */
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

    /**
     * @param string $variable
     * @return mixed|null
     */
    private function var(string $variable)
    {
        if (isset($this->variables[$variable])) {
            return $this->variables[$variable];
        }

        return null;
    }

    /**
     * @return bool
     */
    private function auth(): bool
    {
        return Session::exists('user_id');
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    private function session(string $key)
    {
        return Session::get($key);
    }

    /**
     * @param string $url
     * @return string
     */
    private function url(string $url = ''): string
    {
        $path = Registry::getInstance()->get('path');

        return $path . $url;
    }
}
