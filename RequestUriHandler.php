<?php


class RequestUriHandler
{
    static function handleRequestUri(string $requestUri) {
        $path = substr($requestUri, 1);
        $class = explode('/', $path)[0];
        $method = explode('/', $path)[1];

        if(class_exists($class)) {
            $class = new $class();
            if(method_exists($class, $method)) {
                return $class->$method();
            }
        }

        return require_once 'index.php';
    }
}
require_once 'autoload.php';
RequestUriHandler::handleRequestUri($_SERVER['REQUEST_URI']);