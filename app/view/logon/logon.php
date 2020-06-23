<html lang="pt-br">
  <head>
	<meta charset="utf-8">
	<?php
	if(isset($_SESSION['user']))
		echo"  <meta http-equiv=\"refresh\" content=\"0; URL='index.php?controller=Index&action=index'\"/>";
	?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="assets/img/logo-2.png">
  	<link href="https://fonts.googleapis.com/css?family=Poppins:100,400,800&display=swap" rel="stylesheet">
	  <script src="https://kit.fontawesome.com/98f672ddda.js" crossorigin="anonymous"></script>
    <title>&middot; Kair&oacute;s &middot;</title>
    <!-- Principal CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/custom-style/signin.css">
  </head>
  <body class="text-center container-fluid">
  	<div class="row h-100">
  		<div class="col-lg-6 form-wrapper">
  			<form class="form-signin" action="index.php?controller=Logon&action=logon" method="post">
	  			<div class="container heading-form">
	  				<div class="row brand">
	  					<div class="col-4 col-lg-5"><img class="mb-4 float-right" src="assets/img/logo-2.png" alt="" width="72" height="72"></div>
	  					<div class="col"><h1 class="text-left">Kair&oacute;s</h1></div>
	  				</div>
	  			</div>
		      <label for="inputEmail" class="sr-only">Endereço de email</label>
		      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Seu email" required autofocus>
		      <label for="inputPassword" class="sr-only">Senha</label>
		      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Senha" required>
		      <div class="checkbox mb-3">
		        <label>
		         <!-- <input type="checkbox" value="remember-me"> Lembrar de mim-->
		        </label>
		      </div>
		      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
		    </form>
  		</div>
  		<div name="hero-img" class="col-lg-6 hero-img" data-toggle="collapse"></div>
  	</div>
    <!-- Image and text -->
	<footer class="pt-4 my-md-5 pt-md-5 border-top">
	<div class="row">
		<div class="col-12 col-md">
			<p class="text-muted w-100">
				<img src="assets\img\logo-mono.png" width="32" style="margin-bottom: 5px;opacity: 0.6"><br>
				Kair&oacute;s &copy; 2020<br>
				<small>Desenvolvido por Lucas Padilha e Luiz Quirino.</small>
			</p>
		</div>
		<div class="col-6 col-md">
			<h5>Tecnologias</h5>
			<ul class="list-unstyled text-small">
				<li><a class="text-muted" href="https://code.visualstudio.com/" target="_blank"><i class="fas fa-code"></i>&nbsp;&nbsp;&nbsp;VSCode</a></li>
				<li><a class="text-muted" href="https://heroku.com" target="_blank"><i class="fa fa-server"></i>&nbsp;&nbsp;&nbsp;Heroku</a></li>
				<li><a class="text-muted" href="https://www.php.net" target="_blank"><i class="fab fa-php"></i>&nbsp;&nbsp;&nbsp;PHP</a></li>
				<li><a class="text-muted" href="https://www.postgresql.org/" target="_blank"><i class="fas fa-database"></i>&nbsp;&nbsp;&nbsp;PostgreSQL</a></li>
				<li><a class="text-muted" href="http://www.sis4.com/brModelo/"><i class="fas fa-table"></i>&nbsp;&nbsp;&nbsp;brModelo</a></li>
				<li><a class="text-muted" href="https://github.com/luizfpq/lebre" target="_blank"><i class="fas fa-table"></i>&nbsp;&nbsp;&nbsp;Lebre</a></li>
			</ul>
		</div>
		<div class="col-6 col-md">
			<h5></h5>
			<ul class="list-unstyled text-small">
				<li><a class="text-muted" href="https://fontawesome.com/" target="_blank"><i class="fa fa-font"></i>&nbsp;&nbsp;&nbsp;Fonte Awesome</a></li>
				<li><a class="text-muted" href="https://marvelapp.com/" target="_blank"><i class="fas fa-layer-group"></i></i>&nbsp;&nbsp;&nbsp;MarvelApp</a></li>
				<li><a class="text-muted" href="https://icons8.com" target="_blank"><i class="fas fa-icons"></i>&nbsp;&nbsp;&nbsp;Icons8</a></li>
				<li><a class="text-muted" href="https://getbootstrap.com/" target="_blank"><i class="fab fa-bootstrap"></i>&nbsp;&nbsp;&nbsp;Bootstrap</a></li>
			</ul>
		</div>
		<div class="col-6 col-md">
			<h5>Sobre o projeto</h5>
			<ul class="list-unstyled text-small">
				<li><a class="text-muted" href="https://trello.com/b/5IWCaqvt/projeto-kair%C3%B3s" target="_blank"><i class="fa fa-trello"></i>&nbsp;&nbsp;&nbsp;Trello</a></li>
				<li><a class="text-muted" href="https://github.com/luizfpq/Kairos" target="_blank" target="_blank"><i class="fa fa-github"></i>&nbsp;&nbsp;&nbsp;Github</a></li>
			</ul>
		</div>
	</div>
</footer>
<!-- Principal JavaScript do Bootstrap
================================================== -->
<!-- Foi colocado no final para a página carregar mais rápido -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/combine/npm/@fullcalendar/core@4.2.0,npm/@fullcalendar/core@4.2.0/locales/pt-br.min.js,npm/@fullcalendar/daygrid@4.2.0"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/datepicker.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/i18n/datepicker.pt-BR.js" type="text/javascript"></script>
</body>
</html>

  </body>
</html>
