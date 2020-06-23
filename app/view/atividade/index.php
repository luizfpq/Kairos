<!-- Conteudo -->
<div class="container container-fluid">
		<div class="card col">
			<div class="card-header bg-light">
				<h5 class="card-title my-0 font-weight-normal float-left"><i class="fa fa-tasks"></i>&nbsp;&nbsp;&nbsp;&nbsp; Atividades</h4>
				<a href="?controller=Atividade&action=create" class="btn btn-sm btn-outline-primary float-right">
					<small><i class="fa fa-plus"></i></small>
				</a>
			</div>
		</div>
		<br />

		<table class="table" id="main_table" class="table table-striped table-bordered " style="width:100%">
						  <thead>
						    <tr>
						      <th scope="col">Descrição</th>
						      <th scope="col">CH Total</th>
						      <th scope="col">CH Aproveitada</th>
									<th scope="col">Status</th>
									<th scope="col">Documento</th>
									<th scope="col">Ações</th>
						    </tr>
						  </thead>
							<tbody>
								<?php
									if ($user->getNivel() >= 1) {
										$atividades = $viewModel['atividades'];
									}
									else {
										$atv = new AtividadeDao();
										$atividades = $atv->getByAlunoId($user->getId());
									}
										foreach($atividades as $atividade) :
								?>

									<tr>
										<td><?php echo $atividade->getDescricao() . "<br /><small>" . $atividade->getNome() . "</small>"; ?></td>
										<td><?php echo $atividade->getCargaHrTotal()?></td>
										<td><?php echo $atividade->getCarHrAproveitada()?></td>
										<td><?php echo $atividade->getStatus()?></td>
										<td style="text-align:center;"><a href="/upload/<?php echo $atividade->getDocumento()?>" class="btn btn-sm btn-outline-dark" title="Visualizar Documento" target="_blank"><i class="far fa-file-alt"></i></a></td>
										<td>
												<a href="index.php?controller=Atividade&action=delete&id_atividade=<?php echo $atividade->getIdAtividade() ?>&id_aluno=<?php echo $atividade->getIdAluno() ?>" class="btn btn-sm btn-outline-danger" title="Apagar"><i class="fa fa-trash"></i></a>
												<?php if ($user->getNivel() >= 1): ?>
														<a href="index.php?controller=Atividade&action=Approve&id_atividade=<?php echo $atividade->getIdAtividade() ?>&id_aluno=<?php echo $atividade->getIdAluno() ?>" class="btn btn-sm btn-outline-success" title="Aprovar"><i class="far fa-thumbs-up"></i></i></a>
												<?php endif; ?>


										</td>
									</tr>

								<?php

								endforeach;

								?>
							</tbody>
						</table>


</div>
