<?php

session_start();

class App
{
  private $__controller, $__action, $__params;

  function __construct()
  {
    global $routes;

    // Default controller
    if (!empty($routes['default_controller'])) {
      $this->__controller = $routes['default_controller'];
    }
    $this->__action = 'index';
    $this->__params = [];

    $this->handlerUrl();
  }

  function getUrl()
  {
    if (!empty($_SERVER['PATH_INFO'])) {
      $url = $_SERVER['PATH_INFO'];
    } else {
      $url = '/';
    }
    return $url;
  }

  public function handlerUrl()
  {
    global $routes;
    $url = $this->getUrl();
    // echo "URL: $url<br>";

    // Remove leading and trailing slashes
    $url = trim($url, '/');

    if (isset($routes[$url])) {
      $route = explode('@', $routes[$url]);
      echo "Route: " . implode(', ', $route) . "<br>";
      $this->__controller = $route[0];
      echo "Controller: $this->__controller<br>";
      $this->__action = $route[1];
      echo "Action: $this->__action<br>";

      if (file_exists(__DIR__ . '/controllers/' . $this->__controller . '.php')) {
        require_once __DIR__ . '/controllers/' . $this->__controller . '.php';

        // Check if class exists
        if (class_exists($this->__controller)) {
          $this->__controller = new $this->__controller;
        } else {
          // Error
          $this->loadError();
          return;
        }
      } else {
        // Error
        $this->loadError();
        return;
      }
    } else {
      // Remove leading and trailing slashes
      $urlArr = array_filter(explode('/', $url));

      // Remove empty elements
      $urlArr = array_values($urlArr);

      // Handle controller
      if (!empty($urlArr[0])) {
        $this->__controller = ucfirst($urlArr[0]) . 'Controller';
      } else {
        $this->__controller = ucfirst($this->__controller) . 'Controller';
      }
      // echo "Controller: $this->__controller<br>";

      if (file_exists(__DIR__ . '/controllers/' . $this->__controller . '.php')) {
        require_once __DIR__ . '/controllers/' . $this->__controller . '.php';

        // Check if class exists
        if (class_exists($this->__controller)) {
          $this->__controller = new $this->__controller;
          unset($urlArr[0]);
        } else {
          // Error
          $this->loadError();
          return;
        }
      } else {
        // Error
        $this->loadError();
        return;
      }

      // Handle action
      if (!empty($urlArr[1])) {
        $this->__action = $urlArr[1];
        unset($urlArr[1]);
      }
      // echo "Action: $this->__action<br>";

      // Handle params
      $this->__params = array_values($urlArr);
    }

    // echo "Params: " . implode(', ', $this->__params) . "<br>";

    // Check if method exists
    if (method_exists($this->__controller, $this->__action)) {
      call_user_func_array([$this->__controller, $this->__action], $this->__params);
    } else {
      // Error
      $this->loadError();
    }
  }

  public function loadError($name = '404')
  {
    echo __DIR__;
    require_once __DIR__ . '/errors/' . $name . '.php';
  }
}
