<?php
	$page_title = "Paínel administrativo";
	$page_subject = "Início";
 ?>
<?php //include 'partials/head.php' ?>
<?php //include 'partials/header.php'?>

<div class="container-fluid">
	<div class="row">
		<!--div class="col-md-2 sidebar bg-light">
			<?php //include 'partials/sidebar.php' ?>
		</div-->
<!-- Conteudo -->
		<div class="content col-10 offset-md-1">
			<div class="container-fluid">
				<div class="row">
					<div class="col">
						<h1><i class="fas fa-home"></i> Início</h1>
						<hr>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi porta nulla ut pharetra aliquam. Vivamus auctor vitae metus sed suscipit. Mauris lacinia, velit in iaculis finibus, lacus mi tempor leo, vitae hendrerit dolor ligula a urna.
						</p>
					</div>
					<div class="card col">
						<div class="card-header">
							<h5 class="card-title float-left"><i class="fas fa-calendar-check"></i> Próximos eventos</h5>
							<a href="?controller=Schedule&action=schedule" class="btn btn-sm btn-secondary float-right">
								<small><i class="far fa-calendar-alt"></i> Todos eventos</small>
							</a>
						</div>
					  <div class="card-body">
					    <div class="list-group">
						  <a href="?controller=Schedule&action=details&id=1" class="list-group-item list-group-item-action">
						    <div class="d-flex w-100 justify-content-between">
						      <h5 class="mb-1">Leilão beneficente</h5>
						      <small>Em 3 dias</small>
						    </div>
						    <p class="mb-1">Donec id elit non mi porta gravida at eget metus.</p>
						  </a>
						  <a href="?controller=Schedule&action=details&id=2" class="list-group-item list-group-item-action">
						    <div class="d-flex w-100 justify-content-between">
						      <h5 class="mb-1">Leilão beneficente</h5>
						      <small>Em 3 dias</small>
						    </div>
						    <p class="mb-1">Donec id elit non mi porta gravida at eget metus.</p>
						  </a>
						  <a href="?controller=Schedule&action=details&id=3" class="list-group-item list-group-item-action">
						    <div class="d-flex w-100 justify-content-between">
						      <h5 class="mb-1">Leilão beneficente</h5>
						      <small>Em 3 dias</small>
						    </div>
						    <p class="mb-1">Donec id elit non mi porta gravida at eget metus.</p>
						  </a>
						</div>
					  </div>
					</div>
				</div>

				<div class="row">

					<div class="card activities resume col">
						<a href="?controller=Activity&action=activity">
							<img src="assets\img\activities.jpg" class="card-img-top" alt="...">
						  	<div class="card-body">
					  		<h6><i class="fas fa-tasks"></i> Atividades</h6>
							<p>
								Cadastre, atualize, remova e atribua novas atividades a ONG e aos voluntários.
							</p>
					  	</div>
					  	</a>
					</div>

					<div class="card sectors resume col">
						<a href="?controller=Sector&action=sector">
							<img src="assets\img\sectors.jpg" class="card-img-top" alt="...">
						  	<div class="card-body">
					  		<h6><i class="fas fa-chart-pie"></i> Setores</h6>
							<p>
								Cadastre, atualize, remova e atribua novas atividades a ONG e aos voluntários.
							</p>
					  	</div>
					  	</a>
					</div>

					<div class="card volunteers resume col">
						<a href="?controller=Volunteer&action=volunteer">
							<img src="assets\img\volunteers.jpg" class="card-img-top" alt="...">
						  	<div class="card-body">
					  		<h6><i class="fas fa-hands-helping"></i> Voluntários</h6>
							<p>
								Cadastre, atualize, remova e atribua novas atividades a ONG e aos voluntários.
							</p>
					  	</div>
					  	</a>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>