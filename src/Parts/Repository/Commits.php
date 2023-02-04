<?php
use GitHub\GitHub;

namespace GitHub\Parts\Repository {
  class Commits extends \GitHub\GitHub {
    function __construct(\GitHub\Parts\Repository $repo) {
      $this->repository = $repo;
    }

    public function list() : array {
      $data = [];
      $get = json_decode(\GitHub\Http::get("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/commits", $this->token));
      foreach ($get as $repo) {
        array_push($data, new \GitHub\Parts\Repository\Commit($repo));
      }
      return $data;
    }

    public function get(string $id) : Commit {
      return (new Commit(\GitHub\Http::get("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/commits/{$id}", $this->token)));
    }
  }
}