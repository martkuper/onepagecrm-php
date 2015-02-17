<?php
namespace MartKuper\OnePageCRM\Config;

/**
 * Configuration class
 *
 * @package onepagecrm-php
 * @author Mart Kuper
 * @version 0.2.0
 */
class Config
{
	/**
	 * API base URL
	 * @var string
	 */
	private $base_url = 'https://app.onepagecrm.com/api/v3/';

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
	 * OnePageCRM user_id
	 * @var string
	 */
	private $user_id;

	/**
	 * OnePageCRM authentication key
	 * @var string
	 */
	private $auth_key;

	/**
	 * Config class constructor
	 *
	 * Sets class variables
	 * 
	 * @param string $email    Your OnePageCRM email
	 * @param string $password Your OnePageCRM password
	 */
	public function __construct($email, $password) 
	{
		$this->setEmail($email);
		$this->setPassword($password);
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
	 * Get the user_id
	 * @return string The user_id
	 */
	public function getUserId()
	{
		return $this->user_id;
	}

	/**
	 * Get the auth_key
	 * @return string The auth_key
	 */
	public function getAuthKey()
	{
		return $this->auth_key;
	}

	/**
	 * Get the base_url
	 * @return string The base url
	 */
	public function getBaseUrl()
	{
		return $this->base_url;
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
	 * Set the user_id
	 * @param string $user_id The user_id
	 */
	public function setUserId($user_id)
	{
		$this->user_id = $user_id;
	}

	/**
	 * Set the auth_key
	 * @param string $auth_key The auth_key
	 */
	public function setAuthKey($auth_key)
	{
		$this->auth_key = $auth_key;
	}
}
