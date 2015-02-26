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
	 * User id returned from OnePageCRM
	 * @var string
	 */
	private $user_id;

	/**
	 * Wheather the request is partial or not
	 * @var integer
	 */
	private $partial;

	/**
	 * Options to add to the GET request query
	 * @var array
	 */
	private $get_options = [
		'sparse=1'
	];

	/**
	 * Options to add to the PUT request
	 * @var array
	 */
	private $put_options = [
		'partial' => 1 
	];

	/**
	 * Sub URL (including trailing slash) to receive data from
	 * @var string
	 */
	private $sub_url = 'contacts/';

	/**
	 * Format in which to receive data.
	 * Only JSON supported
	 * @var string
	 */
	private $data_format = 'json';

	/**
	 * Initializes parent configuration 
	 * and if data array is passed, initializes class variables
	 * 
	 * @param Config $config Config object
	 * @param array  $data   Contact data
	 */
	public function __construct(Config $config, $data = null)
	{
		parent::__construct($config);
		if(!empty($data)) {
			$this->fromArray($data);
		}
	}

	/**
	 * Get a user from OnePageCRM by it's ID
	 * If no $id is given, nothing will happen 
	 * @param  string $id The contact id to get
	 * @return Response GuzzleHttp response object
	 */
	public function getId($id)
	{
		$this->user_id = $id;

		if(empty($id)) {
			return;
		}

		$get_options = implode('&', $this->get_options);
		$response = parent::get($this->sub_url . $id . '.' . $this->data_format . '?' . $get_options);
		$this->fromArray($response->json()['data']['contact']);		
		return $response;
	}


	/**
	 * Update this class to OnePageCRM
	 * If no user_id is set in the class, nothing will happen
	 * @return Response GuzzleHttp response object
	 */
	public function update() 
	{
		$id = $this->user_id;

		if(empty($id)) {
			return;
		}

		$body = array_merge($this->put_options, $this->toArray());
		$response = parent::put($this->sub_url . $id . '.' . $this->data_format ,$body);
		$this->fromArray($response->json()['data']['contact']);	
		return $response;
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
				if(is_array($this->$key)) {
					foreach($this->$key as $object) {
						if(is_object($object) && !empty($object->toArray())) {
							$return[$key][] = $object->toArray();	
						}						
					}
				} else {
					$return[$key] = $this->$key;	
				}
				
			}
		}

		if(empty($this->last_name)) {
			$return['last_name'] = "-";
		}

		return $return;
	}

	/**
	 * Sets class variables according to the supplied array
	 * 
	 * @param array $data Array containing class variables
	 */
	public function fromArray($data)
	{
		foreach ($data as $key => $value) {
			if(is_array($data[$key]) && !empty($data[$key])) {
				$object_str = get_class($this) . Misc::snakeCaseToCamelCase($key, true);

				foreach ($value as $key2 => $value2) {
					$object = new $object_str($value2);
					array_push($this->$key, $object);
				}
				
			} else if(isset($data[$key]) && !empty($data[$key])) {
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

	public function getPartial()
	{
		return $this->partial;
	}

	public function getUserId()
    {
        return $this->user_id;
    }

	public function setType($type)
	{
		$this->type = $type;
	}

	public function setFirstName($first_name)
	{
		$this->first_name = $first_name;
	}

	public function setLastName($last_name)
	{
		$this->last_name = $last_name;
	}

	public function setCompanyName($company_name)
	{
		$this->company_name = $company_name;
	}

	public function setJobTitle($job_title)
	{
		$this->job_title = $job_title;
	}

	public function setStatusId($status_id)
	{
		$this->status_id = $status_id;
	}

	public function setStatus($status)
	{
		$this->status = $status;
	}

	public function setTags($tags)
	{
		$this->tags = $tags;
	}

	public function setStarred($starred)
	{
		$this->starred = $starred;
	}

	public function setOwnerId($owner_id)
	{
		$this->owner_id = $owner_id;
	}

	public function addContactsAddressList($address_list)
	{
		if(is_object($address_list) && (!empty($address_list->getAddress()) || !empty($address_list->getCity()) || !empty($address_list->getState()) || !empty($address_list->getZipCode()) || !empty($address_list->getCountryCode()))){
			// Index 0, because only 1 address is allowed in onepagecrm
			$this->address_list[0] = $address_list;
		}
	}


	public function setBackground($background)
	{
		$this->background = $background;
	}

	public function setLeadSourceId($lead_source_id)
	{
		$this->lead_source_id = $lead_source_id;
	}

	public function addContactsPhones($phones)
	{
		if(is_object($phones) && !empty($phones->getType()) && !empty($phones->getValue())) {
			$this->phones[] = $phones;
		}
	}

	public function addContactsEmails($emails)
	{
		if(is_object($emails) && !empty($emails->getType()) && !empty($emails->getValue())) {
			$this->emails[] = $emails;
		}
	}

	public function addContactsUrls($urls)
	{
		if(is_object($urls) && !empty($urls->getType()) && !empty($urls->getValue())) {
			$this->urls[] = $urls;
		}
	}

	public function addContactsCustomFields($custom_fields)
	{
		if(is_object($custom_fields) && !empty($custom_fields->getId()) && !empty($custom_fields->getValue())) {
			$this->custom_fields[] = $custom_fields;
		}
	}

	public function setPartial($partial)
	{
		$this->partial = $partial;
	}
     
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function deleteEmail($index)
    {
    	unset($this->emails[$index]);
    	$this->emails = array_values($this->emails);
    }

    public function deletePhone($index)
    {
    	unset($this->phones[$index]);
    	$this->phones = array_values($this->phones);
    }

    public function deleteCustomField($index)
    {
    	unset($this->custom_fields[$index]);
    	$this->custom_fields = array_values($this->custom_fields);
    }

    public function deleteUrl($index)
    {
    	unset($this->urls[$index]);
    	$this->urls = array_values($this->urls);
    }
}
