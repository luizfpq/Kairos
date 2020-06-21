<div class="container-fluid">
	<div class="row">
		<div class="col-2 sidebar">
			<?php include 'sidebar.php' ?>
		</div>
<!-- Conteudo -->
		<div class="content col-10">
			<div class="container-fluid">
				<div class="row mb-0">
					<div class="col">
						<h1 class="float-left"><i class="fa fa-tags"></i> categorias</h1>
						<a href="?controller=Category&action=create" class="float-right btn btn-primary activities" style="border:none"><i class="fa fa-plus"></i> Nova categoria</a>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<hr>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi porta nulla ut pharetra aliquam. Vivamus auctor vitae metus sed suscipit. Mauris lacinia, velit in iaculis finibus, lacus mi tempor leo, vitae hendrerit dolor ligula a urna.
						</p>
					</div>
				</div>

				<div class="row">
					<div class="card resume col">

						<table class="table">
						  <thead>
						    <tr>
						      <th scope="col">Nome</th>
						      <th scope="col">Descrição</th>
						      <th scope="col">Ações</th>
						    </tr>
						  </thead>
							<tbody>
								<?php

									foreach($viewModel['categories'] as $category) :

								?>

									<tr>
										<td><?php echo $activity->getName() ?></td>
										<td><?php echo $activity->getDescription()?></td>
										<td><?php echo $activity->getSector()?></td>
										<td>
										<a href="index.php?controller=Categoryy&action=update&id=<?php echo $category->getId() ?>" class="btn btn-sm activities btn-primary"><i class="fa fa-pen"></i> Editar</a>

										<a href="index.php?controller=Categoryy&action=delete&id=<?php echo $category->getId() ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Remover</a>


										</td>
									</tr>

								<?php

								endforeach;

								?>
							</tbody>
					
						</table>

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
	    events: 'https://fullcalendar.io/demo-events.json'
	  });
	  calendar.setOption('locale', 'pt-br');
	  calendar.render();
	});
</script>
