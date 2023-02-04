<?php

namespace GitHub {
  class Query {
    public static function new(Parts\Repository $repo = NULL) : QueryLoad {
      return (new \GitHub\QueryLoad($repo));
    }
  }

  class QueryLoad {
    public string $query = '';

    public function __construct(Parts\Repository $repo = NULL) {
      if ($repo != NULL) {
        $this->repository = $repo;
        $this->query = "repo%3A{$repo->author->login}/{$repo->name}";
      }
    }
 
    public function get() : string {
      return $this->query;
    }

    public function user(string $username) : self {
      $this->query .= "+user%3A{$username}";
      return $this;
    }

    public function repository(string $author, string $repo) : self {
      $this->query .= "repo%3A{$author}/{$repo}";
      return $this;
    }

    public function is(string $what) : self {
      $this->query .= "+is%3A{$what}";
      return $this;
    }

    public function in(string $what) : self {
      $this->query .= "+in%3A{$what}";
      return $this;
    }

    public function text(string $text) : self {
      $this->query .= "+{$text}";
      return $this;
    }
  }
}