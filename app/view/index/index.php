<?php
	$page_title = "Paínel administrativo";
	$page_subject = "Início";

 if ($user->getNivel() == 0) {
	 include "aluno/index.php";
 } else if ($user->getNivel() == 1) {
	 include "professor/index.php";
 } else if ($user->getNivel() == 2) {
	 include "admin/index.php";
 }


 ?>
