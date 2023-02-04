<?php
namespace GitHub {
  class Http extends \GitHub\GitHub {
    public static function request(string $protocol, string $url, string $token, mixed $body = NULL) {
      $body = $body ?? [];
      $options = stream_context_create(array( 
        'http' => array(
            'header' => "Accept: application/vnd.github+json\r\n" .
                        "Authorization: Bearer {$token}\r\n" . 
                        "User-Agent: request\r\n",
            'method' => $protocol,
            'content' => http_build_query($body)
        )
      )); 
      $response = file_get_contents($url, false, $options);
      return $response;
    }

    public static function get(string $url, string $token, mixed $body = NULL) {
      if (Cache::is($url)) {
        return Cache::get($url);
      }
      $response = self::request('GET', $url, $token, $body);
      Cache::set($url, $response);
      return $response;
    }

    public static function getNoCache(string $url, string $token, mixed $body = NULL) {
      $response = self::request('GET', $url, $token, $body);
      return $response;
    }

    public static function post(string $url, string $token, mixed $body = NULL) {
      return self::request('POST', $url, $token, $body);
    }  

    public static function patch(string $url, string $token, mixed $body = NULL) {
      return self::request('PATCH', $url, $token, $body);
    }

    public static function delete(string $url, string $token, mixed $body = NULL) {
      return self::request('DELETE', $url, $token, $body);
    }

    public static function put(string $url, string $token, mixed $body = NULL) {
      return self::request('PUT', $url, $token, $body);
    }
  }
}
