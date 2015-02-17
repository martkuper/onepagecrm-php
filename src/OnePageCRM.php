<?php
namespace MartKuper\OnePageCRM;

use MartKuper\OnePageCRM\Config\Config;
use GuzzleHttp\Client;

/**
 * Base class that handles OnePageCRM connection
 *
 * @package onepagecrm-php
 * @author Mart Kuper
 * @version 0.2.0
 */
abstract class OnePageCRM
{

	/**
	 * [$url description]
	 * @var [type]
	 */
	private $url;

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

		$this->guzzleClient = $client;
		$this->config       = $config;

		$className = explode("\\", strtolower(get_class($this)));
		$this->url = array_pop($className) . '.json';

		if(!$config->getAuthKey() || !$config->getUserId()) {
			$this->login();	
		}		
	}

	/**
	 * Use the 'POST' method to send data to OnePageCRM
	 *
	 * The url you enter here, will be appended to the base url.
	 * 
	 * For example: post('login.json', $data) 
	 * 
	 * will post to 'https://app.onepagecrm.com/api/v3/login.json'
	 * unless another base url is supplied.
	 * 
	 * The body must be supplied as an associative array.
	 * 
	 * For example: post($url, ['login' => 'e@mail.com', 'password' => 'pass'])
	 * 
	 * @param  string|null   $url     The url to append to the base url
	 * @param  array|null    $body    The data to send
	 * @return Response         	  GuzzleHttp\Response object
	 */
	public function post($url = null, $body = null)
	{
		if(!$url) {
			$url = $this->url;
		}

		if($body) {
			$data['json'] = $body;
		} else {
			$data['json'] = $this->toArray();
		}
		
		// TODO: Explain
		if(!isset($body['login']) && !isset($body['password'])) {
			$headers = $this->authenticate($data['json'], $url);
			$headers['Content-Type'] = 'application/json';
			$data['headers'] = $headers;
		}

		$client = $this->guzzleClient;
		$request = $client->createRequest('POST', $url, $data);
		$request->getBody()->getContents();
		$response = $client->send($request);
		
		return $response;
	}

	/**
	 * TODO: Update documentation
	 * [login description]
	 * @return [type] [description]
	 */
	protected function login()
	{
		$config = $this->config;

		$response = $this->post('login.json', [
			'login' => $config->getEmail(), 
			'password' => $config->getPassword()
		]);
		$response_json = $response->json();
		
		$uid = $response_json['data']['user_id'];
		$key = base64_decode($response_json['data']['auth_key']);

		$config->setUserId($uid);
		$config->setAuthKey($key);

		return $response;
	}

	/**
	 * Generate OnePageCRM authentication keys
	 * 
	 * TODO: update documentation
	 * 
	 * @return array Array of HTTP headers
	 */
	protected function authenticate($data, $url, $http_method = 'POST')
	{
		$config = $this->config;
		$uid = $config->getUserId();
		$key = $config->getAuthKey();
		
		$full_url = $config->getBaseUrl() . $url;
		$timestamp = time();
		$auth_data = array($uid, $timestamp, $http_method, sha1($full_url));
		$request_headers = array();

		if($http_method == 'POST' || $http_method == 'PUT') {
			$json_data = json_encode($data);
			$auth_data[] = sha1($json_data);
		}
		
		if($key != null && $uid != null) {
			$hash = hash_hmac('sha256', implode('.', $auth_data), $key);
			$request_headers["X-OnePageCRM-UID"] = $uid;
			$request_headers["X-OnePageCRM-TS"] = $timestamp;
			$request_headers["X-OnePageCRM-Auth"] = $hash;
		} else {
			$this->login();
			return $this->authenticate($data, $url, $http_method);
		}

		return $request_headers;
	}

	abstract protected function toArray();
}
