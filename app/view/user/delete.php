<?php $user =  $viewModel['user'] ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-2 sidebar">
			<?php include 'sidebar.php' ?>
		</div>
<!-- Conteudo -->
		<div class="content col-10">
			<form class="container-fluid" action="index.php?controller=User&action=delete&id=<?php echo $user->getId(); ?>" method="post">
				<div class="row">
					<div class="col">
						<h1><i class="fa fa-trash"></i> Remover setor</h1>
						<hr>
					</div>
				</div>
				<div class="row mb-0">
					<div class="col">
						<div class="form-group">
						    <label for="name">Nome do setor</label>
						    <input type="text" class="form-control" id="name" name="name" value="<?php echo $user->getNome(); ?>">
					  	</div>
					</div>

				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
						    <label for="description">Descrição do setor</label>
						    <input type="text" name="description" class="form-control" id="description" name="description" value="<?php echo $user->getEmail(); ?>">
						</div>
					</div>
				</div>

				<div class="row">
						<button type="submit" class="col btn btn-lg btn-danger" name="submit"><i class="fa fa-trash"></i> Remover setor</button>
				</div>
			</form>
		</div>
	</div>
</div>
