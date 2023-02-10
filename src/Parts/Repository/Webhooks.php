<?php

namespace GitHub\Parts\Repository;

use GitHub\Client;
use GitHub\Http;
use GitHub\Parts\Repository;
use GitHub\Parts\Repository\Webhook;

class Webhooks extends Client {
  public Repository $repository;

  function __construct(Repository $repo) {
    $this->repository = $repo;
  }

  public function list() : Collection {
    $data = [];
    $get = json_decode(Http::get("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/hooks", $this->token));
    foreach ($get as $branch) {
      array_push($data,new Repository($branch));
    }
    return (new Collection($data));
  }

  public function get(string $id) : Webhook {
    return (new Webhook($this->repository, Http::get("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/hooks/{$id}", $this->token)));
  }

  public function create(array $data) : Webhook {
    return (new Webhook($this->repository, Http::post("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/hooks", $this->token, json_encode($data))));
  }
}
