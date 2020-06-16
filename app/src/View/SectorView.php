<?php

class SectorView
{

	const sectorRoute = 'view/sector/index.php';

	const createRoute = 'view/sector/create.php';

  	const updateRoute = 'view/sector/update.php';

  	const deleteRoute = 'view/sector/delete.php';

  	const detailsRoute = 'view/sector/details.php';


  	const listRoute = 'view/sector/list.php';

  	public function __construct(){}

  	public function getSectorRoute(){

    	return self::sectorRoute;
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


}
