<?php

class UserController extends Controller
{
  private $view;

  private $route;

  public function __construct(){

    $this->view = new UserView();
  }

  public function UserAction(){

    $message = Message::singleton();

    $this->setRoute($this->view->getIndexRoute());

    $userDao = new UserDao();

    $users = $userDao->getAll();

    $viewModel = array(
        'users' => $users,
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


          $user = new User();
          $userDao = new UserDao();

          $user->setName($name);
          $user->setDescription($description);
          $user->setUser($user);
          $user->setCategory($category);


          $userId = $userDao->create($user);

          $user->setId($userId);

          $this->setRoute($this->view->getIndexRoute());

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

    $userDao = new UserDao();

    $viewModel = false;

    if(isset($_REQUEST['submit']))
    {
      $this->setRoute($this->view->getIndexRoute());

      $userDao->delete($id);

      $viewModel = array(
          'users' => $userDao->getAll()
      );
    }
    else
    {
      $this->setRoute($this->view->getDeleteRoute());

      $viewModel = array(
          'user' => $userDao->getById($id)
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

      $user = new User();
      $user->setName($name);
      $user->setDescription($description);
      $user->setId($id);


      $userDao = new UserDao();
      $userDao->update($user);

      $this->setRoute($this->view->getIndexRoute());

      $viewModel = array(
        'users' => $userDao->getAll()
      );

    }
    else
    {
      $this->setRoute($this->view->getUpdateRoute());

      $userDao = new UserDao();

      $viewModel = array(
          'user' => $userDao->getById($id)
      );
    }

    $this->showView($viewModel);

  }
}
