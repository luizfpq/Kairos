<div class="container-fluid">
	<div class="row">
		<div class="col-2 sidebar">
			<?php include 'sidebar.php' ?>
		</div>
<!-- Conteudo -->
		<div class="content col-10">
			<form class="container action="index.php?controller=User&action=create" method="post">
				<div class="row">
					<div class="col">
						<h1><i class="fa fa-plus"></i> Novo setor</h1>
						<hr>
					</div>
				</div>
				<div class="row mb-0">
					<div class="col">
						<div class="form-group">
						    <label for="name">Nome do setor</label>
						    <input type="text" class="form-control" id="name" name="name">
					  	</div>
					</div>

				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
						    <label for="description">Descrição do setor</label>
						    <input type="text" name="description" class="form-control" id="description" name="description">
						</div>
					</div>
				</div>
				<input type="hidden" name="user" id="user" value="<?php echo $user->getId(); ?>">
				<input type="hidden" name="category" id="user" value="<?php echo $user->getId(); ?>">
				<div class="row">
					<button type="submit" class="col btn btn-lg btn-primary" name="submit"><i class="fa fa-plus"></i> Novo setor</button>
				</div>
			</form>
		</div>
	</div>
</div>
