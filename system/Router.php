<?php

class Router extends App
{
    private static $url;

    public function __construct()
    {
        self::$url = rtrim($this->uri_segment(1), ".php");
    }
    public static function get($url = null, $callback = null)
    {
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            if ($url == self::$url) {
                if (gettype($callback) == "object") {
                    call_user_func($callback);
                } else {
                    $params = explode("@", $callback);
                    $className = ucfirst($params[0]);
                    $methodName = $params[1];
                    if (file_exists(__DIR__ . "/../controllers/{$className}.php")) {
                        require_once __DIR__ . "/../controllers/{$className}.php";
                        if (class_exists($className)) {
                            $class = new $className;
                            if (method_exists($class, $methodName)) {
                                return $class->$methodName();
                            }
                        }
                    }
                }
            }
        }
    }
    public static function post($url = null, $callback = null)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if ($url == trim($_SERVER["REQUEST_URI"], "/")) {
                if (gettype($callback) == "object") {
                    call_user_func($callback);
                } else {
                    $params = explode("@", $callback);
                    $className = ucfirst($params[0]);
                    $methodName = $params[1];
                    if (file_exists(__DIR__ . "/../controllers/{$className}.php")) {
                        require_once __DIR__ . "/../controllers/{$className}.php";
                        if (class_exists($className)) {
                            $class = new $className;
                            if (method_exists($class, $methodName)) {
                                return $class->$methodName();
                            }
                        }
                    }
                }
            }
        }
    }
}