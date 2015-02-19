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
	public function __construct(array $data = null)
	{
		if($data) {
			$this->address      = $data['address'];
			$this->city         = $data['city'];
			$this->state        = $data['state'];
			$this->zip_code     = $data['zip_code'];
			$this->country_code = $data['country_code'];
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

	public function setAddress(string $address)
	{
		$this->address = $address;
	}

	public function setCity(string $city)
	{
		$this->city = $city;
	}

	public function setState(string $state)
	{
		$this->state = $state;
	}

	public function setZipCode(string $zip_code)
	{
		$this->zip_code = $zip_code;
	}

	public function setCountryCode(string $country_code)
	{
		$this->country_code = $country_code;
	}
}