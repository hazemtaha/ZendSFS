<?php

class Auth
{
    public function isAdmin()
    {
      $user = Zend_Auth::getInstance();
      if ($user->hasIdentity()) {
          return $user->getIdentity()->is_admin;
      } else {
          return false;
      }
    }
}
