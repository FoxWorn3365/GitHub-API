<?php

namespace GitHub\Parts;

use GitHub\Client;
use GitHub\Http;

class User extends Client {
  protected string $login;

  function __construct(object $responseJson) {
    parent::__construct();
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
      array_push($data, new User($u));
    }
    return $data;
  }

  public function following() : array {
    $data = [];
    $get = json_decode(Http::get("{$this->endpoint}/users/{$this->login}/following", $this->token));
    foreach ($get as $u) {
      array_push($data, new User($u));
    }
    return $data;
  }

  public function repositories() : \GitHub\Collection {
    $data = [];
    $get = json_decode(\GitHub\Http::get("{$this->endpoint}/users/{$this->login}/repos", $this->token));
    foreach ($get as $repo) {
      $data[$repo->name] = new \GitHub\Parts\Repository($repo);
    }
    return (new \GitHub\Collection($data));
  }
}