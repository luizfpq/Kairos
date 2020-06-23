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
      $nome  = isset($_POST['nome']) ? $_POST['nome'] : null;
      $login = isset($_POST['login']) ? $_POST['login'] : null;
      $senha = isset($_POST['senha']) ? $_POST['senha'] : null;
      $email = isset($_POST['email']) ? $_POST['email'] : null;
      $tipo  = isset($_POST['tipo']) ? $_POST['tipo'] : null;
      $nivel = isset($_POST['nivel']) ? $_POST['nivel'] : null;
      $identificador = isset($_POST['identificador']) ? $_POST['identificador'] : null;


      try
      {
          $warnings = array();

          if(!$nome)
            $warnings[] = 'Nome';

          if(!$senha)
            $warnings [] = 'Senha';

          if(!$email)
            $warnings [] = 'Email';

          if(!$identificador)
            $warnings [] = 'Identificador numérico valido (RGA/SIAPE)';





          if(sizeof($warnings))
            throw new Exception ('Preencha os campos ' . implode(', ', $warnings));


          $user = new User();
          $userDao = new UserDao();

          $user->setNome($nome);
          $user->setLogin($login);
          $user->setSenha($senha);
          $user->setEmail($email);
          $user->setTipo($tipo);
          $user->setNivel($nivel);
          $user->setIdentificador($identificador);

          $userId = $userDao->create($user);

          $user->setId($userId);

          $this->setRoute($this->view->getIndexRoute());

          $message->addMessage('Usuário adicionado com sucesso.');
      }
      catch(Exception $e)
      {
        $message->addWarning($e->getMessage());
      }
    }

    $this->setRoute($this->view->getCreateRoute());
    $this->showView($viewModel);

    $message->save();



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
