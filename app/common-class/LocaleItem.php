<?php

class LocaleItem
{
	private $defaultLocale = 'pt_BR';

	private $locale = '';

	private $currentLocale = false;

	const pt_BR = 'pt_BR';

	const en_EN = 'en_EN';

	const es_ES = 'es_ES';

	public function __construct($locale){
		$this->locale = $locale;
	}

	public function setCurrentLocale($bool)
	{
		$this->currentLocale = $bool;
	}

	public function getCurrentLocale()
	{
		return $this->currentLocale;
	}

	public function getLocale()
	{
		return $this->locale;
	}

}