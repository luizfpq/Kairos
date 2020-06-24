<?php

class AtividadeController extends Controller
{
  private $view;

  private $route;

  public function __construct(){

    $this->view = new AtividadeView();
  }

  public function atividadeAction(){

    $message = Message::singleton();

    //$message->addMessage('Listando atividades.');

    //$message->save();

    $this->setRoute($this->view->getAtividadeRoute());

    $atividadeDao = new AtividadeDao();

    $atividades = $atividadeDao->getAll();

    $viewModel = array(
        'atividades' => $atividades,
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
      $descricao = isset($_POST['descricao']) ? $_POST['descricao']: null;
      $carga_hr_total = isset($_POST['carga_hr_total']) ? $_POST['carga_hr_total']: null;



      $id_aluno = isset($_POST['id_aluno']) ? $_POST['id_aluno'] : null;


      $aluno = new AlunoDao();
      $aluno = $aluno->getById($id_aluno);
      if ($aluno)
        $id_aluno = $aluno->getIdAluno();



      $id_regulamento = isset($_POST['id_regulamento']) ? $_POST['id_regulamento'] : null;
      /* @// TODO: upload form */
      //$documento = isset($_POST['documento']) ? $_POST['documento'] : null;
      // realizamos o upload e a variavel documento recebe
      // o nome do documento em caso de sucesso
      $myUpload = new Upload($_FILES["documento"]);
      $documento = $myUpload->makeUpload();

      $data1 = date_create(isset($_POST['data1']) ? $_POST['data1'] : null);
      $data2 = date_create(isset($_POST['data2']) ? $_POST['data2'] : null);
      $intervalo = date_diff($data1, $data2);

      if ($id_regulamento == 28)
        $intervalo = $intervalo->format("%Y");
      if ($id_regulamento == 5)
        $intervalo = $intervalo->format("%a");;
      try
      {
          $warnings = array();

          if(!$descricao)
            $warnings[] = 'Descricao';

          if(!$carga_hr_total)
            $warnings [] = 'Carga Horária';

          if(!$id_aluno)
            $warnings [] = 'Aluno';

          if(!$id_regulamento)
            $warnings [] = 'Tipo de Atividade';

           if(!$documento)
            $warnings [] = 'Upload de arquivo';

          if ($id_regulamento == 5 || $id_regulamento == 28) {
            if(!$data1)
            $warnings [] = 'Data Inicial';
            if(!$data2)
            $warnings [] = 'Data Final';
          }

          if(sizeof($warnings))
            throw new Exception ('Preencha os campos ' . implode(', ', $warnings));




          /*$atividade = AtividadeFactory::factory($identifcationNumber, $type);

          $message->addMessage('O usuário instanciado é do tipo: '. get_class($atividade) );
          */
          $atividade = new Atividade();

          $atividadeDao = new AtividadeDao();

          $atividade->setDescricao($descricao);
          $atividade->setCargaHrTotal($carga_hr_total);
          $atividade->setIdAluno($id_aluno);
          $atividade->setIdRegulamento($id_regulamento);
          $atividade->setDocumento($documento);
          $atividade->setIntervalo($intervalo);





          $atividadeId = $atividadeDao->create($atividade);

          $atividade->setIdAtividade($atividadeId);

           $this->setRoute($this->view->getListRoute());

           $viewModel = array(
             'atividades' => $atividadeDao->getAll()
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
    //limpamos o metodo post
    unset($_POST);
    //$_POST = array();
    // $this->setRoute($this->view->getCreateRoute());
    //
    // $this->showView();

  }

  public function listAction(){

    $message = Message::singleton();

    $message->addMessage('Listando atividades.');

    $message->save();

    $this->setRoute($this->view->getListRoute());

    $atividadeDao = new AtividadeDao();

    $atividades = $atividadeDao->getAll();

    $viewModel = array(
        'atividades' => $atividades,
    );

    $this->showView($viewModel);

    // $this->setRoute($this->view->getListRoute());
    //
    // $this->showView();

  }

  public function deleteAction(){

    $id_atividade = isset($_REQUEST['id_atividade']) ? $_REQUEST['id_atividade'] : null;
    $id_aluno = isset($_REQUEST['id_aluno']) ? $_REQUEST['id_aluno'] : null;

    $atividadeDao = new AtividadeDao();

    $viewModel = false;

    if(isset($_REQUEST['submit']))
    {
      $this->setRoute($this->view->getAtividadeRoute());
      $atividadeDao->delete($id_aluno, $id_atividade);
      $viewModel = array(
          'atividades' => $atividadeDao->getAll()
      );

    }
    else
    {
      $this->setRoute($this->view->getDeleteRoute());

      $viewModel = array(
          'atividade' => $atividadeDao->getById($id_atividade)
      );

    }

    $this->showView($viewModel);

  }
  public function aprovaAction(){

    $id_atividade = isset($_REQUEST['id_atividade']) ? $_REQUEST['id_atividade'] : null;
    $id_aluno = isset($_REQUEST['id_aluno']) ? $_REQUEST['id_aluno'] : null;

    var_dump($id_aluno);
    var_dump($id_atividade);

    $atividadeDao = new AtividadeDao();

    $viewModel = false;

    if(isset($_REQUEST['submit']))
    {
      $this->setRoute($this->view->getAtividadeRoute());
      $atividadeDao->aprova($id_atividade, $id_aluno);
      $viewModel = array(
          'atividades' => $atividadeDao->getAll()
      );

    }
    else
    {
      $this->setRoute($this->view->getAprovaRoute());

      $viewModel = array(
          'atividade' => $atividadeDao->getById($id_atividade)
      );

    }

    $this->showView($viewModel);

  }

  public function reprovaAction(){

    $id_atividade = isset($_REQUEST['id_atividade']) ? $_REQUEST['id_atividade'] : null;
    $id_aluno = isset($_REQUEST['id_aluno']) ? $_REQUEST['id_aluno'] : null;

    $atividadeDao = new AtividadeDao();

    $viewModel = false;

    if(isset($_REQUEST['submit']))
    {
      $this->setRoute($this->view->getAtividadeRoute());
      $atividadeDao->reprova($id_atividade, $id_aluno);
      $viewModel = array(
          'atividades' => $atividadeDao->getAll()
      );

    }
    else
    {
      $this->setRoute($this->view->getReprovaRoute());

      $viewModel = array(
          'atividade' => $atividadeDao->getById($id_atividade)
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



      $atividade = new Atividade();
      $atividade->setSector($sector);
      $atividade->setName($name);
      $atividade->setDescription($description);
      $atividade->setId($id);

      $atividadeDao = new AtividadeDao();
      $atividadeDao->update($atividade);

      $this->setRoute($this->view->getAtividadeRoute());
      $this->showView($viewModel);

      $viewModel = array(
        'atividades' => $atividadeDao->getAll()
      );
      $sectorDao = new SectorDao();
      $viewModel = array(
        'sectors' => $sectorDao->getAll()
      );

    }
    else
    {
      $this->setRoute($this->view->getUpdateRoute());
      $atividadeDao = new AtividadeDao();
      $viewModel = array(
          'atividade' => $atividadeDao->getById($id)
      );
    }

    $this->showView($viewModel);

    // $this->setRoute($this->view->getUpdateRoute());
    //
    // $this->showView();

  }
}
