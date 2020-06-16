<div class="container-fluid">
	<div class="row">
		<div class="col-2 sidebar">
			<?php include 'sidebar.php' ?>
		</div>	
<!-- Conteudo -->
		<div class="content col-10">
			<form class="container-fluid">
				<div class="row">
					<div class="col">
						<h1><i class="fas fa-trash"></i> Remover categoria</h1>
						<hr>
					</div>
				</div>
				<div class="row mb-0">
					<div class="col">
						<div class="form-group">
						    <label for="name">Nome da categoria</label>
						    <input type="text" class="form-control" id="name">
					  	</div>
					</div>
				  	
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
						    <label for="description">Descrição da categoria</label>
						    <input type="text" name="description" class="form-control" id="description">
						</div>
					</div>
				</div>
				
				<div class="row">
					<button type="submit" class="col btn btn-lg btn-danger"><i class="fas fa-trash"></i> Remover categoria</button>
				</div>
			</form>
		</div>
	</div>
</div>