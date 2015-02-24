<?php
namespace MartKuper\OnePageCRM\Contacts;
 
/**
 * ContactsAddressList class
 *
 * Contains a OnePageCRM address
 *
 * @package onepagecrm-php
 * @author Mart Kuper
 * @version 0.2.0
 */
class ContactsAddressList {

	/**
	 * Contact's address
	 * @var string
	 */
	private $address;

	/**
	 * Contact's city
	 * @var string
	 */
	private $city; 

	/**
	 * Contact's state
	 * @var string
	 */
	private $state;

	/**
	 * Contact's zip code
	 * @var string
	 */
	private $zip_code;

	/**
	 * Contact's country as ISO country code
	 * @var string
	 */
	private $country_code;

	/**
	 * Initialize class variables
	 * @param array $data The data to initialize the class with
	 */
	public function __construct($data = null)
	{
		if($data) {
			$this->address      = $data['address'] ? $data['address'] : null;
			$this->city         = $data['city'] ? $data['city'] : null;
			$this->state        = key_exists($data['state']) ? $data['state'] : null;
			$this->zip_code     = $data['zip_code'] ? $data['zip_code'] : null;
			$this->country_code = $data['country_code'] ? $data['country_code'] : null;
		}			
	}

	/**
	 * Exports the class variables to an array
	 * @return array Array of class variables
	 */
	public function toArray()
	{
		$keys = [
			'address',
			'city',
			'state',
			'zip_code',
			'country_code'
		];

		$return = [];

		foreach ($keys as $key) {
			if(!empty($this->$key)) {
				$return[$key] = $this->$key;
			}
		}
		
		return $return;
	}

	public function getAddress()
	{
		return $this->address;
	}

	public function getCity()
	{
		return $this->city;
	}

	public function getState()
	{
		return $this->state;
	}

	public function getZipCode()
	{
		return $this->zip_code;
	}

	public function getCountryCode()
	{
		return $this->country_code;
	}

	public function setAddress($address)
	{
		$this->address = $address;
	}

	public function setCity($city)
	{
		$this->city = $city;
	}

	public function setState($state)
	{
		$this->state = $state;
	}

	public function setZipCode($zip_code)
	{
		$this->zip_code = $zip_code;
	}

	public function setCountryCode($country_code)
	{
		$this->country_code = $country_code;
	}
}