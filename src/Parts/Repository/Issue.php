<?php
use GitHub\GitHub;
use GitHub\Http;

namespace GitHub\Parts\Repository {
  class Issue extends \GitHub\GitHub {
    function __construct(\GitHub\Parts\Repository $repo, object $issue) {
      $this->repository = $repo;
      foreach ($issue as $key => $val) {
        $this->{$key} = $val;
      }
    }

    public function update(array $data) : Issue {
      return (new Issue(\GitHub\Http::patch("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/issues/{$this->number}", $this->token, json_encode($data))));
    }

    public function lock() : string {
      return \GitHub\Http::put("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/issues/{$this->number}/lock", $this->token);
    }

    public function unlock() : string {
      return \GitHub\Http::delete("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/issues/{$this->number}/lock", $this->token);
    }
  }
}