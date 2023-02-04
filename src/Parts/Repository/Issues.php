<?php

namespace GitHub\Parts\Repository {
  class Issues extends \GitHub\GitHub {
    function __construct(\GitHub\Parts\Repository $repo) {
      $this->repository = $repo;
      $this->token = (parent::getCache())::get('token');
    }

    public function list() : array {
      $get = json_decode(\GitHub\Http::get("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/issues", $this->token));
      $data = [];
      foreach ($get as $repo) {
        array_push($data, new Issue($this->repository, $repo));
      }
      return $data;
    }

    public function create(array $data) : Issue {
      return (new Issue(\GitHub\Http::post("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/issues", $this->repository->token, json_encode($data))));
    }

    public function get(int $number) : Issue {
      return (new Issue(\GitHub\Http::post("{$this->endpoint}/repos/{$this->repository->owner->login}/{$this->repository->name}/issues/{$number}", $this->token)));
    }

    public function load(object $object) : Issue {
      return (new Issue($this->repository, $object));
    }
  }
}
