<?php

class UserView
{

  const createRoute = 'view/user/create.php';

  const updateRoute = 'view/user/update.php';

  const deleteRoute = 'view/user/delete.php';

  const listRoute = 'view/user/list.php';

  const indexRoute = 'view/user/index.php';

  public function __construct(){}

  public function getCreateRoute(){

    return self::createRoute;
  }

  public function getUpdateRoute(){

    return self::updateRoute;
  }

  public function getDeleteRoute(){

    return self::deleteRoute;
  }

  public function getListRoute(){

    return self::listRoute;
  }

  public function getIndexRoute(){

    return self::indexRoute;
  }
}