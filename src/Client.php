<?php

namespace GitHub;

class Client {
    public string $api_program_author = "FoxWorn3365";
    public string $token;
    public Cache $cache;
    public string $endpoint = 'https://api.github.com';

    function __construct() {
        if (Cache::is('token')) {
            $this->token = Cache::get('token');
        }
        $this->cache = (new Cache());
    }
}