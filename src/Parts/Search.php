<?php
use GitHub\GitHub;

namespace GitHub\Parts {
  class Search extends \GitHub\GitHub {
    public function code(string $query) : object {
      return json_decode(\GitHub\Http::getNoCache("{$this->endpoint}/search/code?q={$query}", $this->token));
    }

    public function commits(string $query) : object {
      return json_decode(\GitHub\Http::getNoCache("{$this->endpoint}/search/commits?q={$query}", $this->token));
    }

    public function issues(string $query) : object {
      $data = json_decode(\GitHub\Http::getNoCache("{$this->endpoint}/search/issues?q={$query}", $this->token));
      $data->type='issue';
      $data->resolve = self::resolve($data);
      return $data;
    }

    public function labels(string $query) : object {
      $data = json_decode(\GitHub\Http::getNoCache("{$this->endpoint}/search/labels?q={$query}", $this->token));
      $data->type='label';
      return $data;
    }

    public function repo(string $query) : object {
      $data = json_decode(\GitHub\Http::getNoCache("{$this->endpoint}/search/repositories?q={$query}", $this->token));
      $data->resolve = function() { return self::resolve; };
      $data->type='repo';
      return $data;
    }

    public function topics(string $query) : object {
      $data = json_decode(\GitHub\Http::getNoCache("{$this->endpoint}/search/topics?q={$query}", $this->token));
      $data->type='topic';
      return $data;
    }

    public function users(string $query) : object {
      $data = json_decode(\GitHub\Http::getNoCache("{$this->endpoint}/search/users?q={$query}", $this->token));
      $data->resolve = function() { return $this->resolve($data); };
      $data->type='user';
      return $data;
    }

    public function resolve(object $response) : array {
      $associativeArrayTypes = array('user' => 'User', 'repo' => 'Repository', 'issue' => '\GitHub\Promises\Issue');
      $ret = array();
      foreach ($response->items as $data) {
        $className = $associativeArrayTypes[$response->type];
        array_push($ret, (new $className($data)));
      }
      return $ret;
    }

    public function iterator(object $response, callable $callback) : void {
      foreach ($response->items as $data) {
        $callback($data);
      }
      return;
    }
  }
}
