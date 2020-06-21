<?php

class VolunteerController extends Controller
{
  private $view;

  private $route;

  public function __construct(){

    $this->view = new VolunteerView();
  }

  public function volunteerAction(){

    $message = Message::singleton();

    $this->setRoute($this->view->getVolunteerRoute());

    $volunteerDao = new VolunteerDao();

    $volunteers = $volunteerDao->getAll();

    $viewModel = array(
      'volunteers' => $volunteers,
    );

    $this->showView($viewModel);

  }

  public function createAction(){

    $message = Message::singleton();

    $this->setRoute($this->view->getCreateRoute());

    if(isset($_REQUEST['submit']))
    {




      $username = isset($_POST['username']) ? $_POST['username'] : null;

      $email = isset($_POST['email']) ? $_POST['email'] : null;

      $password = isset($_POST['password']) ? $_POST['password'] : null;

      $role = isset($_POST['role']) ? $_POST['role'] : null;

      try
      {
        $warnings = array();

        if(!$username)
        $warnings[] = 'Username';

        if(!$email)
        $warnings [] = 'E-mail';

        if(!$password)
        $warnings [] = 'Senha';

        if(sizeof($warnings))
        throw new Exception ('Preencha os campos ' . implode(', ', $warnings));


        $volunteer = new Volunteer();
        $volunteerDao = new VolunteerDao();

        $volunteer->setUsername($username);
        $volunteer->setEmail($email);
        $volunteer->setPassword($password);
        $volunteer->setRole($role);




        $volunteerId = $volunteerDao->create($volunteer);

        $volunteer->setId($volunteerId);

        $this->setRoute($this->view->getVolunteerRoute());

        $message->addMessage('Usuário adicionado com sucesso.');
      }
      catch(Exception $e)
      {
        $message->addWarning($e->getMessage());
      }
    }

    $message->save();

    $this->showView();



  }

  /*
  O Controlador recebe da view uma ação, que deverá ser executada pelo Model.
  O Model realiza a ação e prepara os dados para a view, por meio do Controller.

  */
  public function listAction() {

    $message = Message::singleton();

    $this->setRoute($this->view->getListRoute());

    $volunteerDao = new VolunteerDao();

    $volunteers = $volunteerDao->getAll();

    $viewModel = array(
      'volunteers' => $volunteers,
    );

    //$message->addMessage('Listando voluntários.');

    //$message->save();

    $this->showView($viewModel);
  }

  public function deleteAction(){

    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

    $volunteerDao = new VolunteerDao();

    $viewModel = false;

    if(isset($_REQUEST['submit']))
    {
      $this->setRoute($this->view->getVolunteerRoute());

      $volunteerDao->delete($id);

      $viewModel = array(
        'volunteers' => $volunteerDao->getAll()
      );
    }
    else
    {
      $this->setRoute($this->view->getDeleteRoute());

      $viewModel = array(
        'volunteer' => $volunteerDao->getById($id)
      );
    }

    $this->showView($viewModel);

  }

  public function detailsAction(){

    $this->setRoute($this->view->getDetailsRoute());

    $this->showView();

  }

  public function updateAction(){

    $viewModel = false;

    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

    if(isset($_REQUEST['submit']))
    {

      $username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
      $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
      $role = isset($_REQUEST['role']) ? $_REQUEST['role'] : '';

      $volunteer = new Volunteer();
      $volunteer->setUsername($username);
      $volunteer->setEmail($email);
      $volunteer->setRole($role);
      $volunteer->setId($id);


      $volunteerDao = new VolunteerDao();
      $volunteerDao->update($volunteer);

      $this->setRoute($this->view->getVolunteerRoute());

      $viewModel = array(
        'volunteers' => $volunteerDao->getAll()
      );

    }
    else
    {
      $this->setRoute($this->view->getUpdateRoute());

      $volunteerDao = new VolunteerDao();

      $viewModel = array(
        'volunteer' => $volunteerDao->getById($id)
      );
    }

    $this->showView($viewModel);

  }

  public function OLDacceptAction(){

    $message = Message::singleton();

    $this->setRoute($this->view->getAcceptRoute());


    $volunteerDao = new VolunteerDao();

    $volunteers = $volunteerDao->getAll();

    $viewModel = array(
      'volunteers' => $volunteers,
    );

    $this->showView($viewModel);

  }

  public function acceptEventAction(){

    $message = Message::singleton();

    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

    if (isset($_REQUEST['id'])) {

      $dao = new VolunteerActivityDao();
      $dao->acceptEvent($id);
      $message->addWarning('Evento Aceito');
      $message->save();
    } else {
      //$message->addWarning('erro ao ignorar evento');
      //$message->save();

    }
    $this->setRoute($this->view->getAcceptRoute());

    $volunteerDao = new VolunteerDao();

    $volunteers = $volunteerDao->getAll();

    $viewModel = array(
      'volunteers' => $volunteers,
    );

    $this->showView($viewModel);

  }

  public function ignoreEventAction(){

    $message = Message::singleton();

    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

    if (isset($_REQUEST['id'])) {

      $dao = new VolunteerActivityDao();
      $dao->ignoreEvent($id);
      $message->addWarning('Evento ignorado');
      $message->save();
    } else {
      //$message->addWarning('erro ao ignorar evento');
      //$message->save();

    }
    $this->setRoute($this->view->getAcceptRoute());

    $volunteerDao = new VolunteerDao();

    $volunteers = $volunteerDao->getAll();

    $viewModel = array(
      'volunteers' => $volunteers,
    );

    $this->showView($viewModel);

  }

}
