<?php

class ActivityController extends Controller
{
  private $view;

  private $route;

  public function __construct(){

    $this->view = new ActivityView();
  }

  public function activityAction(){

    $message = Message::singleton();

    //$message->addMessage('Listando atividades.');

    //$message->save();

    $this->setRoute($this->view->getActivityRoute());

    $activityDao = new ActivityDao();

    $activities = $activityDao->getAll();

    $viewModel = array(
        'activities' => $activities,
    );


    $this->showView($viewModel);

    // $this->setRoute($this->view->getListRoute());
    //
    // $this->showView();

  }

  public function createAction(){

    $message = Message::singleton();

    $viewModel = false;

    if(isset($_REQUEST['submit']))
    {
      $name = isset($_POST['name']) ? $_POST['name'] : null;

      $description = isset($_POST['description']) ? $_POST['description'] : null;

      $user = isset($_POST['user']) ? $_POST['user'] : null;

      $sector = isset($_POST['sector']) ? $_POST['sector'] : null;

      try
      {
          $warnings = array();

          if(!$name)
            $warnings[] = 'Nome';

          if(!$description)
            $warnings [] = 'Descricao';

          if(sizeof($warnings))
            throw new Exception ('Preencha os campos ' . implode(', ', $warnings));



          /*$activity = ActivityFactory::factory($identifcationNumber, $type);

          $message->addMessage('O usuário instanciado é do tipo: '. get_class($activity) );
          */
          $activity = new Activity();

          $activityDao = new ActivityDao();

          $activity->setName($name);
          $activity->setDescription($description);
          $activity->setUser($user);
          $activity->setSector($sector);


          $activityId = $activityDao->create($activity);

          $activity->setId($activityId);

           $this->setRoute($this->view->getListRoute());

           $viewModel = array(
             'activities' => $activityDao->getAll()
           );

           $message->addMessage('Atividade adicionada com sucesso.');
      }
      catch(Exception $e)
      {
        $message->addWarning($e->getMessage());
      }
    }
    $this->setRoute($this->view->getCreateRoute());
    $this->showView($viewModel);

    $message->save();

    // $this->setRoute($this->view->getCreateRoute());
    //
    // $this->showView();

  }

  public function listAction(){

    $message = Message::singleton();

    $message->addMessage('Listando atividades.');

    $message->save();

    $this->setRoute($this->view->getListRoute());

    $activityDao = new ActivityDao();

    $activities = $activityDao->getAll();

    $viewModel = array(
        'activities' => $activities,
    );

    $this->showView($viewModel);

    // $this->setRoute($this->view->getListRoute());
    //
    // $this->showView();

  }

  public function deleteAction(){

    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

    $activityDao = new ActivityDao();

    $viewModel = false;

    if(isset($_REQUEST['submit']))
    {
      $this->setRoute($this->view->getActivityRoute());
      $activityDao->delete($id);
      $viewModel = array(
          'activities' => $activityDao->getAll()
      );

    }
    else
    {
      $this->setRoute($this->view->getDeleteRoute());

      $viewModel = array(
          'activity' => $activityDao->getById($id)
      );

    }

    $this->showView($viewModel);

  }

  public function updateAction(){

    $viewModel = false;
    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

    if(isset($_REQUEST['submit']))
    {

      $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
      $description = isset($_REQUEST['description']) ? $_REQUEST['description'] : '';
      $sector = isset($_REQUEST['sector']) ? $_REQUEST['sector'] : '';



      $activity = new Activity();
      $activity->setSector($sector);
      $activity->setName($name);
      $activity->setDescription($description);
      $activity->setId($id);

      $activityDao = new ActivityDao();
      $activityDao->update($activity);

      $this->setRoute($this->view->getActivityRoute());
      $this->showView($viewModel);

      $viewModel = array(
        'activities' => $activityDao->getAll()
      );
      $sectorDao = new SectorDao();
      $viewModel = array(
        'sectors' => $sectorDao->getAll()
      );

    }
    else
    {
      $this->setRoute($this->view->getUpdateRoute());
      $activityDao = new ActivityDao();
      $viewModel = array(
          'activity' => $activityDao->getById($id)
      );
    }

    $this->showView($viewModel);

    // $this->setRoute($this->view->getUpdateRoute());
    //
    // $this->showView();

  }
}
