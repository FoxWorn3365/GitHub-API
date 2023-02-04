<?php

namespace GitHub\Parts\Repository {
  class Branches extends \GitHub\GitHub {
    function __construct(\GitHub\Parts\Repository $repo) {
      $this->repository = $repo;
    }
 
    public function list() : array {
      $data = [];
      $get = json_decode(\GitHub\Http::get("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/branches", $this->token));
      foreach ($get as $branch) {
        array_push($data, new \GitHub\Parts\Repository($branch));
      }
      return $data;
    }

    public function get(string $name) : Branch {
      return (new Branch(\GitHub\Http::get("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/branches/{$name}", $this->token)));
    }
  }
}
