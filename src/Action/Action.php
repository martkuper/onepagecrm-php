<?php
namespace MartKuper\OnePageCRM\Action;

use MartKuper\OnePageCRM\OnePageCRM;
use MartKuper\OnePageCRM\Config\Config;
use MartKuper\OnePageCRM\Misc\Misc as Misc;

/**
 * Action class
 *
 * Provides an interface for posting a new action to OnePageCRM
 *
 * @package onepagecrm-php
 * @author Mart Kuper
 * @version 0.5.0
 */
class Action extends OnePageCRM {

	/**
	 * OnePageCRM id of the action
	 * read-only
	 * @var string
	 */
	private $action_id;

	/**
	 * ID of the OnePageCRM contact the action belongs to
	 * @var string
	 */
	private $contact_id;

	/**
	 * ID of the user an action is assigned to
	 * @var string
	 */
	private $assignee_id;

	/**
	 * Action's date
	 * format yyyy-mm-dd or nil when status is no_date
	 * @var string
	 */
	private $date;

	/**
	 * Action's text. Maximum of 140 characters
	 * @var string
	 */
	private $text;

	/**
	 * Action status
	 * can be: date, asap, waiting or no_date
	 * @var string
	 */
	private $status;

	/**
	 * Wheather the action has been completed or not
	 * @var boolean
	 */
	private $done = false;

	/**
	 * Date when the action was completed
	 * format yyyy-mm-dd or nil when $done is false
	 * @var date
	 */
	private $done_date;

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


	public function __construct(Config $config, $data = null)
	{
		$this->url = 'actions.' . $this->data_format;
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
			'action_id',
			'assignee_id',
			'date',
			'text',
			'status',
			'done',
			'done_date',
			'contact_id',
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
			if(array_key_exists($key, $data) && !empty($data[$key])) {
				$setter = 'set' . Misc::snakeCaseToCamelCase($key, true);
				$this->$setter($data[$key]);
			}
		}		
	}

	/**
	 * TODO: Update documentation
	 * 
	 * @param  string|null   $url     The url to append to the base url
	 * @param  array|null    $body    The data to send
	 * @return Response         	  GuzzleHttp\Response object
	 */
	public function post($url = null, $body = null) 
	{
		return parent::postData($this->sub_url . $this->contact_id . '/' . $this->url);
	}

	public function getActionId()
	{
		return $this->action_id;
	}

	public function getContactId()
	{
		return $this->contact_id;
	}

	public function getAssigneeId()
	{
		return $this->assignee_id;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getText()
	{
		return $this->text;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function getDone()
	{
		return $this->done;
	}

	public function getDoneDate()
	{
		return $this->done_date;
	}

	public function setContactId($contact_id)
	{
		$this->contact_id = $contact_id;
	}

	public function setAssigneeId($assignee_id)
	{
		$this->assignee_id = $assignee_id;
	}

	public function setDate($date)
	{
		if ($this->status == 'no_date') {
			$this->date = null;
		} else {
			$this->date = $date;
			$this->status = 'date';
		}
	}

	public function setText($text)
	{
		$text_trimmed = substr($text, 0, 140);
		$this->text = $text_trimmed;
	}

	public function setStatus($status)
	{
		$status_allowed = [
			'date',
			'asap',
			'waiting',
			'no_date',
		];

		if(in_array($status, $status_allowed)) {
			$this->status = $status;
		} else {
			$this->status = null;
		}
	}

	public function setDone($done)
	{
		if(is_bool($done)) {
			$this->done = $done;
		} else {
			$this->done = false;
		}
	}

	public function setDoneDate($done_date)
	{
		if ($this->done) {
			$this->done_date = $done_date;
		} else {
			$this->done_date = null;
		}
	}
}
