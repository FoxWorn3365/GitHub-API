<?php
namespace GitHub {
  class GitHub { 
    public string $token;
    public static string $version = 'ALPHA 0.1 BUGS';
    public static \GitHub\Cache $cache;
    protected string $endpoint = 'https://api.github.com';

    function __construct() {
      $this->tempcache = (new \GitHub\Cache());
      if ($this->tempcache->is('token')) {
        $this->token = $this->tempcache::get('token'); 
      }
      $this->cache = (new \GitHub\Cache());
    }

    function getCache() {
      return (new Cache());
    }

    public function new(string $token) : GitHub {
      $this->token = $token;
      $this->repositories = (new Parts\Repositories());
      $this->users = (new Parts\Users());
      $this->cache = (new Cache()); 
      $this->search = (new Parts\Search());
      $this->query = (new Parts\Search());
      $this->http = (new \GitHub\Http());
      $this->cache::set('token', $token);
      return $this;
    }

    public function repositories() : Parts\Repositories {
      return (new Parts\Repositories());
    }
  }
}