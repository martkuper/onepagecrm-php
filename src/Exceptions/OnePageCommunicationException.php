<?php
namespace MartKuper\OnePageCRM\Exceptions;

/**
 * OnePageCommunicationException class
 *
 * Exception thrown when there is an error while communicating with OnePageCRM
 *
 * @package onepagecrm-php
 * @author Mart Kuper
 * @version 0.2.0
 */
class OnePageCommunicationException extends \Exception {
	 
	 /**
	  * Send error message
	  * @param string  $name     Name of the used type
	  * @param string  $expected List of expected types
	  * @param string  $message  Optional message
	  * @param integer $code     Error code
	  */
	public function __construct($e, $message = null, $code = 0)
	{
		if(!$message) {
			$message = 'Error communicating with OnePageCRM: ' . $e;
			parent::__construct($message, $code);
		} else {
			parent::__construct($message, $code);
		}
	}
}
