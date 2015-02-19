<?php
namespace MartKuper\OnePageCRM\Contacts;

use MartKuper\OnePageCRM\Exceptions\TypeNotSupportedException;

/**
 * ContactsPhones class
 *
 * Contains a OnePageCRM phone number
 *
 * @package onepagecrm-php
 * @author Mart Kuper
 * @version 0.2.0
 */
class ContactsPhones {

	/**
	 * The type of phone number
	 * @var string
	 */
	private $type; 

	/**
	 * The phone number
	 * @var string
	 */
	private $value;


	private $supported_types = [
		'work',
		'mobile',
		'home',
		'direct',
		'fax',
		'skype',
		'other'
	];

	/**
	 * Initialize class variables
	 * @param array $data The data to initialize the class with
	 */
	public function __construct(array $data = null)
	{
		if($data) {
			if(!in_array($type, $this->supported_types)){
				throw new TypeNotSupportedException('', implode(", ", $this->supported_types));
			}

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
			if(!empty($this->key)) {
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

	public function setType(string $type)
	{		
		if(!in_array($type, $this->supported_types)){
			throw new TypeNotSupportedException('', implode(", ", $this->supported_types));
		}

		$this->type = $type;
	}

	public function setValue(string $value)
	{
		$this->value = $value;
	}
}