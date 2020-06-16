<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="assets/img/logo-2.png">
  	<link href="https://fonts.googleapis.com/css?family=Poppins:100,400,800&display=swap" rel="stylesheet">


    <title>DOE-SE | Identifique-se</title>

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
	  					<div class="col"><h1 class="text-left">DOE-SE</h1></div>
	  				</div>
	  			</div>
		      <label for="inputEmail" class="sr-only">Endereço de email</label>
		      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Seu email" required autofocus>
		      <label for="inputPassword" class="sr-only">Senha</label>
		      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Senha" required>
		      <div class="checkbox mb-3">
		        <label>
		          <input type="checkbox" value="remember-me"> Lembrar de mim
		        </label>
		      </div>
		      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
		      <p class="mt-5 mb-3 text-muted">DOE-SE &copy; 2019</p>
		    </form>
  		</div>
  		<div class="col-lg-6 hero-img"></div>
  	</div>
  </body>
</html>
