<?php

class UserFactory
{

  static public function factory ($identificationNumber, $type)
  {
      $user = NULL;

      switch($type)
      {
        case 'rga':
          $user = new Student();
          break;

        case 'siape':
          $user = new Teacher();
          break;
      }

      $user->setIdentificationNumber($identificationNumber);

      return $user;
  }
}