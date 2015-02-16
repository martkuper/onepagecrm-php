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
	 * @var string
	 */
	private $baseUrl;

	/**
	 * OnePageCRM email
	 * @var string
	 */
	private $email;

	/**
	 * OnePageCRM password
	 * @var string
	 */
	private $password;

	/**
	 * OnePageCRM userId
	 * @var string
	 */
	private $userId;

	/**
	 * OnePageCRM authentication key
	 * @var string
	 */
	private $authKey;

	/**
	 * Config class constructor
	 *
	 * TODO: Improve documentation
	 * 
	 * @param string $baseUrl  The base url to use. Set to null to use the default value
	 * @param string $email    Your OnePageCRM email
	 * @param string $password Your OnePageCRM password
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
	 * @return string Base url
	 */
	public function getBaseUrl()
	{
		return $this->baseUrl;
	}

	/**
	 * Get the user's email
	 * @return string The user's email
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Get the user's password
	 * @return string The user's password
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Get the userId
	 * @return string The userId
	 */
	public function getUserId()
	{
		return $this->userId;
	}

	/**
	 * Get the authKey
	 * @return string The authKey
	 */
	public function getAuthKey()
	{
		return $this->authKey;
	}

	/**
	 * Set the base url
	 * @param string $baseUrl The base url
	 */
	public function setBaseUrl($baseUrl)
	{
		$this->baseUrl = $baseUrl;
	}

	/**
	 * Set the user's email
	 * @param string $email The user's email
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}

	/**
	 * Set the user's password
	 * @param string $password The user's password
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

	/**
	 * Set the authKey
	 * @param string $authKey The authKey
	 */
	public function setAuthKey($authKey)
	{
		$this->authKey = $authKey;
	}
}
