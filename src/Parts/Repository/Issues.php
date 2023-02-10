<?php

namespace GitHub\Parts\Repository;

use GitHub\Client;
use GitHub\Http;
use GitHub\Parts\Repository;
use GitHub\Parts\Repository\Issue;
use GitHub\Collection;

class Issues extends Client {
  public Repository $repository;

  function __construct(Repository $repo) {
    $this->repository = $repo;
  }

  public function list() : Collection {
    $get = json_decode(Http::get("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/issues", $this->token));
    $data = [];
    foreach ($get as $repo) {
      array_push($data, new Issue($this->repository, $repo));
    }
    return (new Collection($data));
  }

  public function create(array $data) : Issue {
    return (new Issue($this->repository, Http::post("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/issues", $this->token, json_encode($data))));
  }

  public function get(int $number) : Issue {
    return (new Issue($this->repository, Http::post("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/issues/{$number}", $this->token)));
  }

  public function load(object $object) : Issue {
    return (new Issue($this->repository, $object));
  }
}
