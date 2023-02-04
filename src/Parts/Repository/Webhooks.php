<?php

namespace GitHub\Parts\Repository {
  class Webhooks extends \GitHub\GitHub {
    function __construct(\GitHub\Parts\Repository $repo) {
      $this->repository = $repo;
    }
 
    public function list() : array {
      $data = [];
      $get = json_decode(\GitHub\Http::get("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/hooks", $this->token));
      foreach ($get as $branch) {
        array_push($data, new \GitHub\Parts\Repository($branch));
      }
      return $data;
    }

    public function get(string $id) : Webhook {
      return (new Branch(\GitHub\Http::get("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/hooks/{$id}", $this->token)));
    }

    public function create(array $data) : Webhook {
      return (new Branch(\GitHub\Http::post("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/hooks", $this->token, json_encode($data))));
    }
  }
}
