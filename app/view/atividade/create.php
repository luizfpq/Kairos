<div class="container container-fluid">
		<div class="card col">
			<div class="card-header bg-light">
				<h5 class="card-title my-0 font-weight-normal float-left"><small><i class="fa fa-plus"></i></small> Nova atividade</h4>
					<a href="?controller=Atividade&action=atividade" class="btn btn-sm btn-outline-primary float-right">
						<small><i class="fas fa-arrow-left" title="Voltar"></i></small>
					</a>
			</div>
		</div>
<!-- Conteudo -->
		<div class="content col-10">
			<form class="container" action="index.php?controller=Atividade&action=create" method="post" enctype="multipart/form-data">
				<div class="row mb-0">
					<div class="col">
						<div class="form-group">
						    <label for="descricao">Descrição da atividade</label>
						    <input type="text" class="form-control" id="descricao" name="descricao">
					  	</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
						    <label for="carga_hr_total">Carga Horária</label>
						    <input type="text" name="carga_hr_total" class="form-control" id="carga_hr_total">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="custom-file">
  							<input type="file" class="custom-file-input" id="documento" name="documento">
  							<label class="custom-file-label" for="documento">Selecionar</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
						    <label for="id_aluno">Aluno</label>
							<select class="form-control" id="id_aluno" name="id_aluno">
						    <?php
								if ($user->getNivel() >= 1){
									$usu = new AlunoDao();
									$usuarios = $usu->getAll();
									foreach($usuarios as $usuario) :
										echo "<option value='{$usuario->getIdUsuario()}'>{$usuario->getNome()}</option>";
									endforeach;
								} else {
									echo "<option value='{$user->getId()}'>{$user->getNome()}</option>";
								}
							?>
						</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
						    <label for="id_regulamento">Tipo de Atividade</label>
						    <select class="form-control" id="id_regulamento" name="id_regulamento">
								<?php
									$reg = new RegulamentoDao();
									$regulamentos = $reg->getAll();
									foreach($regulamentos as $regulamento) :
										echo "<option value='{$regulamento->getIdRegulamento()}'>{$regulamento->getTipo()}</option>";
									endforeach;
								?>
						    </select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
						    <label for="id_regulamento">Data Inicial do evento/atividade</label>
						    <input type="date" name="data1" class="form-control" id="data1">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
						    <label for="id_regulamento">Data Final do evento/atividade</label>
						    <input type="date" name="data2" class="form-control" id="data2">
						</div>
					</div>
				</div>


				<input type="hidden" name="user" id="user" value="<?php echo $user->getId(); ?>">
				<input type="hidden" name="category" id="user" value="<?php echo $user->getId(); ?>">
				<div class="row">
					<button type="submit" class="col btn btn-lg btn-primary" name="submit">Confirmar</button>
				</div>
			</form>
		</div>
	</div>
</div>
