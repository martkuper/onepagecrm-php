<?php
namespace MartKuper\OnePageCRM\Misc;

class Misc {

	/**
	 * Convert snake_case to CamelCase
	 * 
	 * @param  string  $string          The string to convert
	 * @param  boolean $first_char_caps Wheather to use camelCase or CamelCase
	 * @return string                   The converted string
	 */
	static function snakeCaseToCamelCase( $string, $first_char_caps = false)
	{
		if( $first_char_caps == true )
		{
			$string[0] = strtoupper($string[0]);
		}
		$func = create_function('$c', 'return strtoupper($c[1]);');
		return preg_replace_callback('/_([a-z])/', $func, $string);
	}
}
