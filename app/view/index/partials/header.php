<body>
	<!-- Header -->
	<div class="container-fluid header">
		<div class="row topbar">
			<div class="col">
				<div class="brand">
					<a href="/ldsoo">
						<img src="assets/img/logo-2.png" alt="" width="36" height="36" class="float-left">
						<h3 class="text-left">DOE-SE</h3>
					</a>
				</div>
			</div>
			<div class="col">
		        <a class="float-right" href="#"><i class="fas fa-user-circle"></i> Quirino</a>
		    </div>
		</div>
		<div class="row">
			<nav class="col">
		      <ul class="nav justify-content-center">
				  <li class="nav-item">
				  	<?php
				  	if($page_subject == "Início")
				    	echo '<a class="nav-link active" href="#"><i class="fas fa-home"></i> Início</a>';
				    else
				    	echo '<a class="nav-link" href="#">Início</a>';
				    ?>
				  </li>
				  <li class="nav-item">
				  	<?php
				  	if($page_subject == "Eventos")
				    	echo '<a class="nav-link active" href="#"><i class="fas fa-calendar-check"></i> Eventos</a>';
				    else
				    	echo '<a class="nav-link" href="#">Eventos</a>';
				    ?>
				  </li>
				  <li class="nav-item">
				    <?php
				  	if($page_subject == "Atividades")
				    	echo '<a class="nav-link active" href="#"><i class="fas fa-tasks"></i> Atividades</a>';
				    else
				    	echo '<a class="nav-link" href="#">Atividades</a>';
				    ?>
				  </li>
				  <li class="nav-item">
				    <?php
				  	if($page_subject == "Setores")
				    	echo '<a class="nav-link active" href="#"><i class="fas fa-chart-pie"></i> Setores</a>';
				    else
				    	echo '<a class="nav-link" href="#">Setores</a>';
				    ?>
				  </li>
				  <li class="nav-item">
				    <?php
				  	if($page_subject == "Voluntários")
				    	echo '<a class="nav-link active" href="#"><i class="fas fa-hands-helping"></i> Voluntários</a>';
				    else
				    	echo '<a class="nav-link" href="index.php?controller=Volunteer&action=index">Voluntários</a>';
				    ?>
				  </li>
				</ul>
		    </nav>
		</div>
    </div>
