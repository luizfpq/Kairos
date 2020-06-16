<div class="container-fluid">
	<div class="row">
		<div class="col-2 sidebar">
			<?php include 'sidebar.php' ?>
		</div>
<!-- Conteudo -->
		<div class="content col-10">
			<form class="container-fluid" action="index.php?controller=Volunteer&action=create" method="post">
				<div class="row">
					<div class="col">
						<h1><i class="fas fa-hands-helping"></i> Novo volunt&aacute;rio</h1>
						<hr>
						<div class="form-group">
						    <label for="name">Nome do volunt&aacute;rio</label>
						    <input type="text" class="form-control" id="username" name="username" placeholder="Nome de usuário">
					  	</div>
					  	<div class="mb-3">
				          <label for="group">Função</label>
				          <select name="role" class="form-control" id="role">
								<option value="2" >Colaborador</option>
								<option value="1" >Organizador</option>
								<option value="0" >Adm</option>
				          </select>
		        		</div>
						<div class="form-group">
						    <label for="email">Email do volunt&aacute;rio</label>
						    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
					  	</div>
						<div class="form-group">
						    <label for="password">Senha</label>
						    <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
					  	</div>
					</div>
				</div>

				<div class="row">
					<button type="submit" class="col volunteers btn btn-lg btn-primary" name="submit"><i class="fas fa-hands-helping"></i> Novo voluntário</button>
				</div>
			</form>
		</div>
	</div>
</div>
