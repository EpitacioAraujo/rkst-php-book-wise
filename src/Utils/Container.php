<?php

namespace Epitas\App\Utils;

class Container
{
    private static $instance = null;
    private $services = [];

    private function __construct()
    {
        // signleton
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function set($id, $service)
    {
        $this->services[$id] = $service;
        return $this;
    }

    public function get($id)
    {
        if (!$this->has($id)) {
            throw new \Exception("Service '$id' not found in container");
        }
        return $this->services[$id];
    }

    public function has($id)
    {
        return isset($this->services[$id]);
    }
}
