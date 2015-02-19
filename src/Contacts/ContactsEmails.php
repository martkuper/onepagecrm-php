<?php
namespace MartKuper\OnePageCRM\Contacts;

/**
 * ContactsEmails class
 *
 * Contains a OnePageCRM email address
 *
 * @package onepagecrm-php
 * @author Mart Kuper
 * @version 0.2.0
 */
class ContactsEmails {

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
	 * Initialize class variables
	 * @param array $data The data to initialize the class with
	 */
	public function __construct(array $data = null)
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
		$this->type = $type;
	}

	public function setValue(string $value)
	{
		$this->value = $value;
	}
}