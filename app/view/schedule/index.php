<div class="container-fluid">
	<div class="row">
		<div class="col-2 sidebar">
			<?php include 'sidebar.php' ?>
		</div>
<!-- Conteudo -->
		<div class="content col-10">
			<div class="container-fluid">
				<div class="row">
					<div class="col">
						<h1><i class="fas fa-calendar-check"></i> Eventos</h1>
						<hr>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi porta nulla ut pharetra aliquam. Vivamus auctor vitae metus sed suscipit. Mauris lacinia, velit in iaculis finibus, lacus mi tempor leo, vitae hendrerit dolor ligula a urna.
						</p>
						<a href="?controller=Schedule&action=create" class="btn btn-primary"><i class="far fa-calendar-plus"></i> Novo evento</a>
					</div>

				</div>

				<div class="row">
					<div class="card resume col col-md-8">
						<div class="card-header">
							<h5 class="card-title float-left"><i class="far fa-calendar"></i> Eventos agendados</h5>
						</div>
						<div class="card-body" id="calendar">

					  	</div>
					</div>



					</div>
				</div>

				</div>
			</div>
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
	    events: 'index.php?controller=Schedule&action=listCalendar'
	  });
	  calendar.setOption('locale', 'pt-br');
	  calendar.render();
	});
</script>
