<?php
$activityDao = new ActivityDao();
$activities = $activityDao->getAll();

$volunteerDao = new VolunteerDao();
$volunteers = $volunteerDao->getAll();

$categoryDao = new ActivityDao();
$categories = $categoryDao->getAll();

$scheduleDao = new ScheduleDao();
$schedules = $scheduleDao->getAll();
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-2 sidebar">
			<?php include 'sidebar.php' ?>
		</div>
<!-- Conteudo -->
		<div class="content col-10">
			<form class="container-fluid" action="index.php?controller=VolunteerActivity&action=volunteerActivity" method="post">
				<div class="row">
					<div class="col-md-8">
						<h1><i class="far fa-calendar-plus"></i> Voluntário em evento</h1>
						<hr>
						<div class="form-group">
						    <label for="description">Descrição das atividades do voluntário</label>
						    <input type="text" class="form-control" id="description" name="description" placeholder="Descreva como o voluntário irá colaborar">
					  	</div>
						<div class="form-group">
									<label for="schedule_category">Selecione o evento</label>
									<select class="form-control" id="schedule" name="schedule">
										<?php
											 foreach($schedules as $schedule) {
												 echo "<option value='{$schedule->getId()},{$schedule->getDate()}'>{$schedule->getDate()} &middot; {$schedule->getDescription()}</option>";
											 }
										 ?>
									</select>
								</div>
								<div class="form-group">
											<label for="schedule_category">Selecione a atividade</label>
											<select class="form-control" id="activity" name="activity">
												<?php
													 foreach($activities as $activity) {
														 echo "<option value='{$activity->getId()}' tittle='{$activity->getDescription}'>{$activity->getName()}</option>";
													 }
												 ?>
											</select>
										</div>
					<div class="form-group">
						<label for="schedule_category">Selecione o voluntário</label>
						<select class="form-control" id="volunteer" name="volunteer">
							<?php
								 foreach($volunteers as $volunteer) {
									 echo "<option value='{$volunteer->getId()},{$volunteer->getRole()}'>{$volunteer->getUserName()}</option>";
								 }
							 ?>
						</select>
			</div>
			<div class="form-group">
				<label for="schedule_category">Selecione o voluntário</label>
					<input type="time" name="time" id="time" class="form-control">
				</div>
				<div class="row">
					<button type="submit" class="col btn btn-lg btn-primary" name="submit"><i class="far fa-calendar-plus"></i> Novo evento</button>
				</div>
				</div>

				<input type="hidden" name="user" value="<?php echo $user->getId(); ?>">


			</form>
		</div>
	</div>
</div>
