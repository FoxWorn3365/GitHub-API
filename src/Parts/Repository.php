<?php
use GitHub\GitHub;
use GitHub\Parts\Issues;

namespace GitHub\Parts {
  class Repository extends \GitHub\GitHub {
    protected string $int_owner;
    protected string $int_name;

    function __construct(object $responseJson) {
      foreach ($responseJson as $key => $value) {
        $this->{$key} = $value;
        if ($key == 'owner') {
          $this->owner = new User($value);
        }
      }
      $this->issues = (new \GitHub\Parts\Repository\Issues($this));
      $this->int_owner = $responseJson->owner->login;
      $this->int_name = $responseJson->name;
    }

    public function update(mixed $data) : GitHub\Parts\Repository {
      return new GitHub\Parts\Repository(json_decode(Http::patch("{$this->endpoint}/repos/{$this->int_owner}/{$this->int_name}", $this->token, $data)));
    }

    public function delete(mixed $data) : string {
      return Http::delete("{$this->endpoint}/repos/{$this->int_owner}/{$this->int_name}", $this->token);
    }

    public function getLanguages() : object {
      return json_decode(Http::get("{$this->endpoint}/repos/{$this->int_owner}/{$this->int_name}/languages", $token));
    }

    public function tags() : object { 
      return json_decode(Http::get("{$this->endpoint}/repos/{$this->int_owner}/{$this->int_name}/tags", $token));
    }

    public function teams() : object {
      return json_decode(Http::get("{$this->endpoint}/repos/{$this->int_owner}/{$this->int_name}/teams", $token));
    }

    public function topics() : array {
      return json_decode(Http::get("{$this->endpoint}/repos/{$this->int_owner}/{$this->int_name}/topics", $token))->names;
    }

    public function setTopics(array $topics) : array {
      $data = json_encode(['names' => $topics]);
      return json_decode(Http::put("{$this->endpoint}/repos/{$this->int_owner}/{$this->int_name}/topics", $token, $data))->names;
    }

    public function transfer(string $new_owner, string $new_username, $team_ids = []) : GitHub\Parts\Repository {
      return new GitHub\Parts\Repository(json_decode(Http::post("{$this->endpoint}/repos/{$this->int_owner}/{$this->int_name}/transfer", $this->token, json_encode(array('new_owner' => $new_owner, 'team_ids' => $team_ids, 'new_name' => $new_name)))));
    }
  }
}