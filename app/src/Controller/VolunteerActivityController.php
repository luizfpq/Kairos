<?php

class VolunteerActivityController extends Controller
{
  private $view;

  private $route;

  public function __construct(){

    $this->view = new VolunteerActivityView();
  }

  public function volunteerActivityAction(){

    $message = Message::singleton();

    $viewModel = false;

    if(isset($_REQUEST['submit']))
    {
      $user = isset($_POST['user']) ? $_POST['user'] : null;
      $activity = isset($_POST['activity']) ? $_POST['activity'] : null;
      $time = isset($_POST['time']) ? $_POST['time'] : null;
      $volunteer = isset($_POST['volunteer']) ? $_POST['volunteer'] : null;
      $volunteer = explode(',', $volunteer);
      $sector = $volunteer[1];
      $volunteer = $volunteer[0];
      $description = isset($_POST['description']) ? $_POST['description'] : null;
      $schedule = isset($_POST['schedule']) ? $_POST['schedule'] : null;
      $schedule = explode(',', $schedule);
      $date = $schedule[1];
      $schedule = $schedule[0];


      try
      {
          $warnings = array();

        /*  if(!$date)
            $warnings[] = 'Data';*/


          if(sizeof($warnings))
            throw new Exception ('Preencha os campos ' . implode(', ', $warnings));

          $volunteerActivity = new VolunteerActivity();

          $volunteerActivityDao = new VolunteerActivityDao();

          $volunteerActivity->setUser($user);
          $volunteerActivity->setActivity($activity);
          $volunteerActivity->setTime($time);
          $volunteerActivity->setSector($sector);
          $volunteerActivity->setVolunteer($volunteer);
          $volunteerActivity->setDate($date);
          $volunteerActivity->setDescription($description);
          $volunteerActivity->setSchedule($schedule);


          $volunteerActivityId = $volunteerActivityDao->create($volunteerActivity);
          $volunteerActivity->setId($volunteerActivityId);

          $this->setRoute($this->view->getVolunteerActivityRoute());


          $viewModel = array(
             'volunteers' => $volunteerActivityDao->getAll()
           );

           $message->addMessage('Evento adicionado com sucesso.');
      }
      catch(Exception $e)
      {
        if (strpos($e->getMessage(), 'Unique violation')){
          $message->addWarning("Voluntário já participa de outro evento nesta data e horário!");
        } else {
          $message->addWarning(var_dump($e->getMessage()));

        }
        $this->setRoute($this->view->getVolunteerActivityRoute());
      }
    }
    else
    {
       $this->setRoute($this->view->getVolunteerActivityRoute());
    }
    $message->save();
    $this->showView($viewModel);

  }
}
