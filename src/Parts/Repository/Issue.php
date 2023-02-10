<?php

namespace GitHub\Parts\Repository;

use GitHub\Client;
use GitHub\Http;
use GitHub\Parts\Repository;
use GitHub\Parts\User;

class Issue extends Client {
  public Repository $repository;
  public $number;

  function __construct(Repository $repo, object $issue) {
    $this->repository = $repo;
    foreach ($issue as $key => $val) {
      $this->{$key} = $val;
    }
    $this->user = (new User($this->user));
    $this->assignee = (new User($this->assignee));
  }

  public function update(array $data) : Issue {
    return (new Issue($this->repository, Http::patch("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/issues/{$this->number}", $this->token, json_encode($data))));
  }

  public function lock() : string {
    return Http::put("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/issues/{$this->number}/lock", $this->token);
  }

  public function unlock() : string {
    return Http::delete("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/issues/{$this->number}/lock", $this->token);
  }
}