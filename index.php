<?php
use GitHub\GitHub;

require 'src/autoload.php';

$client = new GitHub('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');

var_dump($client->users->get('rad750')->repositories());