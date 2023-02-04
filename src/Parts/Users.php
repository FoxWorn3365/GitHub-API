<?php
use GitHub\GitHub;
use GitHub\Parts\User;
use GitHub\Http;

namespace GitHub\Parts {
  class Users extends \GitHub\GitHub {
    public function list(int $max = 10) : array {
      $data = [];
      $get = json_decode(Http::get("{$this->endpoint}/users?since={$max}", $this->token));
      foreach ($get as $user) {
        array_push($data, new User($user));
      }
      return $data;
    }

    public function get(name $user) {
      return new User(json_decode(Http::get("{$this->endpoint}/users/{$user}", $this->token)));
    }
  }
}