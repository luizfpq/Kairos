<div class="container-fluid">
	<div class="row">
		<div class="col-2 sidebar">
			<?php include 'sidebar.php' ?>
		</div>
<!-- Conteudo -->
		<div class="content col-10">
				<div class="row">
					<div class="card resume col">

						<table class="table">
						  <thead>
						    <tr>
						      <th scope="col">Nome</th>
						      <th scope="col">Email</th>
						      <th scope="col">Ações</th>
						    </tr>
						  </thead>
							<tbody>
								<?php

									foreach($viewModel['users'] as $user) :

								?>

									<tr>
										<td><?php echo $user->getNome() ?></td>
										<td><?php echo $user->getEmail()?></td>
										<td>
										<a href="index.php?controller=User&action=update&id=<?php echo $user->getId() ?>" class="btn btn-sm sectors btn-primary"><i class="fa fa-pen"></i> Editar</a>

										<a href="index.php?controller=User&action=delete&id=<?php echo $user->getId() ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Remover</a>


										</td>
									</tr>

								<?php

								endforeach;

								?>
							</tbody>
						</table>

					</div>
				</div>

				</div>
			</div>
		</div>
