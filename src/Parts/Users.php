<?php

namespace GitHub\Parts {
  
  class Users extends \GitHub\GitHub {
    public function list(int $max = 10) : array {
      $data = [];
      $get = json_decode(\GitHub\Http::get("{$this->endpoint}/users?since={$max}", $this->token));
      foreach ($get as $user) {
        array_push($data, new User($user));
      }
      return $data;
    }

    public function get(string $user) {
      return new User(json_decode(\GitHub\Http::get("{$this->endpoint}/users/{$user}", $this->token)));
    }
  }
}