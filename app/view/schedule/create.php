<?php
$activityDao = new ActivityDao();
$activities = $activityDao->getAll();
$volunteerDao = new VolunteerDao();
$volunteers = $volunteerDao->getAll();
$categoryDao = new ScheduleCategoryDao();
$categories = $categoryDao->getAll();
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-2 sidebar">
			<?php include 'sidebar.php' ?>
		</div>
<!-- Conteudo -->
		<div class="content col-10">
			<form class="container-fluid" action="index.php?controller=Schedule&action=create" method="post">
				<div class="row">
					<div class="col-md-8">
						<h1><i class="far fa-calendar-plus"></i> Novo evento</h1>
						<hr>
						<div class="form-group">
						    <label for="description">Descrição do evento</label>
						    <input type="text" class="form-control" id="description" name="description" placeholder="Fale um pouco sobre o evento">
					  	</div>
					  	<div class="form-group">
						    <label for="schedule_category">Selecione a categoria</label>
						    <select class="form-control" id="schedule_category" name="schedule_category">
									<?php
										 foreach($categories as $category) {
											 echo "<option value='{$category->getId()}'>{$category->getName()}</option>";
										 }
									 ?>
						    </select>
						</div>
					</div>
					<div class="card col">
						<div class="card-header">
							<h5 class="card-title float-left"><i class="far fa-calendar"></i> Data do evento</h5>
						</div>
					  <div class="card-body" data-language='pt-BR'>
							<input type="date" name="date" id="date" class="form-control">
					  </div>
					</div>
				</div>

				<div class="row">
					<div class="col-md">

					<input type="hidden" name="user" value="<?php echo $user->getId(); ?>">
				<div class="row">
					<button type="submit" class="col btn btn-lg btn-primary" name="submit"><i class="far fa-calendar-plus"></i> Novo evento</button>
				</div>
			</form>
		</div>
	</div>
</div>
