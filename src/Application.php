<?php

namespace Frisbee;

use App\Bootstrap\Bootstrap;
use Frisbee\Exception\Flingable;

class Application extends Flingable
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    protected $config;

    public function __construct($name)
    {
        parent::__construct($name, 1337);
        $this->name = $name;
        $this->config = [];
    }

    public function getConfig($key = null)
    {
        if (is_null($key) || empty($this->config)) {
            return $this->config;
        }

        if (!array_key_exists($key, $this->config)) {
            // Todo: implement boomerang here
        }

        return $this->config[$key];
    }

    public function run()
    {
        // Load all configuration files
        $appRoot = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
        foreach (glob($appRoot . 'config/*.php') as $file) {
            $filename = basename($file, '.php');
            $this->config[$filename] = require_once $file;
        }
    }

    public function next()
    {
        throw new Bootstrap($this);
    }
}
