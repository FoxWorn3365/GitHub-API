<?php
namespace GitHub\Parts;

use GitHub\Client;
use GitHub\Http;
use GitHub\Parts\Repository;
use GitHub\Collection;

class Repositories extends Client {

  public function list() : Collection {
    $data = [];
    $get = json_decode(Http::get("{$this->endpoint}/user/repos", $this->token));
    foreach ($get as $repo) {
      $data[$repo->name] = new Repository($repo);
    }
    return (new Collection($data));
  }

  public function create(array $config) : Repository {
    return (new Repository(json_decode(Http::post("{$this->endpoint}/user/repos", $this->token, json_encode($config)))));
  }

  public function listByUser(string $user) : Collection {
    $data = [];
    $get = json_decode(Http::get("{$this->endpoint}/users/{$user}/repos", $this->token));
    foreach ($get as $repo) {
      $data[$repo->name] = new Repository($repo);
    }
    return (new Collection($data));
  }

  public function get(string $owner, string $name) : Repository {
    return (new Repository(json_decode(Http::get("{$this->endpoint}/repos/{$owner}/{$name}", $this->token))));
  }
}
