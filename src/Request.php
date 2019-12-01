<?php


namespace Rentit;


final class Request
{
    private $controller;
    private $action;
    private $params;

    private $arrURI;

    public function __construct()
    {
        $requestString = ltrim(htmlentities($_SERVER['REQUEST_URI']), Registry::getInstance()->get('path'));
        $this->arrURI = explode('/', $requestString);
        $this->extractURI();
        $this->setParams(explode('/', $requestString));
    }

    private function extractURI(): void
    {
        $length = count($this->arrURI);
        switch ($length) {
            case 1:
                if ($this->arrURI[0] == "") {
                    $this->setController('default');
                } else {
                    $this->setController($this->arrURI[0]);
                }
                $this->setAction('index');
                break;
            default:
                $this->setController($this->arrURI[0]);
                $this->setAction($this->arrURI[1]);
        }
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @param mixed $controller
     */
    public function setController($controller): void
    {
        $this->controller = $controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action): void
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param mixed $params
     */
    public function setParams($params): void
    {
        $this->params = $_POST;
        $length = count($params);
        if ($length > 2) {
            array_shift($params);
            array_shift($params);
        }

        $length = count($params);
        if ($length !== 0) {
            for ($i = 0; $i + 1 < $length; $i++) {
                if ($i % 2 == 0) {
                    $this->params[$params[$i]] = $params[$i + 1];
                }
            }
        }
    }

}