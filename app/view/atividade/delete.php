<?php
	$atividade =  $viewModel['atividade'];
	$atividadeDao = new AtividadeDao();
	$atividades = $atividadeDao->getAll();
?>


<div class="container-fluid">
<!-- Conteudo -->
		<div class="content col-10">
			<form class="container-fluid" action="index.php?controller=Atividade&action=delete&id_atividade=<?php echo $atividade->getIdAtividade(); ?>&id_aluno=<?php echo $atividade->getIdAluno() ?>" method="post">
				<div class="row">
					<div class="col">
						<h1><i class="fa fa-trash"></i> Remover atividade</h1>
						<a href="?controller=Atividade&action=atividade" class="btn btn-sm btn-outline-primary float-right">
							<small><i class="fas fa-arrow-left" title="Voltar"></i></small>
						</a>
						<hr>
					</div>
				</div>
				<div class="row mb-0">
					<div class="col-md-8 col">
						<div class="form-group">
						    <label for="descricao">Nome da atividade</label>
						    <input type="text" class="form-control" id="descricao" name="descricao" value="<?php echo $atividade->getDescricao(); ?>">
					  	</div>
					</div>

				</div>

				<div class="row">
					<button type="submit" class="col activities btn btn-lg btn-danger" name="submit"><i class="fa fa-trash"></i> Remover atividade</button>
				</div>
			</form>
		</div>
	</div>
</div>
