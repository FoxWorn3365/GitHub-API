<?php
use GitHub\GitHub;

namespace GitHub\Parts\Repository {
  class Webhook extends \GitHub\GitHub {
    function __construct(\GitHub\Parts\Repository $repo, object $webhook) {
      foreach ($webhook as $key => $val) {
        $this->{$key} = $val;
      }
      $this->repository = $repo;
    }

    public function delete() : string {
      return \GitHub\Http::delete("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/hooks/{$this->id}", $this->token);
    }

    public function update(array $data) : Webhook {
      return (new Webhook(\GitHub\Http::patch("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/hooks/{$this->id}", $this->token, json_encode($data))));
    }

    public function ping() : string {
      return \GitHub\Http::post("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/hooks/{$this->id}/ping", $this->token);
    }

    public function test() : string {
      return \GitHub\Http::post("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/hooks/{$this->id}/tests", $this->token);
    }
  }
}