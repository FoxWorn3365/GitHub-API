<?php

namespace GitHub\Parts;

use GitHub\Client;
use GitHub\Collection;

class Users extends Client {

  public function list(int $max = 10) : Collection {
    $data = [];
    $get = json_decode(\GitHub\Http::get("{$this->endpoint}/users?since={$max}", $this->token));
    foreach ($get as $user) {
      $data[$user->login] = new User($user);
    }
    return (new Collection($data));
  }

  public function get(string $user) {
    return new User(json_decode(\GitHub\Http::get("{$this->endpoint}/users/{$user}", $this->token)));
  }
}