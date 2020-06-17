<?php
	$page_subject = $_GET['controller'];
?>
<body>
	<!-- Header -->
	<!--
			<div class="col">
				<div class="float-right">
					<a href="#"><i class="fa fa-user-circle"></i> <?php echo "Bem vind@, {$user->getLogin()} !"; ?></a>
					<a href=""> Sair</a>
				</div>
-->

			<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
				<h5 class="my-0 mr-md-auto font-weight-normal">
					<a href="index.php?controller=Index&action=index" style="vertical-align:middle">
						<img src="assets/img/logo-2.png" alt="" width="36" height="36" class="float-left"> &nbsp; Kair&oacute;s
					</a>
				</h5>
				<nav class="my-2 my-md-0 mr-md-3">
					<!--  -->
					<?php
					if($page_subject == "Index" || $page_subject == "Logon")
						echo '<a class="p-2 active" href="?controller=Index&action=index"><i class="fa fa-home"></i> Início</a>';
					else
						echo '<a class="p-2 text-dark" href="index.php?controller=Index&action=index">Início</a>';
					?>
					<!-- -->
					<?php
					if($page_subject == "Schedule")
						echo '<a class="p-2 active" href="index.php?controller=Schedule&action=schedule"><i class="fa fa-tasks"></i> Atividades</a>';
					else
						echo '<a class="p-2 text-dark" href="index.php?controller=Schedule&action=schedule"> Atividades</a>';
					?>

				</nav>
				<a class="p-2 text-dark" href="index.php?controller=Logon&action=logoff"><i class='fa fa-sign-out'></i> Sair</a>
			</div>
