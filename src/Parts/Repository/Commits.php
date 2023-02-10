<?php

namespace GitHub\Parts\Repository;

use GitHub\Client;
use GitHub\Http;
use GitHub\Parts\Repository;
use GitHub\Parts\Repository\Commit;
use GitHub\Collection;

class Commits extends Client {
  public Repository $repository;

  function __construct(Repository $repo) {
    $this->repository = $repo;
  }

  public function list() : Collection {
    $data = [];
    $get = json_decode(Http::get("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/commits", $this->token));
    foreach ($get as $repo) {
      array_push($data, new Commit($this->repository, $repo));
    }
    return (new Collection($data));
  }

  public function get(string $id) : Commit {
    return (new Commit($this->repository, Http::get("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/commits/{$id}", $this->token)));
  }
}