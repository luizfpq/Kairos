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
						      <th scope="col">Atividade</th>
						      <th scope="col">Resumo</th>
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
										<td><?php echo $atividade->getDescricao() . "<br /><small>"
										 . $atividade->getNome() . "</small><br />"
										  . "<small>" .$atividade->getTipoRegulamento() . "</small>" ;?></td>
										<td>
											<?php
											 	echo "<small>Total:</small> ". $atividade->getCargaHrTotal() . "<br />" .
												 "<small>Aproveitada:</small> " . $atividade->getCarHrAproveitada() . "<br />" .
												 "<small>Status:</small> " .$atividade->getStatus();
											?>
										</td>
										<td>
											<a href="<?php echo "upload/" . $atividade->getDocumento()?>" class="btn btn-sm btn-outline-dark" title="Visualizar Documento" target="_blank"><i class="far fa-file-alt"></i></a>
												<a href="index.php?controller=Atividade&action=delete&id_atividade=<?php echo $atividade->getIdAtividade() ?>&id_aluno=<?php echo $atividade->getIdAluno() ?>" class="btn btn-sm btn-outline-danger" title="Apagar"><i class="fa fa-trash"></i></a>
												<?php if ($user->getNivel() >= 1): ?>
														<a href="index.php?controller=Atividade&action=aprova&id_atividade=<?php echo $atividade->getIdAtividade() ?>" class="btn btn-sm btn-outline-success" title="Aprovar"><i class="far fa-thumbs-up"></i></i></a>
														<a href="index.php?controller=Atividade&action=reprova&id_atividade=<?php echo $atividade->getIdAtividade() ?>" class="btn btn-sm btn-outline-warning" title="Reprovar"><i class="far fa-thumbs-down"></i></i></a>
												<?php endif; ?>


										</td>
									</tr>

								<?php

								endforeach;

								?>
							</tbody>
						</table>


</div>
