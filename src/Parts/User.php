<?php
use GitHub\GitHub;
use GitHub\Http;

namespace GitHub\Parts {
  class User extends \GitHub\GitHub {
    function __construct(object $responseJson) {
      foreach ($responseJson as $key => $value) {
        $this->{$key} = $value;
      }
    }

    public function follow(string $user) : object {
      return json_decode(Http::put("{$this->endpoint}/user/following/{$user}", $this->token));
    }

    public function unfollow(string $user) : object {
      return json_decode(Http::delete("{$this->endpoint}/user/following/{$user}", $this->token));
    }

    public function followers() : array {
      $data = [];
      $get = json_decode(Http::get("{$this->endpoint}/users/{$this->login}/followers", $this->token));
      foreach ($get as $u) {
        array_push($data, new GitHub\Parts\User($u));
      }
      return $data;
    }

    public function following() : array {
      $data = [];
      $get = json_decode(Http::get("{$this->endpoint}/users/{$this->login}/following", $this->token));
      foreach ($get as $u) {
        array_push($data, new GitHub\Parts\User($u));
      }
      return $data;
    }

    public function repositoriesList() : array {
      $data = [];
      $get = json_decode(\GitHub\Http::get("{$this->endpoint}/users/{$this->login}/repos", $this->token));
      foreach ($get as $repo) {
        array_push($data, new \GitHub\Parts\Repository($repo));
      }
      return $data;
    }
  }
}