<?php
namespace GitHub;

class Utils extends GitHub {
  public function refreshToken() : void {
    Cache::get('token');
  }
}
