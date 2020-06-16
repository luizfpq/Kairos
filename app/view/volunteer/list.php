<div class="container-fluid">
	<div class="row">
		<div class="col-2 sidebar">
			<?php include 'sidebar.php' ?>
		</div>
<!-- Conteudo -->
		<div class="content col-10">
			<div class="container-fluid">
				<div class="row">
					<div class="col">
						<h1><i class="fas fa-hands-helping"></i> Listagem de usuários</h1>

            <table class="table table-hover table-condensed">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Username</th>
                  <th scope="col">E-mail</th>
                  <th scope="col">Opções</th>
                </tr>
              </thead>
              <tbody>

                <?php
                  foreach($viewModel['volunteers'] as $volunteer) :
                ?>

                  <tr>
                    <th scope="row">&middot;</th>
                    <td><?php echo $volunteer->getUsername() ?></td>
                    <td><?php echo $volunteer->getEmail()?></td>
                    <td>
                    <a href="index.php?controller=Volunteer&action=update&id=<?php echo $volunteer->getId() ?>" class="btn btn-sm activities btn-primary"><i class="fas fa-pen" aria-hidden="true"></i> Editar</a>

                    <a href="index.php?controller=Volunteer&action=delete&id=<?php echo $volunteer->getId() ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash" aria-hidden="true"></i> Remover</a>


                    </td>
                  </tr>

                <?php

                endforeach;

                ?>
              </tbody>
            </table>

						<a href="?controller=Volunteer&action=create" class="btn btn-primary"><i class="far fa-calendar-plus"></i> Novo usuário</a>
					</div>
					<div class="card col">
						<div class="card-header">
							<h5 class="card-title float-left"><i class="fas fa-fire-alt"></i>Seus Próximos evento</h5>
						</div>
					  <div class="card-body">
					    <div class="list-group">
						  <a href="?controller=Volunteer&action=details&id=1" class="list-group-item list-group-item-action">
						    <div class="d-flex w-100 justify-content-between">
						      <h5 class="mb-1">Leilão beneficente</h5>
						      <small>Em 3 dias</small>
						    </div>
						    <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Mauris lacinia, velit in iaculis finibus, lacus mi tempor leo, vitae hendrerit dolor ligula a urna.</p>
						  </a>
						</div>
					  </div>
					  <div class="card-footer">
					  	<span><i class="fas fa-tags"></i> Leilão, Rotaract, Illuminati</span>
					  </div>
					</div>
				</div>

				<div class="row">
					<div class="card resume col col-md-8">
						<div class="card-header">
							<h5 class="card-title float-left"><i class="far fa-calendar"></i> Eventos agendados</h5>
						</div>
						<div class="card-body" id="calendar">

					  	</div>
					</div>

					<div class="card col">
						<div class="card-header">
							<h5 class="card-title float-left"><i class="fas fa-tags"></i> Categorias</h5>
							<a href="?controller=VolunteerCategory&action=list" class="btn btn-sm btn-secondary float-right">
								<small><i class="fas fa-eye"></i> Ver todas</small>
							</a>
						</div>
					  <div class="card-body">
					    <div class="list-group">
						  <a href="#" class="list-group-item list-group-item-action">
						    <div class="d-flex w-100 justify-content-between">
						      <h5 class="mb-1">Leilão</h5>
						      <small>2 evento(s)</small>
						    </div>
						  </a>
						  <a href="#" class="list-group-item list-group-item-action">
						    <div class="d-flex w-100 justify-content-between">
						      <h5 class="mb-1">Rotaract</h5>
						      <small>1 evento(s)</small>
						    </div>
						  </a>
						  <a href="#" class="list-group-item list-group-item-action">
						    <div class="d-flex w-100 justify-content-between">
						      <h5 class="mb-1">Illuminati</h5>
						      <small>7 evento(s)</small>
						    </div>
						  </a>
						</div>
					  </div>
					</div>
				</div>

				</div>
			</div>
		</div>
	</div>
</div>
