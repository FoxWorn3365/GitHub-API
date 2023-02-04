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
      return json_decode(\GitHub\Http::getNoCache("{$this->endpoint}/search/issues?q={$query}", $this->token));
    }

    public function labels(string $query) : object {
      return json_decode(\GitHub\Http::getNoCache("{$this->endpoint}/search/labels?q={$query}", $this->token));
    }

    public function repo(string $query) : object {
      return json_decode(\GitHub\Http::getNoCache("{$this->endpoint}/search/repositories?q={$query}", $this->token));
    }

    public function topics(string $query) : object {
      return json_decode(\GitHub\Http::getNoCache("{$this->endpoint}/search/topics?q={$query}", $this->token));
    }

    public function users(string $query) : object {
      return json_decode(\GitHub\Http::getNoCache("{$this->endpoint}/search/users?q={$query}", $this->token));
    }
  }
}
