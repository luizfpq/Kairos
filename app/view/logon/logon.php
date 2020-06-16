<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de gestão de horas complementares - Kairós - UFMS">
    <meta name="author" content="Lucas Padilha, Luiz Quirino">
    <title> &middot; Kairós &middot;</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- Bootstrap core CSS -->
<link href="assets/vendors/bootstrap/bootstrap.css" rel="stylesheet">
<link href="assets/custom-style/signin.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="icon" href="assets/img/icon-kairos.png">
    <meta name="theme-color" content="#84CD98">
  </head>
  <body class="text-center">

<img src="assets/img/icon-kairos.png" class="icon-logo">
<p name="logo" class="title-logo">
  &middot; Kair&oacute;s
</p>
<div name="login-img-right" class="div-login-img-right">
  <img src="assets/img/blog-post-amico.png" class="login-img-right">
</div>

  <form class="form-signin" action="index.php?controller=Logon&action=logon" method="post">
  <h1 class="form-signin-title-text">Login</h1>
  <h2 class="form-signin-msg-text">Entre com sua conta</h2>
  <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus>
  <input type="password" id="password" name="password" class="form-control" placeholder="Senha" required>
  <div class="checkbox mb-3">
    <!--<label>
      <input type="checkbox" value="remember-me"> Remember me
    </label> -->
    <br />
  </div>
  <button class="btn btn-lg btn-primary btn-primary-login-text" type="submit">Acessar</button>
  
</form>
</body>
</html>
