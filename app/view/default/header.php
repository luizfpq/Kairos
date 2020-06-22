<?php
	$page_subject = $_GET['controller'];
?>
<body>
	<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">

  <a class="navbar-brand" href="index.php?controller=Index&action=index">
	<img src="assets/img/logo-2.png" alt="" width="36" height="36" class="float-left"> &nbsp; Kair&oacute;s
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>


  <div class="collapse navbar-collapse" id="navbarToggler">
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
      <li class="nav-item">
	  	<?php
			if($page_subject == "Index" || $page_subject == "Logon")
				echo '<a class="nav-link active" href="?controller=Index&action=index"><i class="fa fa-home"></i> Início</a>';
			else
				echo '<a class="nav-link" href="index.php?controller=Index&action=index">Início</a>';
		?>
      </li>
			<li class="nav-item">
	  <?php
			if($page_subject == "User")
				echo '<a class="nav-link active" href="index.php?controller=User&action=user"><i class="fa fa-users"></i> Usuários</a>';
			else
				echo '<a class="nav-link" href="index.php?controller=User&action=user"> Usuários</a>';
		?>
      </li>
      <li class="nav-item">
	  <?php
			if($page_subject == "Atividade")
				echo '<a class="nav-link active" href="index.php?controller=Atividade&action=atividade"><i class="fa fa-tasks"></i> Atividades</a>';
			else
				echo '<a class="nav-link" href="index.php?controller=Atividade&action=atividade"> Atividades</a>';
		?>
      </li>
      <li class="nav-item">
		<a class="nav-link" href="index.php?controller=Logon&action=logoff"><i class='fa fa-sign-out'></i> Sair</a>
      </li>

    </ul>
  </div>
</nav>
