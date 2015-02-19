<?php
namespace MartKuper\OnePageCRM\Contacts;
 
/**
 * ContactsUrls class
 *
 * Contains a OnePageCRM url
 *
 * @package onepagecrm-php
 * @author Mart Kuper
 * @version 0.2.0
 */
class ContactsUrls {

	/**
	 * The type of url
	 * @var string
	 */
	private $type; 

	/**
	 * The url
	 * @var string
	 */
	private $value;

	/**
	 * Initialize class variables
	 * @param array $data The data to initialize the class with
	 */
	public function __construct($data = null)
	{
		if($data) {
			$this->type  = $data['type'];
			$this->value = $data['value'];	
		}		
	}

	/**
	 * Exports the class variables to an array
	 * @return array Array of class variables
	 */
	public function toArray()
	{
		$keys = [
			'type',
			'value'
		];

		$return = [];

		foreach ($keys as $key) {
			if(!empty($this->$key)) {
				$return[$key] = $this->$key;
			}
		}
		
		return $return;		
	}

	public function getType()
	{
		return $this->type;
	}

	public function getValue()
	{
		return $this->value;
	}

	public function setType($type)
	{
		$this->type = $type;
	}

	public function setValue($value)
	{
		$this->value = $value;
	}
}