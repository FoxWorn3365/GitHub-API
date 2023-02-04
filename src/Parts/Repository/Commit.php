<?php
use GitHub\GitHub;

namespace GitHub\Parts\Repository {
  class Commit extends \GitHub\GitHub {
    function __construct(\GitHub\Parts\Repository $repo, object $commit) {
      foreach ($commit as $key => $val) {
        $this->{$key} = $val;
      }
      $this->author = (new \GitHub\Parts\User($this->author));
    }
  }
}
    