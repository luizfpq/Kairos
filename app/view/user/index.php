<!-- Conteudo -->
<div class="container container-fluid">
		<div class="card col">
			<div class="card-header bg-light">
				<h5 class="card-title my-0 font-weight-normal float-left"><i class="fa fa-users"></i>&nbsp;&nbsp;&nbsp;&nbsp; Usuários</h4>
				<a href="?controller=User&action=create" class="btn btn-sm btn-outline-primary float-right">
					<small><i class="fa fa-plus"></i></small>
				</a>
			</div>
		</div>
		<br />
			
		<table class="table" id="main_table" class="table table-striped table-bordered " style="width:100%">
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
										<a href="index.php?controller=User&action=update&id=<?php echo $user->getId() ?>" class="btn btn-sm btn-outline-info" title="Editar"><i class="fa fa-pen"></i></a>

										<a href="index.php?controller=User&action=delete&id=<?php echo $user->getId() ?>" class="btn btn-sm btn-outline-danger" title="Apagar"><i class="fa fa-trash"></i></a>


										</td>
									</tr>

								<?php

								endforeach;

								?>
							</tbody>
						</table>


</div>