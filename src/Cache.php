<?php
namespace GitHub {
  class Cache {
    public static function is(string $element) {
      if (!empty($_SESSION['cache'][$element])) {
        return true;
      }
      return false;
    }

    public static function list() {
      var_dump($_SESSION['cache']);
    }
  
    public static function get(string $element) {
      if (self::is($element)) {
        return $_SESSION['cache'][$element];
      }
      return null;
    }

    public static function set(string $element, $value) {
      $_SESSION['cache'][$element] = $value;
    }

    public static function clear() {
      $_SESSION['cache'] = array();
    }
  }
}