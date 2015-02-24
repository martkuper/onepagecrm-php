<?php
namespace MartKuper\OnePageCRM\Contacts;
 
/**
 * ContactsCustomFields class
 *
 * Contains a OnePageCRM custom field
 *
 * @package onepagecrm-php
 * @author Mart Kuper
 * @version 0.2.0
 */
class ContactsCustomFields {

	/**
	 * Custom field id
	 * @var string
	 */
	private $id;

	/**
	 * Custom field's value
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
			$this->id = $data['custom_field']['id'] ? $data['custom_field']['id'] : null;
			$this->value = $data['value'] ? $data['value'] : null;	
		}		
	}

	/**
	 * Exports the class variables to an array
	 * @return array Array of class variables
	 */
	public function toArray()
	{
		$keys = [
			'id',
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

	public function getId()
	{
		return $this->id;
	}

	public function getValue()
	{
		return $this->value;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setValue($value)
	{
		$this->value = $value;
	}
}