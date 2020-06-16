<div class="container-fluid">
	<div class="row">
		<div class="col-2 sidebar">
			<?php include 'sidebar.php' ?>
		</div>
<!-- Conteudo -->
		<div class="content col-10">
			<form class="container-fluid">
				<div class="row">
					<div class="col-md-8">
						<h1><i class="far fa-calendar-times"></i> Remover evento</h1>
						<hr>
						<div class="form-group">
						    <label for="description">Descrição do evento</label>
						    <input type="text" class="form-control" id="description" name="description" placeholder="Fale um pouco sobre o evento">
					  	</div>
					  	<div class="form-group">
						    <label for="schedule_category">Selecione a categoria</label>
						    <select class="form-control" id="schedule_category" name="schedule_category">
						      <option>Leilão</option>
						      <option>Rotaract</option>
						      <option>Illuminati</option>
						    </select>
						</div>
					</div>
					<div class="card col">
						<div class="card-header">
							<h5 class="card-title float-left"><i class="far fa-calendar"></i> Data do evento</h5>
						</div>
					  <div class="card-body datepicker-here" data-language='pt-BR'>
					  </div>
					</div>
				</div>

				<div class="row">
					<div class="col-md">
						<div class="form-group">
						    <label for="schedule_activities">Selecione as atividades</label>
						    <select multiple class="form-control" id="schedule_activities" name="schedule_activities">
						      <option>Leilão</option>
						      <option>Rotaract</option>
						      <option>Illuminati</option>
						    </select>
						</div>
					</div>

					<div class="col-md">
						<div class="form-group">
						    <label for="schedule_category">Selecione os voluntários</label>
						    <select multiple class="form-control" id="schedule_volunteers" name="schedule_volunteers">
						      <option>Quirino</option>
						      <option>Zé</option>
						      <option>Padoca</option>
						      <option>Fidelis</option>
						    </select>
						</div>
					</div>
				</div>

				<div class="row">
					<button type="submit" class="col btn btn-lg btn-danger" name="submit"><i class="fas fa-trash"></i> Remover evento</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {
	  var calendarEl = document.getElementById('calendar');

	  var calendar = new FullCalendar.Calendar(calendarEl, {
	    plugins: [ 'dayGrid' ],
	    timeZone: 'UTC',
	    defaultView: 'dayGridMonth',
	    events: 'https://fullcalendar.io/demo-events.json'
	  });
	  calendar.setOption('locale', 'pt-br');
	  calendar.render();
	});
</script>
