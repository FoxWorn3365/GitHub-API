<?php
namespace GitHub {
  use GitHub\Client;
  use GitHub\Cache;

  class GitHub extends Client { 
    public $repositories;
    public Cache $cache;
    public $users;
    public $search;
    public $query;
    public $utils;
    public $collection;

    function __construct(string $token) {
      Cache::set('token', $token);
      $this->repositories = (new \GitHub\Parts\Repositories());
      $this->users = (new \GitHub\Parts\Users());
      $this->cache = (new \GitHub\Cache()); 
      $this->search = (new \GitHub\Parts\Search());
      $this->query = (new \GitHub\Parts\Search());
      $this->utils = (new \GitHub\Utils());
      $this->collection = (new \GitHub\Collection());
    }

    public static function client() : Client {
      return (new Client());
    }
  }
}
