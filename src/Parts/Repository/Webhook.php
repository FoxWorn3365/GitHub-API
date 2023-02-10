<?php

namespace GitHub\Parts\Repository;

use GitHub\Client;
use GitHub\Http;
use GitHub\Parts\Repository;

class Webhook extends Client {
  public Repository $repository;
  public $id;

  function __construct(Repository $repo, object $webhook) {
    foreach ($webhook as $key => $val) {
      $this->{$key} = $val;
    }
    $this->repository = $repo;
  }

  public function delete() : string {
    return Http::delete("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/hooks/{$this->id}", $this->token);
  }

  public function update(array $data) : Webhook {
    return (new Webhook($this->repository, Http::patch("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/hooks/{$this->id}", $this->token, json_encode($data))));
  }

  public function ping() : string {
    return Http::post("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/hooks/{$this->id}/ping", $this->token);
  }

  public function test() : string {
    return Http::post("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/hooks/{$this->id}/tests", $this->token);
  }
}