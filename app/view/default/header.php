<?php $page_subject = $_GET['controller']; ?>
<body>
	<!-- Header -->
	<div class="container-fluid header">
		<div class="row topbar">
			<div class="col">
				<div class="brand">
					<a href="index.php?controller=Index&action=index">
						<img src="assets/img/logo-2.png" alt="" width="36" height="36" class="float-left">
						<h3 class="text-left">Kair&oacute;s</h3>
					</a>
				</div>
			</div>
			<div class="col">
				<div class="float-right">
					<a href="#"><i class="fas fa-user-circle"></i> <?php echo "Bem vind@, {$user->getLogin()} !"; ?></a>
					<a href="index.php?controller=Logon&action=logoff"><i class="fa fa-window-close" title="Logout"></i> Sair</a>
				</div>


		    </div>
		</div>
		<div class="row">
			<nav class="col">
		      <ul class="nav justify-content-center">
				  <li class="nav-item">
				  	<?php
				  	if($page_subject == "Index" || $page_subject == "Logon")
				    	echo '<a class="nav-link active" href="?controller=Index&action=index"><i class="fas fa-home"></i> Início</a>';
				    else
				    	echo '<a class="nav-link" href="index.php?controller=Index&action=index">Início</a>';
				    ?>
				  </li>
				  
				  <li class="nav-item">
				    <?php
				  	if($page_subject == "Activity")
				    	echo '<a class="nav-link active" href="?controller=Activity&action=activity"><i class="fas fa-tasks"></i> Atividades</a>';
				    else
				    	echo '<a class="nav-link" href="index.php?controller=Activity&action=activity">Atividades</a>';
				    ?>
				  </li>
				 

				  <li class="nav-item">
				    <?php
				  	if($page_subject == "Activity")
				    	echo '<a class="nav-link active" href="?controller=Activity&action=activity"><i class="fas fa-tasks"></i> menu novo</a>';
				    else
				    	echo '<a class="nav-link" href="index.php?controller=Activity&action=activity">menu novo</a>';
				    ?>
				  </li>
				</ul>
		    </nav>
		</div>
    </div>
