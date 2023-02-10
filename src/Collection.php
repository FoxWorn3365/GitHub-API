<?php
namespace GitHub;

class Collection {
    protected array $collector = [];

    function __construct(array $existingCollector = null) {
        if ($existingCollector != null) {
            $this->collector = $existingCollector;
        }
    }
    
    public function set(string $key, $value) : void {
        $this->collector[$key] = $value;
    }

    public function add(string $key, $value) : void {
        self::set($key, $value);
    }

    public function get(string $key) {
        return $this->collector[$key];
    }

    public function remove(string $key) : void {
        $this->collector[$key] = null;
    }

    public function count() : int {
        return count($this->collector);
    }

    public function index() : array {
        $data = [];
        foreach ($this->collector as $key => $value) {
            array_push($data, $key);
        }
        return $data;
    }
}