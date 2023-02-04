<?php
use GitHub\GitHub;
use GitHub\Http;
use GitHub\Parts\Repository;

namespace GitHub\Promises;

class Issue extends \GitHub\GitHub {
  function __construct(object $issue) {
    $this->__native = $issue;
    foreach ($issue as $key => $val) {
      $this->{$key} = $val;
    }
    $this->user = (new \GitHub\Parts\User($this->user));
  }

  public function repository() {
    return (new Repository(Http::get($this->repository_url)));
  }

  public function resolve() {
    $repo = self::repository();
    return (new \GitHub\Parts\Repository\Issue($repo, $this->__native));
  }
}