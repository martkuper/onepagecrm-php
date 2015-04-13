<?php>
namespace MartKuper\OnePageCRM\Deal;

use MartKuper\OnePageCRM\Config\Config;

/**
 * Base class that handles OnePageCRM connection
 *
 * @package onepagecrm-php
 * @author Mart Kuper
 * @version 0.5.2
 */
class Deal extends OnePageCRM {

	/**
	 * id of the deal (read only)
	 * @var string
	 */
	private $id;

	/**
	 * id of the contact this deal belongs to (read only)
	 * @var string
	 */
	private $contact_id;

	/**
	 * JSON object containing contact_name and company relating to deal (read only)
	 * @var JSON object
	 */
	private $contact_info;

	/**
	 * Date related to the deal’s creation
	 * @var date
	 */
	private $date;

	/**
	 * Name of the deal (required)
	 * @var string
	 */
	private $name;

	/**
	 * The text in the body of the deal
	 * @var string
	 */
	private $text;

	/**
	 * First name and first letter of last name of the author of the deal (read only)
	 * @var string
	 */
	private $author;

	/**
	 * Total amount of money to be paid per month
	 * @var float
	 */
	private $amount;

	/**
	 * Number of months the above amount will be paid for
	 * @var int
	 */
	private $months;

	/**
	 * Product of amount and months (read only)
	 * @var float
	 */
	private $total_amount;

	/**
	 * What stage this deal is at. 
	 * This can be converted to a label using the deal stages list in the settings resource.
	 * @var int
	 */
	private $stage;

	/**
	 * Status of the deal this is one of won, lost or pending
	 * @var string
	 */
	private $status;

	/**
	 * Date when the deal is expected to be closed
	 * @var date
	 */
	private $expected_close_date;

	/**
	 * Date that the deal was closed. 
	 * This is set automatically when a deal is marked as won or lost (read only).
	 * @var date
	 */
	private $closed_date;

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
	 * Sub URL (including trailing slash) to use for POST requests
	 * @var string
	 */
	private $post_sub_url = 'contacts/';

	/**
	 * Sub URL (including trailing slash) to use for PUT requests
	 * @var string
	 */
	private $put_sub_url = 'deals/';

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
		$this->url = 'deals.' . $this->data_format;
		parent::__construct($config);
		if(!empty($data)) {
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
			'id',
			'contact_id',
			'contact_info',
			'date',
			'name',
			'text',
			'author',
			'amount',
			'months',
			'total_amount',
			'stage',
			'status',
			'expected_close_date',
			'closed_date',
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
	 * POST a new Deal to OnePageCRM
	 * @param  string $url  		The URL to post to. Not used
	 * @param  string $body 		The body to send. Not used
	 * @return GuzzleHttp\Response 	OnePageCRM response.
	 */
	public function post($url = null, $body = null) 
	{
		return parent::postData($this->post_sub_url . $this->contact_id . '/' . $this->url);
	}

	/**
	 * Update this class to OnePageCRM
	 * If no id is set in the class, nothing will happen
	 * @return Response GuzzleHttp response object
	 */
	public function update() 
	{
		$id = $this->id;

		if(empty($id)) {
			// TODO: Throw exception
			return;
		}

		$body = array_merge($this->put_options, $this->toArray());
		$response = parent::put($this->put_sub_url . $id . '.' . $this->data_format ,$body);
		//$this->fromArray($response->json()['data']['contact']);	
		return $response;
	}
}
