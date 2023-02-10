<?php

namespace GitHub\Parts\Repository;

use GitHub\Client;
use GitHub\Http;
use GitHub\Parts\Repository;
use GitHub\Collection;

class Branches extends Client {
  public Repository $repository;

  function __construct(Repository $repo) {
    $this->repository = $repo;
  }

  public function list() : Collection {
    $data = [];
    $get = json_decode(Http::get("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/branches", $this->token));
    foreach ($get as $branch) {
      array_push($data, new Repository($branch));
    }
    return (new Collection($data));
  }

  public function get(string $name) : Branch {
    return (new Branch($this->repository, Http::get("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/branches/{$name}", $this->token)));
  }
}
