<?php
namespace MartKuper\OnePageCRM\Deal;

use MartKuper\OnePageCRM\OnePageCRM;
use MartKuper\OnePageCRM\Config\Config;
use MartKuper\OnePageCRM\Misc\Misc as Misc;

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



    /**
     * Gets the id of the deal (read only).
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the id of the contact this deal belongs to.
     *
     * @return string
     */
    public function getContactId()
    {
        return $this->contact_id;
    }

    /**
     * Sets the id of the contact this deal belongs to.
     *
     * @param string $contact_id the contact id
     */
    private function setContactId($contact_id)
    {
        $this->contact_id = $contact_id;
    }

    /**
     * Gets the JSON object containing contact_name and company relating to deal (read only).
     *
     * @return JSON object
     */
    public function getContactInfo()
    {
        return $this->contact_info;
    }

    /**
     * Gets the Date related to the deal’s creation.
     *
     * @return date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Sets the Date related to the deal’s creation.
     *
     * @param date $date the date
     */
    private function setDate($date)
    }

    /**
     * Gets the Name of the deal (required).
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the Name of the deal (required).
     *
     * @param string $name the name
     */
    private function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Gets the The text in the body of the deal.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Sets the The text in the body of the deal.
     *
     * @param string $text the text
     */
    private function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Gets the First name and first letter of last name of the author of the deal (read only).
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Gets the Total amount of money to be paid per month.
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Sets the Total amount of money to be paid per month.
     *
     * @param float $amount the amount
     */
    private function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * Gets the Number of months the above amount will be paid for.
     *
     * @return int
     */
    public function getMonths()
    {
        return $this->months;
    }

    /**
     * Sets the Number of months the above amount will be paid for.
     *
     * @param int $months the months
     */
    private function setMonths($months)
    {
        $this->months = $months;
    }

    /**
     * Gets the Product of amount and months (read only).
     *
     * @return float
     */
    public function getTotalAmount()
    {
        return $this->total_amount;
    }

    /**
     * Gets the What stage this deal is at
     * This can be converted to a label using the deal stages list in the settings resource.
     *
     * @return int
     */
    public function getStage()
    {
        return $this->stage;
    }

    /**
     * Sets the What stage this deal is at
     * This can be converted to a label using the deal stages list in the settings resource.
     *
     * @param int $stage the stage
     */
    private function setStage($stage)
    {
        $this->stage = $stage;
    }

    /**
     * Gets the Status of the deal this is one of won, lost or pending.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the Status of the deal this is one of won, lost or pending.
     *
     * @param string $status the status
     */
    private function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Gets the Date when the deal is expected to be closed.
     *
     * @return date
     */
    public function getExpectedCloseDate()
    {
        return $this->expected_close_date;
    }

    /**
     * Sets the Date when the deal is expected to be closed.
     *
     * @param date $expected_close_date the expected close date
     */
    private function setExpectedCloseDate($expected_close_date)
    {
        $this->expected_close_date = $expected_close_date;
    }

    /**
     * Gets the Date that the deal was closed
     * This is set automatically when a deal is marked as won or lost (read only).
     *
     * @return date
     */
    public function getClosedDate()
    {
        return $this->closed_date;
    }  
}
