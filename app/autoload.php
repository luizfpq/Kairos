<?php

function __autoload($class)
{
	if(file_exists('src/Controller/'. $class . '.php')) {
		include('src/Controller/'. $class . '.php');
	}


	if(file_exists('src/Model/'. $class . '.php')) {
	include('src/Model/'. $class . '.php');
		}


	if(file_exists('src/View/'. $class . '.php')) {
		include('src/View/'. $class . '.php');
	}


	if(file_exists('common-class/'. $class . '.php')) {
		include('common-class/'. $class . '.php');
	}

}
