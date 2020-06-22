<?php

class CategoryView
{

	const categoryRoute = 'view/category/index.php';

	const createRoute = 'view/category/create.php';

  	const updateRoute = 'view/category/update.php';

  	const deleteRoute = 'view/category/delete.php';

  	const detailsRoute = 'view/category/details.php';

  	public function __construct(){}

  	public function getCategoryRoute(){

    	return self::categoryRoute;
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
