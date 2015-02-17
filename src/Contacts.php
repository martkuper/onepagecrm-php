<?php
namespace MartKuper\OnePageCRM;

use MartKuper\OnePageCRM\Config\Config;

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
	 * Contact's first name
	 * @var string
	 */
	private $firstName;

	/**
	 * Contact's last name
	 * @var string
	 */
	private $lastName;

	/**
	 * Contact's company name
	 * @var string
	 */
	private $companyName;

	/**
	 * Contacts job title
	 * @var string
	 */
	private $jobTitle;

	/**
	 * Contact's status id
	 * @var string
	 */
	private $statusId;

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
	private $ownerId;

	/**
	 * list of addresses
	 * @var array
	 */
	private $addressList = [];

	/**
	 * Contact's description
	 * @var string
	 */
	private $background;

	/**
	 * Contact's lead source id
	 * @var string
	 */
	private $leadSourceId;

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
	private $customFields = [];

	/**
	 * Initializes parent configuration
	 *
	 * TODO: Complete documentation
	 * 
	 * @param Config $config Config object
	 * @param array  $data   Contact data
	 */
	public function __construct(Config $config, array $data)
	{
		parent::__construct($config);
		$this->setClassVariables($data);
	}	

	public function toArray()
	{
		return [
			'first_name' 	=> $this->firstName,
			'last_name' 	=> $this->lastName,
			'company_name' 	=> $this->companyName,
			'job_title' 	=> $this->jobTitle,
			'status_id' 	=> $this->statusId,
			'status' 		=> $this->status,
			'tags' 			=> $this->tags,
			'starred' 		=> $this->starred,
			'owner_id' 		=> $this->ownerId,
			'address_list' 	=> $this->addressList,
			'background' 	=> $this->background,
			'leadSource_id' => $this->leadSourceId,
			'phones' 		=> $this->phones,
			'emails' 		=> $this->emails,
			'urls' 			=> $this->urls,
			'custom_fields' => $this->customFields
		];
	}

	private function setClassVariables(array $data)
	{
		foreach ($data as $key => $value) {
			if(isset($data[$key])) {
				$this->$key = $data[$key];
			}
		}		
	}	

	public function getFirstName()
	{
		return $this->firstName;
	}

	public function getLastName()
	{
		return $this->lastName;
	}

	public function getCompanyName()
	{
		return $this->companyName;
	}

	public function getJobTitle()
	{
		return $this->jobTitle;
	}

	public function getStatusId()
	{
		return $this->statusId;
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
		return $this->ownerId;
	}

	public function getAddressList()
	{
		return $this->addressList;
	}

	public function getBackground()
	{
		return $this->background;
	}

	public function getLeadSourceId()
	{
		return $this->leadSourceId;
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
		return $this->customFields;
	}

	public function setFirstName(string $firstName)
	{
		$this->firstName = $firstName;
	}

	public function setLastName(string $lastName)
	{
		$this->lastName = $lastName;
	}

	public function setCompanyName(string $companyName)
	{
		$this->companyName = $companyName;
	}

	public function setJobTitle(string $jobTitle)
	{
		$this->jobTitle = $jobTitle;
	}

	public function setStatusId(string $statusId)
	{
		$this->statusId = $statusId;
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

	public function setOwnerId(string $ownerId)
	{
		$this->ownerId = $ownerId;
	}

	public function setAddressList(array $addressList)
	{
		$this->addressList = $addressList;
	}


	public function setBackground(string $background)
	{
		$this->background = $background;
	}

	public function setLeadSourceId(string $leadSourceId)
	{
		$this->leadSourceId = $leadSourceId;
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

	public function setCustomFields(array $customFields)
	{
		$this->customFields = $customFields;
	}
}
