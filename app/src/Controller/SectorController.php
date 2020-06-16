<?php

class SectorController extends Controller
{
  private $view;

  private $route;

  public function __construct(){

    $this->view = new SectorView();
  }

  public function SectorAction(){

    $message = Message::singleton();

    $this->setRoute($this->view->getSectorRoute());

    $sectorDao = new SectorDao();

    $sectors = $sectorDao->getAll();

    $viewModel = array(
        'sectors' => $sectors,
    );

    $this->showView($viewModel);

  }

  public function createAction(){

    $message = Message::singleton();

    $this->setRoute($this->view->getCreateRoute());

    if(isset($_REQUEST['submit']))
    {
      $name = isset($_POST['name']) ? $_POST['name'] : null;
      $description = isset($_POST['description']) ? $_POST['description'] : null;
      $user = isset($_POST['user']) ? $_POST['user'] : null;
      $category = isset($_POST['category']) ? $_POST['category'] : null;

      try
      {
          $warnings = array();

          if(!$name)
            $warnings[] = 'Name';

          if(!$description)
            $warnings [] = 'Descrição';

          if(sizeof($warnings))
            throw new Exception ('Preencha os campos ' . implode(', ', $warnings));


          $sector = new Sector();
          $sectorDao = new SectorDao();

          $sector->setName($name);
          $sector->setDescription($description);
          $sector->setUser($user);
          $sector->setCategory($category);


          $sectorId = $sectorDao->create($sector);

          $sector->setId($sectorId);

          $this->setRoute($this->view->getSectorRoute());
          
          $message->addMessage('Setor adicionado com sucesso.');
      }
      catch(Exception $e)
      {
        $message->addWarning($e->getMessage());
      }
    }

    $message->save();

    $this->showView();



  }

  public function listAction(){

    $this->setRoute($this->view->getListRoute());

    $this->showView();

  }

  public function deleteAction(){

    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

    $sectorDao = new SectorDao();

    $viewModel = false;

    if(isset($_REQUEST['submit']))
    {
      $this->setRoute($this->view->getSectorRoute());

      $sectorDao->delete($id);

      $viewModel = array(
          'sectors' => $sectorDao->getAll()
      );
    }
    else
    {
      $this->setRoute($this->view->getDeleteRoute());

      $viewModel = array(
          'sector' => $sectorDao->getById($id)
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

      $sector = new Sector();
      $sector->setName($name);
      $sector->setDescription($description);
      $sector->setId($id);


      $sectorDao = new SectorDao();
      $sectorDao->update($sector);

      $this->setRoute($this->view->getSectorRoute());

      $viewModel = array(
        'sectors' => $sectorDao->getAll()
      );

    }
    else
    {
      $this->setRoute($this->view->getUpdateRoute());

      $sectorDao = new SectorDao();

      $viewModel = array(
          'sector' => $sectorDao->getById($id)
      );
    }

    $this->showView($viewModel);

  }
}
