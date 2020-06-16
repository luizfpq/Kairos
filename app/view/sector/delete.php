<?php $sector =  $viewModel['sector'] ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-2 sidebar">
			<?php include 'sidebar.php' ?>
		</div>
<!-- Conteudo -->
		<div class="content col-10">
			<form class="container-fluid" action="index.php?controller=Sector&action=delete&id=<?php echo $sector->getId(); ?>" method="post">
				<div class="row">
					<div class="col">
						<h1><i class="fas fa-trash"></i> Remover setor</h1>
						<hr>
					</div>
				</div>
				<div class="row mb-0">
					<div class="col">
						<div class="form-group">
						    <label for="name">Nome do setor</label>
						    <input type="text" class="form-control" id="name" name="name" value="<?php echo $sector->getName(); ?>">
					  	</div>
					</div>

				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
						    <label for="description">Descrição do setor</label>
						    <input type="text" name="description" class="form-control" id="description" name="description" value="<?php echo $sector->getDescription(); ?>">
						</div>
					</div>
				</div>

				<div class="row">
						<button type="submit" class="col btn btn-lg btn-danger" name="submit"><i class="fas fa-trash"></i> Remover setor</button>
				</div>
			</form>
		</div>
	</div>
</div>
