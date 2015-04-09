<?php
namespace MartKuper\OnePageCRM\Contact;

/**
 * ContactEmail class
 *
 * Contains a OnePageCRM email address
 *
 * @package onepagecrm-php
 * @author Mart Kuper
 * @version 0.5.0
 */
class ContactEmail {

	/**
	 * The type of email
	 * @var string
	 */
	private $type; 

	/**
	 * The email address
	 * @var string
	 */
	private $value;

	/**
	 * Random ID
	 * @var  string
	 */
	private $id;

	/**
	 * Initialize class variables
	 * @param array $data The data to initialize the class with
	 */
	public function __construct($data = null)
	{
		$this->id = uniqid();

		if(!empty($data)) {
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
		$this->type = $type;
	}

	public function setValue($value)
	{
		$this->value = $value;
	}
}