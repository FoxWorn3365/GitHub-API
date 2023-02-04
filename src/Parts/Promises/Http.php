<?php
use GitHub\GitHub;
use GitHub\Http;

namespace GitHub\Promises;

class Http extends \GitHub\GitHub {
  public string $url;
  public mixed $data;
  public string $method;

  function __construct(string $url, mixed $data, string $method = 'GET') {
    $this->url = $url;
    $this->data = $data;
    $this->method = $method;
  }

  function resolve() : mixed {
    return Http::request($this->method, $this->url, $this->token, $this->data);
  }
}
    