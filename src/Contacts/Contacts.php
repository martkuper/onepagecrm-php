<?php
namespace MartKuper\OnePageCRM\Contacts;

use MartKuper\OnePageCRM\OnePageCRM;
use MartKuper\OnePageCRM\Config\Config;
use MartKuper\OnePageCRM\Misc\Misc as Misc;

/**
 * Contacts class
 *
 * Provides an interface for posting a new contact to OnePageCRM
 *
 * @package onepagecrm-php
 * @author Mart Kuper
 * @version 0.2.0
 */
class Contacts extends OnePageCRM {

	/**
	 * Contact's type
	 * @var string
	 */
	private $type;

	/**
	 * Contact's first name
	 * @var string
	 */
	private $first_name;

	/**
	 * Contact's last name
	 * @var string
	 */
	private $last_name;

	/**
	 * Contact's company name
	 * @var string
	 */
	private $company_name;

	/**
	 * Contacts job title
	 * @var string
	 */
	private $job_title;

	/**
	 * Contact's status id
	 * @var string
	 */
	private $status_id;

	/**
	 * Contact's status
	 * @var string
	 */
	private $status;

	/**
	 * Tags attached to a contact
	 * @var array
	 */
	private $tags = [];

	/**
	 * Wheather a contact is starred or not
	 * @var boolean
	 */
	private $starred;

	/**
	 * Contact's owner id
	 * @var string
	 */
	private $owner_id;

	/**
	 * list of addresses
	 * @var array
	 */
	private $address_list = [];

	/**
	 * Contact's description
	 * @var string
	 */
	private $background;

	/**
	 * Contact's lead source id
	 * @var string
	 */
	private $lead_source_id;

	/**
	 * Contact's phones
	 * @var array
	 */
	private $phones = [];

	/**
	 * Contact's email addresses
	 * @var array
	 */
	private $emails = [];

	/**
	 * Contact's URL's
	 * @var array
	 */
	private $urls = [];

	/**
	 * Contact's custom fields
	 * @var array
	 */
	private $custom_fields = [];

	/**
	 * Initializes parent configuration
	 *
	 * TODO: Complete documentation
	 * 
	 * @param Config $config Config object
	 * @param array  $data   Contact data
	 */
	public function __construct(Config $config, array $data = null) 
	{
		parent::__construct($config);
		if($data) {
			$this->fromArray($data); 
		}
	}	

	/**
	 * Implementation of the OnePageCRM class abstract method
	 *
	 * Converts class variables to an array
	 * 
	 * @return array Array of class variables
	 */
	public function toArray()
	{
		$array = [
			'type',
			'first_name',
			'last_name',
			'company_name',
			'job_title',
			'status_id',
			'status',
			'tags',
			'starred',
			'owner_id',
			'address_list',
			'background',
			'leadSource_id',
			'phones',
			'emails',
			'urls',
			'custom_fields',
			'partial'
		];

		$return = [];

		foreach ($array as $key) {
			if(!empty($this->$key)) {
				$return[$key] = $this->$key;
			}
		}

		return $return;
	}

	/**
	 * Sets class variables according to the supplied array
	 * 
	 * @param array $data Array containing class variables
	 */
	private function fromArray(array $data)
	{
		foreach ($data as $key => $value) {
			if(is_array($data[$key])) {
				$object_str = get_class($this) . Misc::snakeCaseToCamelCase($key, true);

				foreach ($value as $key2 => $value2) {
					$object = new $object_str($value2);
					array_push($this->$key, $object);
				}
				
			} else if(isset($data[$key])) {
				$this->$key = $data[$key];
			}
		}		
	}	

	public function getType()
	{
		return $this->type;
	}

	public function getFirstName()
	{
		return $this->first_name;
	}

	public function getLastName()
	{
		return $this->last_name;
	}

	public function getCompanyName()
	{
		return $this->company_name;
	}

	public function getJobTitle()
	{
		return $this->job_title;
	}

	public function getStatusId()
	{
		return $this->status_id;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function getTags()
	{
		return $this->tags;
	}

	public function getStarred()
	{
		return $this->starred;
	}

	public function getOwnerId()
	{
		return $this->owner_id;
	}

	public function getAddressList()
	{
		return $this->address_list;
	}

	public function getBackground()
	{
		return $this->background;
	}

	public function getLeadSourceId()
	{
		return $this->lead_source_id;
	}

	public function getPhones()
	{
		return $this->phones;
	}

	public function getEmails()
	{
		return $this->emails;
	}

	public function getUrls()
	{
		return $this->urls;
	}

	public function getCustomFields()
	{
		return $this->custom_fields;
	}

	public function setType(string $type)
	{
		$this->type = $type;
	}

	public function setFirstName(string $first_name)
	{
		$this->first_name = $first_name;
	}

	public function setLastName(string $last_name)
	{
		$this->last_name = $last_name;
	}

	public function setCompanyName(string $company_name)
	{
		$this->company_name = $company_name;
	}

	public function setJobTitle(string $job_title)
	{
		$this->job_title = $job_title;
	}

	public function setStatusId(string $status_id)
	{
		$this->status_id = $status_id;
	}

	public function setStatus(string $status)
	{
		$this->status = $status;
	}

	public function setTags(array $tags)
	{
		$this->tags = $tags;
	}

	public function setStarred(boolean $starred)
	{
		$this->starred = $starred;
	}

	public function setOwnerId(string $owner_id)
	{
		$this->owner_id = $owner_id;
	}

	public function setAddressList(array $address_list)
	{
		$this->address_list = $address_list;
	}


	public function setBackground(string $background)
	{
		$this->background = $background;
	}

	public function setLeadSourceId(string $lead_source_id)
	{
		$this->lead_source_id = $lead_source_id;
	}

	public function setPhones(array $phones)
	{
		$this->phones = $phones;
	}

	public function setEmails(array $emails)
	{
		$this->emails = $emails;
	}

	public function setUrls(array $urls)
	{
		$this->urls = $urls;
	}

	public function setCustomFields(array $custom_fields)
	{
		$this->custom_fields = $custom_fields;
	}
}
