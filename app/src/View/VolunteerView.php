<?php

class VolunteerView
{

	const volunteerRoute = 'view/volunteer/index.php';

	const createRoute = 'view/volunteer/create.php';

  const updateRoute = 'view/volunteer/update.php';

  const deleteRoute = 'view/volunteer/delete.php';

  const detailsRoute = 'view/volunteer/details.php';

  const listRoute = 'view/volunteer/list.php';

	const acceptRoute = 'view/volunteer/accept.php';

  public function __construct(){}

  public function getVolunteerRoute(){

    	return self::volunteerRoute;
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

	  public function getDetailsRoute(){

	    return self::detailsRoute;
	  }

	  public function getListRoute(){

	    return self::listRoute;
	  }
		public function getAcceptRoute(){

			return self::acceptRoute;
		}

}
