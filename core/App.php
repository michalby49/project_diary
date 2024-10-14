<?php
// core/App.php

class App {
    protected $controller = 'HomeController';  // Domyślny kontroler
    protected $method = 'index';  // Domyślna metoda
    protected $params = [];  // Parametry

    public function __construct() {
        $url = $this->parseUrl();

        // Sprawdzenie, czy kontroler istnieje
        if (isset($url[0]) && file_exists('../app/controllers/' . $url[0] . 'Controller.php')) {
            $this->controller = $url[0] . 'Controller';
            unset($url[0]);
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Sprawdzenie, czy metoda istnieje
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
