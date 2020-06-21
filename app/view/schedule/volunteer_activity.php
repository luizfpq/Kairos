 <?php
 $activityDao = new ActivityDao();
 $activities = $activityDao->getAll();
 $volunteerDao = new VolunteerDao();
 $volunteers = $volunteerDao->getAll();
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
 			<form class="container-fluid" action="index.php?controller=Schedule&action=create" method="post">
 				<div class="row">
 					<div class="col-md-8">
 						<h1><i class="far fa-calendar-plus"></i> Adicionar voluntários a um evento</h1>
 						<hr>

 					  	<div class="form-group">
 						    <label for="schedule_category">Selecione o evento</label>
 						    <select class="form-control" id="schedule_category" name="schedule_category">
 									<?php
 										 foreach($schedules as $schedule) {
                       var_dump($schedule);
 											 echo "<option value='{$schedule->getId()}'>{$schedule->getDate()} &middot; {$schedule->getDescription()}</option>";
 										 }
 									 ?>

 						    </select>
 						</div>
 					</div>
 				</div>

 				<div class="row">
 					<div class="col-md">
 						<div class="form-group">
 						    <label for="schedule_activities">Selecione as atividades</label>
 						    <select multiple class="form-control" id="schedule_activities" name="schedule_activities[]">
 									<?php

   									 foreach($activities as $activity) {
   										 //verifica o setor e monta a view com a seleção correta
   										// $selected = ($sector->getId() == $activity->getSector()) ? 'selected' : null;
   										 //escreve a option no html
   										 echo "<option value='{$activity->getId()}'>{$activity->getName()}</option>";
   									 }
   								 ?>
 						    </select>
 						</div>
 					</div>

 					<div class="col-md">
 						<div class="form-group">
 						    <label for="schedule_category">Selecione os voluntários</label>
 						    <select class="form-control" id="schedule_volunteers" name="schedule_volunteers[]">
 									<?php

   									 foreach($volunteers as $volunteer) {
   										 //verifica o setor e monta a view com a seleção correta
   										// $selected = ($sector->getId() == $activity->getSector()) ? 'selected' : null;
   										 //escreve a option no html
   										 echo "<option value='{$volunteer->getId()}'>{$volunteer->getUserName()}</option>";
   									 }
   								 ?>
 						    </select>
 						</div>
 					</div>
 				</div>
 					<input type="hidden" name="user" value="<?php echo $user->getId(); ?>">
 				<div class="row">
 					<button type="submit" class="col btn btn-lg btn-primary" name="submit"><i class="far fa-calendar-plus"></i> Novo evento</button>
 				</div>
 			</form>
 		</div>
 	</div>
 </div>
