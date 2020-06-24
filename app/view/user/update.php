<div class="container container-fluid">
		<div class="card col">
			<div class="card-header bg-light">
				<h5 class="card-title my-0 font-weight-normal float-left"><small><i class="fa fa-plus"></i></small> Atualizar usuário</h4>
					<a href="?controller=User&action=user" class="btn btn-sm btn-outline-primary float-right">
						<small><i class="fas fa-arrow-left" title="Voltar"></i></small>
					</a>
			</div>
		</div>
<!-- Conteudo -->

<?php
	$usuario = new UserDao();
	$usuario = $usuario->getById($_GET['id']);
 ?>

		<div class="content col-10">
			<form class="container" action="index.php?controller=User&action=update&id_usuario=<?php echo $usuario->getId();?>" method="post">
				<div class="row mb-0">
					<div class="col">
						<div class="form-group">
						    <label for="nome">Nome completo</label>
						    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $usuario->getNome();?>">
					  	</div>
					</div>
				</div>
				<div class="row mb-0">
					<div class="col">
						<div class="form-group">
						    <label for="login" title="Use um nome curto pelo qual será identificado na interface do sistema">Login</label>
						    <input type="text" class="form-control" id="login" name="login" value="<?php echo $usuario->getLogin();?>">
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
						    <input type="email" name="email" class="form-control" id="email" name="email" value="<?php echo $usuario->getEmail();?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
						    <label for="nivel">Nível</label>
						    <select name="nivel" id="nivel" class="form-control">
								<option value="0" <?php echo ($usuario->getNivel() == 0) ? "selected" : null;?>>Usuário</option>
								<option value="1" <?php echo ($usuario->getNivel() == 1) ? "selected" : null;?>>Professor</option>
								<option value="2" <?php echo ($usuario->getNivel() == 2) ? "selected" : null;?>>Administrador</option>
							</select>
						</div>
					</div>
				</div>
				<input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $usuario->getId(); ?>">
				<input type="hidden" name="user" id="user" value="<?php echo $user->getId(); ?>">
				<input type="hidden" name="category" id="user" value="<?php echo $user->getId(); ?>">
				<div class="row">
					<button type="submit" class="col btn btn-lg btn-primary" name="submit">Confirmar</button>
				</div>
			</form>
		</div>
	</div>
</div>
