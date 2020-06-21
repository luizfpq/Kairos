<?php

class ScheduleView
{

	const scheduleRoute = 'view/schedule/index.php';

	const createRoute = 'view/schedule/create.php';

  const updateRoute = 'view/schedule/update.php';

  const deleteRoute = 'view/schedule/delete.php';

  const detailsRoute = 'view/schedule/details.php';

	const volunteerActivityRoute = 'view/schedule/volunteer_activity.php';

	const listRoute = 'view/schedule/list.php';

	public function __construct(){}

		public function getScheduleRoute(){

    	return self::scheduleRoute;
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

		public function getVolunteerActivityRoute(){

			return self::volunteerActivityRoute;
		}

}
