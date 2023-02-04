<?php
namespace GitHub\Promises;

use GitHub\Http;
use GitHub\Cache;

class HttpPromise {
  public string $url;
  public mixed $data;
  public string $method;

  function __construct(string $url, mixed $data, string $method = 'GET') {
    $this->url = $url;
    $this->data = $data;
    $this->method = $method;
    $this->token = Cache::get('token');
  }

  function resolve() : mixed {
    return Http::request($this->method, $this->url, $this->token, $this->data);
  }
}
    