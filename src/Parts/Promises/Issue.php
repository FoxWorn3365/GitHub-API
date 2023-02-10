<?php
namespace GitHub\Promises;

use GitHub\Client;
use GitHub\Http;
use GitHub\Parts\Repository;
use GitHub\Parts\Repository\Issue as Realissue;
use GitHub\Parts\User;

class Issue extends Client {
  protected object $__native;
  public $repository_url;
  public User $user;

  function __construct(object $issue) {
    $this->__native = $issue;
    foreach ($issue as $key => $val) {
      $this->{$key} = $val;
    }
    $this->user = (new User($this->user));
  }

  public function repository() {
    return (new Repository(Http::get($this->repository_url, $this->token)));
  }

  public function resolve() {
    $repo = self::repository();
    return (new Realissue($repo, $this->__native));
  }
}