<?php


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
class Regions {

	private $lang = 'en';
	private const AVAILABLE_LANGS = array("br", "pt","nl","hr","fa","de","es","fr","ja","it","hu");
	private array $regions = [];

	public function __construct($lang) {
		if(in_array($lang, self::AVAILABLE_LANGS)) {
			$this->lang = $lang;
		}
		$this->regions = $this->getRegionList();
	}

	public static function get($lang) {
		$instance = new self($lang);
		return $instance->regions;
	}

	public static function regionExists($region) {
		$instance = new self('en');
		return array_key_exists($region, $instance->regions);
	}

	public function getRegionList() {
		
		$result = [];

		$regionsListFile = dirname(__FILE__) . '/Data/_regions.json';
		if(!file_exists($regionsListFile)) return [];

		$raw = file_get_contents($regionsListFile);
		$jsonList = json_decode($raw, true);
		
		foreach($jsonList as $key => $country) {
		
			$name = $this->lang != 'en' ? $country['translations'][$this->lang] : $country['name'];
			$result[$key] = $name;
		}

		return $result;
		
	}
}
