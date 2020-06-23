<div class="container container-fluid">
		<div class="card col">
			<div class="card-header bg-light">
				<h5 class="card-title my-0 font-weight-normal float-left"><small><i class="fa fa-plus"></i></small> Novo usuário</h4>
			</div>
		</div>
<!-- Conteudo -->
		<div class="content col-10">
			<form class="container" action="index.php?controller=User&action=create" method="post">
				<div class="row mb-0">
					<div class="col">
						<div class="form-group">
						    <label for="nome">Nome completo</label>
						    <input type="text" class="form-control" id="nome" name="nome">
					  	</div>
					</div>
				</div>
				<div class="row mb-0">
					<div class="col">
						<div class="form-group">
						    <label for="login" title="Use um nome curto pelo qual será identificado na interface do sistema">Login</label>
						    <input type="text" class="form-control" id="login" name="login">
					  	</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
						    <label for="senha">Senha</label>
						    <input type="password" name="senha" class="form-control" id="senha" name="senha">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
						    <label for="email">Email</label>
						    <input type="email" name="email" class="form-control" id="email" name="email">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
						    <label for="tipo">Tipo</label>
						    <select name="tipo" id="tipo" class="form-control">
								<option value="aluno">Aluno</option> 
								<option value="professor">Professor</option>
							</select>	
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
						    <label for="nivel">Nível</label>
						    <select name="nivel" id="nivel" class="form-control">
								<option value="0">Usuário</option> 
								<option value="1">Professor</option>
								<option value="2">Administrador</option>
							</select>	
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
						    <label for="identificador">Identificador numérico (RGA / SIAPE)</label>
						    <input type="text" name="identificador" class="form-control" id="identificador"> 
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
