
<?php
	$aluno = new AlunoDao();
	$aluno = $aluno->getById($user->getId());
	$alunoAtv = new AlunoAtividadeDao();



 ?>

<div class="container">
	<div class="card-deck mb-3 text-center">
		<!-- -->
		<div class="card mb-4 shadow-sm">
			<div class="card-header alert alert-warning">
				<h4 class="my-0 font-weight-normal">Pendentes</h4>
			</div>
			<div class="card-body">
				<h1 class="card-title pricing-card-title"><?php echo $alunoAtv->getStatus($aluno->getIdAluno(), 1)->getValue(); ?> <small class="text-muted">Horas</small></h1>
			</div>
		</div>
		<!-- -->
		<div class="card mb-4 shadow-sm">
			<div class="card-header alert alert-primary">
				<h4 class="my-0 font-weight-normal">Aprovadas</h4>
			</div>
			<div class="card-body">
				<h1 class="card-title pricing-card-title"><?php echo $alunoAtv->getStatus($aluno->getIdAluno(), 2)->getValue(); ?> <small class="text-muted">Horas</small></h1>
			</div>
		</div>

		<!-- -->
		<div class="card mb-4 shadow-sm">
			<div class="card-header alert alert-danger">
				<h4 class="my-0 font-weight-normal">Reprovadas</h4>
			</div>
			<div class="card-body">
				<h1 class="card-title pricing-card-title"><?php echo $alunoAtv->getStatus($aluno->getIdAluno(), 3)->getValue(); ?> <small class="text-muted">Horas</small></h1>
			</div>
		</div>
	</div>

<?php
	if ($aluno->getSituacao() == 'aprovado') {
				echo"
					<div class=\"card col\">
						<div class=\"card-header alert alert-success\">
							<h5 class=\"card-title my-0 font-weight-normal \">&nbsp;&nbsp;&nbsp;&nbsp;Aluno Aprovado&nbsp;&nbsp;&nbsp;&nbsp;</h4>

						</div>
					</div>";
	} else if ($aluno->getSituacao() == 'reprovado') {
		echo"
			<div class=\"card col\">
				<div class=\"card-header alert alert-danger\">
					<h5 class=\"card-title my-0 font-weight-normal \">&nbsp;&nbsp;&nbsp;&nbsp;Aluno Reprovado&nbsp;&nbsp;&nbsp;&nbsp;</h4>

				</div>
			</div>";
	}

 ?>

	<div class="card col">
		<div class="card-header bg-light">
			<h5 class="card-title my-0 font-weight-normal float-left"><i class="fa fa-tasks"></i>&nbsp;&nbsp;&nbsp;&nbsp; Atividades Pendentes</h4>

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

									$atv = new AtividadeDao();
									$atividades = $atv->getByStatusAlunoId($user->getId(),'pendente');
									foreach($atividades as $atividade) :

							?>

								<tr>
									<td><?php echo $atividade->getDescricao() . "<br /><small>"
									. $atividade->getNome() . "</small>"
									. "<br /><small>" . $atividade->getTipoRegulamento() . "</small>"; ?></td>
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
													<a href="index.php?controller=Atividade&action=Approve&id_atividade=<?php echo $atividade->getIdAtividade() ?>&id_aluno=<?php echo $atividade->getIdAluno() ?>" class="btn btn-sm btn-outline-success" title="Aprovar"><i class="far fa-thumbs-up"></i></i></a>
													<a href="index.php?controller=Atividade&action=Approve&id_atividade=<?php echo $atividade->getIdAtividade() ?>&id_aluno=<?php echo $atividade->getIdAluno() ?>" class="btn btn-sm btn-outline-warning" title="Reprovar"><i class="far fa-thumbs-down"></i></i></a>
											<?php endif; ?>


									</td>
								</tr>

							<?php

							endforeach;

							?>
						</tbody>
					</table>

</div>
