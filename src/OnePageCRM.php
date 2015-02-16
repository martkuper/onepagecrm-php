<?php
namespace MartKuper\OnePageCRM;

use MartKuper\OnePageCRM\Config\Config;
use GuzzleHttp\Client;

/**
 * Base class that handles OnePageCRM connection
 *
 * @package onepagecrm-php
 * @author Mart Kuper
 * @version 0.0.1
 */
class OnePageCRM
{

	/**
 	* Guzzle client object
 	* @var GuzzleHttp\Client
 	*/
	private $guzzleClient;

	/**
	 * Configuration object
	 * @var Config object
	 */
	private $config;

	/**
	 * OnePageCRM class constructor
	 *
	 * TODO: Improve documentation
	 * 
	 * @param Client|null $client GuzzleHttp/Client object
	 * @param Config      $config Config object
	 */
	public function __construct(Config $config, Client $client = null)
	{
		if(!$client) {
			$client = new Client([
				'base_url'	=>	$config->getBaseUrl()
			]);
		}	

		$this->setGuzzleClient($client);
		$this->setConfig($config);
	}

	/**
	 * Use the 'POST' method to send data to OnePageCRM
	 *
	 * The url you enter here, will be appended to the base url.
	 * For example: post('login.json', $data, $partial) 
	 * will post to 'https://app.onepagecrm.com/api/v3/login.json'
	 * unless another base url is supplied.
	 * The body must be supplied as an associative array.
	 * For example post($url, ['login' => 'e@mail.com', 'password' => 'pass'])
	 * Setting partial to true (default) will allow you to send a selection of the default fields
	 * wile setting the other fields to null. 
	 * For example: you can add a new contact with only a name and email address,
	 * all other field will be set to null.
	 * 
	 * @param  string  $url    	The url to append to the base url
	 * @param  array   $body    The data to send
	 * @return boolean $partial Send a partial request
	 */
	public function post($url , $body, $partial = true)
	{
		$data['json'] = $body;
		
		if($partial || (array_key_exists('partial', $body) && $body['partial'] != 1 && $partial)) {
			$data['json']['partial'] = 1;
		}
		
		$client = $this->getGuzzleClient();
		$request = $client->createRequest('POST', $url, $data);
		
		$response = $client->send($request);
		return $response;
	}

	/**
	 * Authenticates to the OnePageCRM API
	 * 
	 * TODO: complete PHPDoc and complete function
	 * TODO: change function visibility to private
	 * 
	 * @return [type] [description]
	 */
	public function authenticate()
	{
		
	}

	/**
	 * Gets the guzzleClient
	 * @return GuzzleHttp\Client The GuzzleHttp\Client object
	 */
	public function getGuzzleClient()
	{
		return $this->guzzleClient;
	}

	/**
	 * Get the configuration object
	 * @return Config The configuration object
	 */
	public function getConfig()
	{
		return $this->config;
	}

	/**
	 * Sets the guzzleClient
	 * @param GuzzleHttp\Client $guzzleClient The GuzzleHttp\Client object
	 */
	public function setGuzzleClient(Client $guzzleClient)
	{
		$this->guzzleClient = $guzzleClient;
	}

	/**
	 * Set the configuration object
	 * @param Config $config The configuration object
	 */
	public function setConfig(Config $config)
	{
		$this->config = $config;
	}
}
