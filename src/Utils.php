<?php
namespace GitHub;

class Utils extends Client {
  public function refreshToken() : void {
    Cache::get('token');
  }
}
