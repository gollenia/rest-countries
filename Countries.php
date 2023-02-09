<?php

use Regions;

/*
 * This file is part of the Contexis/GutenbergForm package.
 *
 * (c) 2020 Contexis <https://contexis.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * We want to export this into a microservice later, so we can use it in other projects
 */
class Countries {

	private $region = 'world';
	private $lang = 'en';
	private const AVAILABLE_REGIONS = array('english' => "English", 'europe' => "Europe", 'french' => "French", 'german' => "German", 'spanish' => "Spanish", 'world' => "World", 'africa' => "Africa", 'america' => "America");
	private const AVAILABLE_LANGS = array("br", "pt","nl","hr","fa","de","es","fr","ja","it","hu");

	public function __construct($region, $lang) {
		if (Regions::regionExists($region)) {
			$this->region = $region;
		}
		if(in_array($lang, self::AVAILABLE_LANGS)) {
			$this->lang = $lang;
		}
	}

	public static function get($region, $lang) {
		$instance = new self($region, $lang);
		return $instance->getCountryList();
	}

	public static function getRegions() {
		return self::AVAILABLE_REGIONS;
	}

	public function getCountryList() {
		
		$result = [];

		$countryListFile = dirname(__FILE__) . '/Data/' . $this->region . '.json';
		if(file_exists($countryListFile)) {
			$raw = file_get_contents($countryListFile);
			$jsonList = json_decode($raw, true);
		}
		
		foreach($jsonList as $country) {
			$name = $this->lang != 'en' ? $country['translations'][$this->lang] : $country['name'];
			$result[$country['alpha2Code']] = $name;
		}

		return $result;
		
	}
}
