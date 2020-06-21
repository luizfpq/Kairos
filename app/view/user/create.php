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
						    <input type="text" name="tipo" class="form-control" id="tipo" name="tipo">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
						    <label for="login">Nível</label>
						    <input type="text" name="login" class="form-control" id="login" name="login">
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
