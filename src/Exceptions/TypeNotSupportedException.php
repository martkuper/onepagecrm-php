<?php
namespace MartKuper\OnePageCRM\Exceptions;

class TypeNotSupportedException extends \Exception {
	 
	 /**
	  * Send error message
	  * @param string  $name     Name of the used type
	  * @param string  $expected List of expected types
	  * @param string  $message  Optional message
	  * @param integer $code     Error code
	  */
	public function __construct($name, $expected, $message = null, $code = 0)
	{
		if(!$message) {
			$message = 'Unsupported type: ' . $name . '. Expected: ' . $expected;
			parent::__construct($message, $code);
		}
	}
}