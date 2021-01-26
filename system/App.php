<?php
class App
{
    public function __construct()
    {

    }

    public function view($path = 'index', $data = array(), $status = false)
    {
        if (file_exists(__DIR__ . "/../views/{$path}.php")) {
            if ($data) {
                extract($data);
            }
            if ($status) {
                ob_start();
                include_once __DIR__ . "/../views/{$path}.php";
                return ob_get_clean();
            } else {
                include_once __DIR__ . "/../views/{$path}.php";
            }
        }
    }
    public function load_library($className)
    {
        if (file_exists(__DIR__ . "/../libraries/{$className}.php")) {
            include_once __DIR__ . "/../libraries/{$className}.php";
        }
    }
    public static function uri_segment($param = false)
    {
        $url = $_SERVER['REQUEST_URI'];
        $params = array_filter(explode("/", parse_url($url, PHP_URL_PATH)));
        if ($param) {
            if (isset($params[$param])) {
                return $params[$param];
            } else {
                return false;
            }
        } else {
            return $url;
        }
    }
    public function dangerChars($str)
    {
        $str = str_replace("`", "", $str);
        $str = str_replace("=", "", $str);
        $str = str_replace("&", "", $str);
        $str = str_replace("%", "", $str);
        $str = str_replace("!", "", $str);
        $str = str_replace("#", "", $str);
        $str = str_replace("<", "", $str);
        $str = str_replace(">", "", $str);
        $str = str_replace("*", "", $str);
        $str = str_replace("And", "", $str);
        $str = str_replace("'", "", $str);
        $str = str_replace("chr(34)", "", $str);
        $str = str_replace("chr(39)", "", $str);
        $str = urldecode($str);
        return $str;
    }
    public function input_get($name)
    {
        if (isset($_GET[$name])) {

            if (is_array($_GET[$name])) {

                return array_map(function ($item) {
                    return $this->filterUrl($item);
                }, $_GET[$name]);
            }

            return $this->filterUrl($_GET[$name]);
        }

        return false;
    }

    public function input_post($name)
    {
        if (isset($_POST[$name])) {

            if (is_array($_POST[$name])) {

                return array_map(function ($item) {
                    return $this->filterUrl($item, false);
                }, $_POST[$name]);
            }

            return $this->filterUrl($_POST[$name]);
        }

        return false;
    }
    public function filterUrl($str, $strip_tags = true)
    {
        if ($strip_tags) {

            return $this->dangerChars(strip_tags(htmlspecialchars(trim($str))));
        }

        return htmlspecialchars(trim($str));
    }
}