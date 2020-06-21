<?php

class ActivityView
{

	const activityRoute = 'view/activity/index.php';

	const createRoute = 'view/activity/create.php';

  	const updateRoute = 'view/activity/update.php';

  	const deleteRoute = 'view/activity/delete.php';

  	const listRoute = 'view/activity/list.php';

  	public function __construct(){}

  	public function getActivityRoute(){

    	return self::activityRoute;
  	}

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


}