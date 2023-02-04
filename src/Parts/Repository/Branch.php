<?php
use GitHub\GitHub;

namespace GitHub\Parts\Repository {
  class Branch extends \GitHub\GitHub {
    function __construct(\GitHub\Parts\Repository $repo, object $branch) {
      foreach ($branch as $key => $value) {
        $this->{$key} = $value;
      }
      $this->author = (new \GitHub\Parts\User($this->author));
      $this->commit = (new Commit($repo, $this->commit));
      $this->repository = $repo;
    }

    public function rename(array $data) : Branch {
      return (new Branch(\GitHub\Http::post("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/branches/{$this->name}/rename", $this->token, json_encode($data))));
    }
  }
}