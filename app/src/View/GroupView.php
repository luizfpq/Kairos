<?php

class GroupView
{

  const createRoute = 'view/group/create.php';

  const updateRoute = 'view/group/update.php';

  const deleteRoute = 'view/group/delete.php';

  const listRoute = 'view/group/list.php';

  const indexRoute = 'view/group/index.php';

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