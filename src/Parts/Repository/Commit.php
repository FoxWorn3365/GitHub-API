<?php

namespace GitHub\Parts\Repository;

use GitHub\Client;
use GitHub\Parts\Repository;
use GitHub\Parts\User;

class Commit extends Client {
  public Repository $repository;

  function __construct(Repository $repo, object $commit) {
    $this->repository = $repo;
    foreach ($commit as $key => $val) {
      $this->{$key} = $val;
    }
    $this->author = (new User($repo->author));
  }
}
    