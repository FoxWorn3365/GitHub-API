<?php
use \GitHub\GitHub as GitHub;
use \GitHub\Http;
use \GitHub\Parts\Repository;

namespace GitHub\Parts {
  class Repositories extends \GitHub\GitHub {
    public function list() : array {
      $data = [];
      $get = json_decode(\GitHub\Http::get("{$this->endpoint}/user/repos", $this->token));
      foreach ($get as $repo) {
        array_push($data, new Reporitory($repo));
      }
      return $data;
    }

    public function create(array $config) : Repository {
      return (new Repository(json_decode(\GitHub\Http::post("{$this->endpoint}/user/repos", $this->token, json_encode($config)))));
    }

    public function listByUser(string $user) : array {
      $data = [];
      $get = json_decode(\GitHub\Http::get("{$this->endpoint}/users/{$user}/repos", $this->token));
      foreach ($get as $repo) {
        array_push($data, new \GitHub\Parts\Repository($repo));
      }
      return $data;
    }

    public function get(string $owner, string $name) : Repository {
      return (new Repository(json_decode(\GitHub\Http::get("{$this->endpoint}/repos/{$owner}/{$name}", $this->token))));
    }
  }
}
