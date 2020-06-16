<?php $page_subject = $_GET['controller']; ?>
<body>
	<!-- Header -->
	<div class="container-fluid header">
		<div class="row topbar">
			<div class="col">
				<div class="brand">
					<a href="index.php?controller=Index&action=index">
						<img src="assets/img/logo-2.png" alt="" width="36" height="36" class="float-left">
						<h3 class="text-left">DOE-SE</h3>
					</a>
				</div>
			</div>
			<div class="col">
				<div class="float-right">
					<a href="#"><i class="fas fa-user-circle"></i> <?php echo "&middot; {$user->getUsername()} &middot;"; ?></a>
					<a href="index.php?controller=Logon&action=logoff"><i class="fa fa-sign-out" aria-hidden="true"></i> <?php echo "Sair"; ?></a>
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
				  	if($page_subject == "Schedule" || $page_subject == "VolunteerActivity")
				    	echo '<a class="nav-link active" href="?controller=Schedule&action=schedule"><i class="fas fa-calendar-check"></i> Eventos</a>';
				    else
				    	echo '<a class="nav-link" href="index.php?controller=Schedule&action=schedule">Eventos</a>';
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
				  	if($page_subject == "Sector")
				    	echo '<a class="nav-link active" href="?controller=Sector&action=sector"><i class="fas fa-chart-pie"></i> Setores</a>';
				    else
				    	echo '<a class="nav-link" href="index.php?controller=Sector&action=sector">Setores</a>';
				    ?>
				  </li>
				  <li class="nav-item">
				    <?php
				  	if($page_subject == "Volunteer")
				    	echo '<a class="nav-link active" href="?controller=Volunteer&action=volunteer"><i class="fas fa-hands-helping"></i> Voluntários</a>';
				    else
				    	echo '<a class="nav-link" href="index.php?controller=Volunteer&action=volunteer">Voluntários</a>';
				    ?>
				  </li>
				</ul>
		    </nav>
		</div>
    </div>
