<?php

class Localization
{
	static private $localization = FALSE;
	
	private $array = array ();
	
	private final function __construct () { }
	
	static public function singleton ()
	{
		if (self::$localization !== FALSE)
			return self::$localization;
		
		$class = __CLASS__;
		
		self::$localization = new $class ();
		
		return self::$localization;
	}
	
	public function registry ($locale, $key)
	{	
		$this->array[$key] = $locale;
	}

	public function unregistry ($key)
	{	
		unset($this->array[$key]);
	}
	
	public function get ($key)
	{
		return $this->array[$key];	
	}

	public function setCurrentLocale($key)
	{
		foreach ($this->array as $locale) 
		{
			$locale->setCurrentLocale(false);
		}

		$this->array[$key]->setCurrentLocale(true);
	}

	public function getCurrentLocale()
	{
		foreach($this->array as $locale)
			if($locale->getCurrentLocale() == true)
				return $locale;

		return false;
	}

	public function getRegistry()
	{
		return $this->array;
	}

	public function save()
	{
		$_SESSION['localization'] = serialize($this->array);
	}

	public function load()
	{
		if (isset ($_SESSION['localization']))
		{
			$this->array = unserialize($_SESSION['localization']);
		}
	}
}
?>