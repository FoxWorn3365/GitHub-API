<?php
namespace GitHub {
  class GitHub { 
    public string $token;
    public static string $version = 'ALPHA 0.1 BUGS';
    public \GitHub\Cache $cache;
    public \GitHub\Parts\Users $users;
    public \GitHub\Parts\Search $search;
    public \GitHub\Parts\Search $query;
    public \GitHub\Utils $utils;
    public \GitHub\Cache $tempcache;
    public \GitHub\Collection $collection;
    public string $endpoint = 'https://api.github.com';

    function __construct() {
      $this->tempcache = (new \GitHub\Cache());
      if ($this->tempcache->is('token')) {
        $this->token = $this->tempcache::get('token'); 
      } else {
        $this->token = 'uuw';
      }
      $this->cache = (new \GitHub\Cache());
    }

    function getCache() {
      return (new Cache());
    }

    public function new(string $token) : GitHub {
      $this->token = $token;
      $this->cache::set('token', $token);
      $this->repositories = (new \GitHub\Parts\Repositories());
      $this->users = (new \GitHub\Parts\Users());
      $this->cache = (new \GitHub\Cache()); 
      $this->search = (new \GitHub\Parts\Search());
      $this->query = $this->search;
      $this->utils = (new \GitHub\Utils());
      $this->collection = (new \GitHub\Collection());
      return $this;
    }

    public function repositories() : Parts\Repositories {
      return (new Parts\Repositories());
    }
  }
}
