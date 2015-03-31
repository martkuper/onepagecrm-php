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
class ContactsPhone {

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

	/**
	 * Random ID
	 * @var  string
	 */
	private $id;


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
	public function __construct($data = null)
	{
		$this->id = uniqid();

		if(!empty($data)) {
			if(!in_array($data['type'], $this->supported_types)){
				throw new TypeNotSupportedException($data['type'], 'Expected: ' . implode(", ", $this->supported_types));
			}

			$this->type  = array_key_exists('type', $data) ? $data['type'] : null;
			$this->value = array_key_exists('value', $data) ? $data['value'] : null;	
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

	public function toString($delimiter = null)
	{
		if(empty($delimiter)) {
			$delimiter = ',';
		}
		$to_array = $this->toArray();
		$array = [];

		foreach ($to_array as $key => $value) {
			$array[] = $value;
		}
		return implode($delimiter, $array);
	}

	public function getType()
	{
		return $this->type;
	}

	public function getValue()
	{
		return $this->value;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setType($type)
	{		
		// if(!in_array($this->type, $this->supported_types)){
		// 	throw new TypeNotSupportedException('', implode(", ", $this->supported_types));
		// }

		$this->type = $type;
	}

	public function setValue($value)
	{
		$this->value = $value;
	}
}