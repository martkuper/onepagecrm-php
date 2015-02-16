<?php
namespace MartKuper\OnePageCRM\Config;

/**
 * Configuration class
 *
 * This class contains all
 *
 * @package onepagecrm-php
 * @author Mart Kuper
 * @version 0.0.1
 */
class Config
{
	/**
	 * API base URL
	 * @var String
	 */
	private $baseUrl;

	/**
	 * OnePageCRM email
	 * @var String
	 */
	private $email;

	/**
	 * OnePageCRM password
	 * @var String
	 */
	private $password;

	/**
	 * OnePageCRM userId
	 * @var String
	 */
	private $userId;

	/**
	 * Config class constructor
	 *
	 * TODO: Improve documentation
	 * 
	 * @param String $baseUrl  The base url to use. Set to null to use the default value
	 * @param String $email    Your OnePageCRM email
	 * @param String $password Your OnePageCRM password
	 */
	public function __construct($email, $password, $baseUrl = null) 
	{
		if(!$baseUrl) {
			$this->setBaseUrl('https://app.onepagecrm.com/api/v3/');	
		}
		
		$this->setEmail($email);
		$this->setPassword($password);
	}

	/**
	 * Get the base url
	 * @return String Base url
	 */
	public function getBaseUrl()
	{
		return $this->baseUrl;
	}

	/**
	 * Get the user's email
	 * @return String The user's email
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Get the user's password
	 * @return String The user's password
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Get the userId
	 * @return String The userId
	 */
	public function getUserId()
	{
		return $this->userId;
	}

	/**
	 * Set the base url
	 * @param String $baseUrl The base url
	 */
	public function setBaseUrl($baseUrl)
	{
		$this->baseUrl = $baseUrl;
	}

	/**
	 * Set the user's email
	 * @param String $email The user's email
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}

	/**
	 * Set the user's password
	 * @param String $password The user's password
	 */
	public function setPassword($password)
	{
		$this->password = $password;
	}

	/**
	 * Set the userId
	 * @param string $userId The userId
	 */
	public function setUserId($userId)
	{
		$this->userId = $userId;
	}
}
