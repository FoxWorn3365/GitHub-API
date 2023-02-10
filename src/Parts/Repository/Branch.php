<?php

namespace GitHub\Parts\Repository;

use GitHub\Client;
use GitHub\Http;
use GitHub\Parts\Repository;
use GitHub\Parts\User;
use GitHub\Parts\Repository\Commit;

class Branch extends Client {
  public Repository $repository;
  public User $author;
  public Commit $commit;

  function __construct(Repository $repo, object $branch) {
    foreach ($branch as $key => $value) {
      $this->{$key} = $value;
    }
    $this->author = (new User($branch->author));
    $this->commit = (new Commit($repo, $branch->commit));
    $this->repository = $repo;
  }

  public function rename(array $data) : Branch {
    return (new Branch($this->repository, Http::post("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/branches/{$this->name}/rename", $this->token, json_encode($data))));
  }
}