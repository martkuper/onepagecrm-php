<?php
namespace MartKuper\OnePageCRM\Note;

use MartKuper\OnePageCRM\OnePageCRM;
use MartKuper\OnePageCRM\Config\Config;
use MartKuper\OnePageCRM\Misc\Misc as Misc;

/**
 * Note class
 *
 * Provides an interface for posting a new note to OnePageCRM
 *
 * @package onepagecrm-php
 * @author Mart Kuper
 * @version 0.5.0
 */
class Note extends OnePageCRM {

	/**
	 * ID of the note
	 * read-only
	 * @var bson_id
	 */
	private $note_id;

	/**
	 * ID of the contact the note belongs to
	 * @var bson_id
	 */
	private $contact_id;

	/**
	 * Date of note creation
	 * @var date
	 */
	private $date;

	/**
	 * Note body
	 * @var string
	 */
	private $text;

	/**
	 * First name and first letter of last name
	 * of the author of the note
	 * read-only
	 * @var string
	 */
	private $author;

	/**
	 * null if there is no linked deal,
	 * otherwise id of linked deal
	 * @var bson_id
	 */
	private $linked_deal_id;

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
			'note_id',
			'contact_id',
			'date',
			'text',
			'author',
			'linked_deal_id',
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
		return parent::postData($this->sub_url . $this->contact_id . '/notes.' . $this->data_format);
	}

	public function getNoteId()
	{
		return $this->note_id;
	}

	public function getContactId()
	{
		return $this->contact_id;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getText()
	{
		return $this->text;
	}

	public function getAuthor()
	{
		return $this->author;
	}

	public function getLinkedDealId()
	{
		return $this->linked_deal_id;
	}

	public function setContactId($contact_id)
	{
		$this->contact_id = $contact_id;
	}

	public function setDate($date)
	{
		$this->date = $date;
	}

	public function setText($text)
	{
		$this->text = $text;
	}

	public function setLinkedDealId($linked_deal_id)
	{
		$this->linked_deal_id = $linked_deal_id;
	}
}
