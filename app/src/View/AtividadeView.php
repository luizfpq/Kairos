<?php

class AtividadeView
{

	const atividadeRoute = 'view/atividade/index.php';

	const createRoute = 'view/atividade/create.php';

  	const updateRoute = 'view/atividade/update.php';

  	const deleteRoute = 'view/atividade/delete.php';

		const aprovaRoute = 'view/atividade/aprova.php';

		const reprovaRoute = 'view/atividade/reprova.php';

  	const listRoute = 'view/atividade/list.php';

  	public function __construct(){}

  	public function getAtividadeRoute(){

    	return self::atividadeRoute;
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

		public function getAprovaRoute(){

			return self::aprovaRoute;
		}

		public function getReprovaRoute(){

	    return self::reprovaRoute;
	  }

}
