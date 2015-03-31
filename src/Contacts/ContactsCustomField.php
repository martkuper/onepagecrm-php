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
class ContactsCustomField {

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
		if(!empty($data)) {
			$this->id = (array_key_exists('custom_field', $data) && array_key_exists('id', $data['custom_field'])) ? $data['custom_field']['id'] : null;
			$this->value = array_key_exists('value', $data) ? $data['value'] : null;	
		}		
	}

	/**
	 * Exports the class variables to an array
	 * @return array Array of class variables
	 */
	public function toArray()
	{
		// $keys = [
		// 	'id',
		// 	'value'
		// ];

		$return = [
			'custom_field' => [
				'id' => $this->id
			],
			'value' => $this->value
		];

		// foreach ($keys as $key) {
		// 	if(!empty($this->$key)) {
		// 		$return[$key] = $this->$key;
		// 	}
		// }
		
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