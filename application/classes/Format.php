<?php

class Format extends Kohana_Text
{
	const SHORT = 'n/j/Y';
	const LONG = '%b %d %Y';
	const HUMAN = 'm/d/Y g:i A';
	const HUMANDE = 'd.m.Y H:i';
	const TIMESTAMP = 'Y-m-d H:i:s';
	const UNIXTIMESTAMP = 'Ymdhis';
	const READABLE = '%B %d, %Y';

	/**
	 * Returns alpha version of decimal, in dollars and cents
	 * EXAMPLE: alpha_number(1254.25, 2); [one thousand two hundred fifty four dollars and twenty five cents]
	 * NOTE: can be used to output any unit in Alphabetic including other monitary such as 'yen' or 'pounds'
	 * @static
	 * @param $num: any integer or numeric string
	 * @param int $dec: [optional] - decimal places for float
	 * @param string $units: [optional] - string to append such as dollars
	 * @return string: one thousand two hundred fifty four dollars and twenty five cents
	 */
	public static function alpha_number($num, $dec = 0, $units = "dollars")
	{
		$return = '';
		$alphaNums1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve','thirteen', 'fourteen', 'fifteen',  'sixteen', 'seventeen', 'eighteen', 'nineteen');
		$alphaNums2 = array('', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety');
		$num = explode(".", self::clean_number($num, true));
		$numLen = strlen($num[0]);
		switch($numLen)
		{
			case '7':
				$return .= $alphaNums1[$num[0][$numLen - 7]]." million ";
			case '6':
				$return .= $alphaNums1[$num[0][$numLen - 6]]." hundred ";
			case '5':
				$theNum = $num[0][$numLen - 5].$num[0][$numLen - 4];
				if($theNum > 9 && $theNum < 20)
				{
					$return .= $alphaNums1[$theNum]." thousand ";
				}
				else
				{
					$return .= $alphaNums2[$num[0][$numLen - 5]]." ";
				}
			case '4':
				if($theNum < 9 || $theNum > 20)
				{
					$return .= $alphaNums1[$num[0][$numLen - 4]]." thousand ";
				}
			case '3':
				if($num[0][$numLen - 3])
				{
					$return .= $alphaNums1[$num[0][$numLen - 3]]." hundred ";
				}
			case '2':
				$theNum = $num[0][$numLen - 2].$num[0][$numLen - 1];
				if($theNum > 9 && $theNum < 20)
				{
					$return .= $alphaNums1[$theNum];
					break;
				}
				else
				{
					if($num[0][$numLen - 2])
					{
						$return .= $alphaNums2[$num[0][$numLen - 2]]." ";
					}
				}
			case '1':
				if($num[0][$numLen - 1])
				{
					$return .= $alphaNums1[$num[0][$numLen - 1]]." ";
				}
				break;
			case '0':
				$return = 'zero';
				break;
		}

		$return .= $units;

		if($dec == 2 && $num[1] > 0)
		{
			$return .= " and ";
			$theNum = $num[1][0].$num[1][1];
			if($theNum > 9 && $theNum < 20)
			{
				$return .= $alphaNums1[$theNum];
			}
			else
			{
				$return .= $alphaNums2[$num[1][0]]." ";
				$return .= $alphaNums1[$num[1][1]];
			}

			if($units == 'dollars')
			{
				$return .= " cents";
			}
		}
		return $return;
	}

	/**
	 * Return int removing all non-numeric characters from string.
	 * NOTE: also works with floats if you designate $float = true
	 * @static
	 * @param $str
	 * @param bool $float
	 * @return bool|mixed|string
	 */
	public static function clean_number($str, $float = false)
	{
		if($float === false)
		{
			return preg_replace('/\D+/', '', $str);
		}

		// Break up the sections by decimal point
		$sections = explode('.', $str);

		// Create the array
		$array = array();

		foreach($sections as $section)
		{
			$array[] = self::clean_number($section);
		}

		$last_section = '';

		if(count($array > 1))
		{
			// Pop off the last section (we are assuming the last
			// section is the only valid decimal point
			$last_section = array_pop($array);
		}

		// Keep the last decimal point intact
		$float = implode('', $array).'.'.$last_section;

		return $float;
	}

	/**
	 * @static
	 * @param $number
	 * @param int $cents
	 * @return string
	 */
	public static function currency($number, $cents = 0)
	{
		// cents: 0=never, 1=if needed, 2=always
		if(is_numeric($number))
		{
			// a number
			if(!$number)
			{
				// zero
				$money = ($cents == 2 ? '0.00' : '0'); // output zero
			}
			else
			{ // value
				if(floor($number) == $number)
				{
					// whole number
					$money = number_format($number, ($cents == 2 ? 2 : 0)); // format
				}
				else
				{ // cents
					$money = number_format(round($number, 2), ($cents == 0 ? 0 : 2)); // format
				} // integer or decimal
			} // value
			return '$'.$money;
		} // numeric
	}

	/**
	 * EXAMPLE: current_tax_year(20011,12,31); [2010]
	 * Returns current tax year according the the tax Month and tax Day
	 * @static
	 * @param string $t_year: tax year
	 * @param int $t_month: tax month
	 * @param int $t_day: tax day
	 * @return string: Tax year based on the params entered
	 */
	public static function current_tax_year($t_year = '', $t_month = 12, $t_day = 31)
	{
		if($t_year != '')
		{
			$c_year = $t_year;
		} else {
			$c_year = date("Y"); //numeric value for current year
		}
		$p_year = $c_year-1; //previous year
		$c_month = date("n"); //numeric value of month
		if($c_month < $t_month)
		{
			return $p_year;
		}
		elseif($c_month == $t_month)
		{
			if(date("j") < $t_day)
			{
				return $p_year;
			}
			else
			{
				return $c_year;
			}
		}
		else
		{
			return $c_year;
		}
	}

	/**
	 * Convert a date from one format to another.
	 * params: (CASE SENSITIVE)
	 * EXAMPLE: date("20090716144417", 'Y-m-d h:i:s');
	 * Will output the above as 07-12-2009 2:44 PM
	 * $out uses shortcut of 'unix' or 'mysql' but will accept all date() function formating
	 * @static
	 * @param $date: Any proper formatted date (unix, mysql, timestamp, ect.)
	 * @param string $out: [Optional] "unix", "mysql", "timestamp", "unixtimestamp", "human", "short" (default), "long", "iso_8601" or any date() function formating
	 * @return int|string
	 */
	public static function date($date, $out = 'timestamp')
	{
		if(strlen($date) < 1 || $date == '0000-00-00 00:00:00' || $date == '0000-00-00')
		{
			return null;
		}

		if(!ctype_digit($date))
		{
			$date = strtotime($date);
		}

		switch($out)
		{
			case 'unix':
				$return = $date;
				break;
			case 'mysql':
			case 'iso_8601':
			case 'timestamp':
				$return = date(self::TIMESTAMP, $date);
				break;
			case 'unixtimestamp':
				$return = date(self::UNIXTIMESTAMP, $date);
				break;
			case 'human':
				if(\Helper::language() === 'jp' OR \Helper::language() === 'en')
				{
					$return = date(self::HUMANDE, $date);
				}
				else
				{
					$return = date(self::HUMAN, $date);
				}
				break;
			case 'short':
				$return = date(self::SHORT, $date);
				break;
			case 'long':
				$return = strftime(self::LONG, $date);
				break;
			case 'readable':
				$return = strftime(self::READABLE, $date);
				break;
			default:
				$return = date($out, $date);
		}

		return $return;
	}

	/**
	 * Return a string as a percentage from any number
	 * @static
	 * @param $num: any integer or numeric string
	 * @param int: $dec Decimal places
	 * @return string: as a percent
	 */
	public static function percent($num, $dec = 2)
	{
		return number_format($num,$dec,'.',',').'%';
	}

	/**
	 * Return a readable formatted phone number
	 * @static
	 * @param $number
	 * @return string: (555) 555-5555
	 */
	public static function phone($number)
	{
		if(empty($number))
		{
			return $number;
		}

		$pieces = array();

		$pieces[] = substr($number, -4);
		$pieces[] = substr($number, -7, 3);
		$pieces[] = substr($number, -10, 3);

		if(strlen($number) > 10)
		{
			$pieces[] = substr($number, 0, strlen($number) - 10);
		}

		$string = "({$pieces[2]}) {$pieces[1]}-{$pieces[0]}";

		if(isset($pieces[3]))
		{
			$string = "+{$pieces[3]} ".$string;
		}

		return $string;
	}

}