<?php


namespace Rentit;


final class Registry
{
    use Singleton;

    /**
     * @var array
     */
    private $data;

    /**
     * Registry constructor.
     */
    public function __construct()
    {
        $this->data = [];
        $this->load();
    }

    /**
     * Method that creates $key if not exists.
     * @param $key
     * @param $value
     */
    public function set(string $key, $value)
    {
        if (!array_key_exists($key, $this->data)) {
            $this->data[$key] = $value;
        }
    }

    /**
     * Method that returns a key if exists
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key)
    {
        if ($key != null) {
            if (array_key_exists($key, $this->data)) {
                return $this->data[$key];
            } else {
                return null;
            }
        }

        return null;
    }

    /**
     * Load the data from the config file
     */
    private function load(): void
    {
        $fileconf = ROOT . 'config.json';
        $jsonstr = file_get_contents($fileconf);
        $arrayJson = json_decode($jsonstr);

        foreach ($arrayJson as $key => $value) {
            $this->data[$key] = $value;
        }
    }
}