<?php

class Translate
{
	static private $translate = FALSE;

	static $language = 'en_EN';

	private $pack;
	
	private final function __construct ()
	{
		
		$localization = Localization::singleton();

		$localization->load();

		self::$language = $localization->getCurrentLocale()->getLocale();

		if(self::$language  == 'en_EN')
			return;
		
		$file = BASE_PATH . DIRECTORY_SEPARATOR .'i18n'. DIRECTORY_SEPARATOR . self::$language . DIRECTORY_SEPARATOR . self::$language .'.xml';

		$xml = new Xml ($file);

		$aux = $xml->getArray ();

		$aFile = array ();

		foreach ($aux ['i18n'][0]['message'] as $trash => $message)
		{
			if (!is_array ($message) || !array_key_exists ('from', $message) || !array_key_exists ('to', $message))
				continue;

			$aFile [$message ['from']] = $message ['to'];
		}

		$this->pack = $aFile;

	}
	
	static public function singleton ()
	{
		if (self::$translate !== FALSE)
			return self::$translate;
		
		$class = __CLASS__;
		
		self::$translate = new $class ();
		
		return self::$translate;
	}


	public function translate($text, $array = false)
	{

		if(self::$language == 'en_EN')
			$text =  $this->bindTranslate($text, $array);
		else
			$text = $this->bindTranslate($this->pack[$text], $array);

		return $text;	
	}

	public function bindTranslate($text, $array = false)
	{
		if($array)
		{
			foreach($array as $key => $value)
			{
				$text = str_replace('['.$key.']', $value, $text);
			}
		}
		return $text;
	}
	/*
	public function getLanguage()
	{
		return $language;
	}

	public function setLanguage($language)
	{
		$this->language = $language;
	}
	*/
}
?>