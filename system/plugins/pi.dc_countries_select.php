<?php

/*
===============================================================================
DC Countries Select
-------------------------------------------------------------------------------
http://www.designchuchi.ch/
-------------------------------------------------------------------------------
Copyright (c) 2010 - today Designchuchi
===============================================================================
Attribution:

This ExpressionEngine plugin is a spinoff of the wonderful BU Countries Select
plugin from  http://www.bridgingunit.com/labs/expressionengine/bu-countries-select/.

Since we needed to include proper country codes as defined in ISO_3166-1 (@see
http://en.wikipedia.org/wiki/ISO_3166-1), we forked the plugin, making it avail-
able under a similar license.
===============================================================================
File: pi.dc_countries_select.php
-------------------------------------------------------------------------------
Purpose: Countries drop-downs in various formats.
===============================================================================
*/

$plugin_info = array(
	'pi_name'         => 'DC Countries Select',
	'pi_version'      => '1.0.2',
	'pi_author'       => 'Designchuchi',
	'pi_author_url'   => 'http://www.designchuchi.ch/',
	'pi_description'  => 'Returns countries drop-down list in various formats.',
	'pi_usage'        => DC_countries_select::usage()
);


/**
 * Plugin class.
 *
 * @package default
 * @author  Designchuchi
 * @version 1.0.2
 * @license http://creativecommons.org/licenses/by-nd/3.0/
 **/
class DC_countries_select {

	var $return_data = "";

	/**
	 * Plugin function.
	 *
	 * @return  List of countries in a <select> element.
	 * @since   1.0.2
	 **/
	function DC_countries_select()
	{

		global $TMPL;

		$countries = array(
			'US' => "United States",
			'CA' => "Canada",
			'GB' => "United Kingdom",
			'AF' => "Afghanistan",
			'AL' => "Albania",
			'DZ' => "Algeria",
			'AS' => "American Samoa",
			'AD' => "Andorra",
			'AO' => "Angola",
			'AI' => "Anguilla",
			'AQ' => "Antarctica",
			'AG' => "Antigua And Barbuda",
			'AR' => "Argentina",
			'AM' => "Armenia",
			'AW' => "Aruba",
			'AU' => "Australia",
			'AT' => "Austria",
			'AZ' => "Azerbaijan",
			'BS' => "Bahamas",
			'BH' => "Bahrain",
			'BD' => "Bangladesh",
			'BB' => "Barbados",
			'BY' => "Belarus",
			'BE' => "Belgium",
			'BZ' => "Belize",
			'BJ' => "Benin",
			'BM' => "Bermuda",
			'BT' => "Bhutan",
			'BO' => "Bolivia",
			'BA' => "Bosnia And Herzegovina",
			'BW' => "Botswana",
			'BV' => "Bouvet Island",
			'BR' => "Brazil",
			'IO' => "British Indian Ocean Territory",
			'BN' => "Brunei Darussalam",
			'BG' => "Bulgaria",
			'BF' => "Burkina Faso",
			'BI' => "Burundi",
			'KH' => "Cambodia",
			'CM' => "Cameroon",
			'CA' => "Canada",
			'CV' => "Cape Verde",
			'KY' => "Cayman Islands",
			'CF' => "Central African Republic",
			'TD' => "Chad",
			'CL' => "Chile",
			'CN' => "China",
			'CX' => "Christmas Island",
			'CC' => "Cocos (keeling) Islands",
			'CO' => "Colombia",
			'KM' => "Comoros",
			'CG' => "Congo",
			'CD' => "Congo, The Democratic Republic Of The",
			'CK' => "Cook Islands",
			'CR' => "Costa Rica",
			'CI' => "Cote D'ivoire",
			'HR' => "Croatia",
			'CU' => "Cuba",
			'CY' => "Cyprus",
			'CZ' => "Czech Republic",
			'DK' => "Denmark",
			'DJ' => "Djibouti",
			'DM' => "Dominica",
			'DO' => "Dominican Republic",
			'TP' => "East Timor",
			'EC' => "Ecuador",
			'EG' => "Egypt",
			'SV' => "El Salvador",
			'GQ' => "Equatorial Guinea",
			'ER' => "Eritrea",
			'EE' => "Estonia",
			'ET' => "Ethiopia",
			'FK' => "Falkland Islands (malvinas)",
			'FO' => "Faroe Islands",
			'FJ' => "Fiji",
			'FI' => "Finland",
			'FR' => "France",
			'GF' => "French Guiana",
			'PF' => "French Polynesia",
			'TF' => "French Southern Territories",
			'GA' => "Gabon",
			'GM' => "Gambia",
			'GE' => "Georgia",
			'DE' => "Germany",
			'GH' => "Ghana",
			'GI' => "Gibraltar",
			'GR' => "Greece",
			'GL' => "Greenland",
			'GD' => "Grenada",
			'GP' => "Guadeloupe",
			'GU' => "Guam",
			'GT' => "Guatemala",
			'GN' => "Guinea",
			'GW' => "Guinea-bissau",
			'GY' => "Guyana",
			'HT' => "Haiti",
			'HM' => "Heard Island And Mcdonald Islands",
			'VA' => "Holy See (Vatican City State)",
			'HN' => "Honduras",
			'HK' => "Hong Kong",
			'HU' => "Hungary",
			'IS' => "Iceland",
			'IN' => "India",
			'ID' => "Indonesia",
			'IR' => "Iran, Islamic Republic Of",
			'IQ' => "Iraq",
			'IE' => "Ireland",
			'IL' => "Israel",
			'IT' => "Italy",
			'JM' => "Jamaica",
			'JP' => "Japan",
			'JO' => "Jordan",
			'KZ' => "Kazakstan",
			'KE' => "Kenya",
			'KI' => "Kiribati",
			'KP' => "Korea, Democratic People's Republic Of",
			'KR' => "Korea, Republic Of",
			'KW' => "Kuwait",
			'KG' => "Kyrgyzstan",
			'LA' => "Lao People's Democratic Republic",
			'LV' => "Latvia",
			'LB' => "Lebanon",
			'LS' => "Lesotho",
			'LR' => "Liberia",
			'LY' => "Libyan Arab Jamahiriya",
			'LI' => "Liechtenstein",
			'LT' => "Lithuania",
			'LU' => "Luxembourg",
			'MO' => "Macau",
			'MK' => "Macedonia, The Former Yugoslav Republic Of",
			'MG' => "Madagascar",
			'MW' => "Malawi",
			'MY' => "Malaysia",
			'MV' => "Maldives",
			'ML' => "Mali",
			'MT' => "Malta",
			'MH' => "Marshall Islands",
			'MQ' => "Martinique",
			'MR' => "Mauritania",
			'MU' => "Mauritius",
			'YT' => "Mayotte",
			'MX' => "Mexico",
			'FM' => "Micronesia, Federated States Of",
			'MD' => "Moldova, Republic Of",
			'MC' => "Monaco",
			'MN' => "Mongolia",
			'MS' => "Montserrat",
			'MA' => "Morocco",
			'MZ' => "Mozambique",
			'MM' => "Myanmar",
			'NA' => "Namibia",
			'NR' => "Nauru",
			'NP' => "Nepal",
			'NL' => "Netherlands",
			'AN' => "Netherlands Antilles",
			'NC' => "New Caledonia",
			'NZ' => "New Zealand",
			'NI' => "Nicaragua",
			'NE' => "Niger",
			'NG' => "Nigeria",
			'NU' => "Niue",
			'NF' => "Norfolk Island",
			'MP' => "Northern Mariana Islands",
			'NO' => "Norway",
			'OM' => "Oman",
			'PK' => "Pakistan",
			'PW' => "Palau",
			'PS' => "Palestinian Territory, Occupied",
			'PA' => "Panama",
			'PG' => "Papua New Guinea",
			'PY' => "Paraguay",
			'PE' => "Peru",
			'PH' => "Philippines",
			'PN' => "Pitcairn",
			'PL' => "Poland",
			'PT' => "Portugal",
			'PR' => "Puerto Rico",
			'QA' => "Qatar",
			'RE' => "Reunion",
			'RO' => "Romania",
			'RU' => "Russian Federation",
			'RW' => "Rwanda",
			'SH' => "Saint Helena",
			'KN' => "Saint Kitts And Nevis",
			'LC' => "Saint Lucia",
			'PM' => "Saint Pierre And Miquelon",
			'VC' => "Saint Vincent And The Grenadines",
			'WS' => "Samoa",
			'SM' => "San Marino",
			'ST' => "Sao Tome And Principe",
			'SA' => "Saudi Arabia",
			'SN' => "Senegal",
			'SC' => "Seychelles",
			'SL' => "Sierra Leone",
			'SG' => "Singapore",
			'SK' => "Slovakia",
			'SI' => "Slovenia",
			'SB' => "Solomon Islands",
			'SO' => "Somalia",
			'ZA' => "South Africa",
			'GS' => "South Georgia And The South Sandwich Islands",
			'ES' => "Spain",
			'LK' => "Sri Lanka",
			'SD' => "Sudan",
			'SR' => "Suriname",
			'SJ' => "Svalbard And Jan Mayen",
			'SZ' => "Swaziland",
			'SE' => "Sweden",
			'CH' => "Switzerland",
			'SY' => "Syrian Arab Republic",
			'TW' => "Taiwan, Province Of China",
			'TJ' => "Tajikistan",
			'TZ' => "Tanzania, United Republic Of",
			'TH' => "Thailand",
			'TG' => "Togo",
			'TK' => "Tokelau",
			'TO' => "Tonga",
			'TT' => "Trinidad And Tobago",
			'TN' => "Tunisia",
			'TR' => "Turkey",
			'TM' => "Turkmenistan",
			'TC' => "Turks And Caicos Islands",
			'TV' => "Tuvalu",
			'UG' => "Uganda",
			'UA' => "Ukraine",
			'AE' => "United Arab Emirates",
			'GB' => "United Kingdom",
			'US' => "United States",
			'UM' => "United States Minor Outlying Islands",
			'UY' => "Uruguay",
			'UZ' => "Uzbekistan",
			'VU' => "Vanuatu",
			'VE' => "Venezuela",
			'VN' => "Viet Nam",
			'VG' => "Virgin Islands, British",
			'VI' => "Virgin Islands, US.",
			'WF' => "Wallis And Futuna",
			'EH' => "Western Sahara",
			'YE' => "Yemen",
			'YU' => "Yugoslavia",
			'ZM' => "Zambia",
			'ZW' => "Zimbabwe"
		);

		// collect parameters
		$name      = ( ! $TMPL->fetch_param('name')) ? '' : $TMPL->fetch_param('name');
		$class     = ( ! $TMPL->fetch_param('class')) ? '' : $TMPL->fetch_param('class');
		$id        = ( ! $TMPL->fetch_param('id')) ? '' : $TMPL->fetch_param('id');
		$style     = ( ! $TMPL->fetch_param('style')) ? '' : $TMPL->fetch_param('style');

		$selected  = ( ! $TMPL->fetch_param('selected')) ? '' : $TMPL->fetch_param('selected');
		$use_codes = ( ! $TMPL->fetch_param('use_codes')) ? '' : TRUE;

		// compose opening select tag
		$select = '<select';
		if (!empty($name))
		{
			$select .= " class='$name'";
		}
		if (!empty($class))
		{
			$select .= " class='$class'";
		}
		if (!empty($id))
		{
			$select .= " id='$id'";
		}
		if(!empty($style)){
			$select .= " style='$style'";
		}
		$select .= '>';

		// compose <select> options
		$options = '';
		foreach ($countries as $code => $country) {

			$value = $use_codes ? $code : $country;
			$label = $country;

			// cleanup
			$value = htmlspecialchars($value);
			$label = htmlspecialchars($label);

			if ($code === $selected OR $country === $selected)
			{
				$options .= "<option value='$value' selected='selected'>$label</option>\r";
			}
			else
			{
				$options .= "<option value='$value'>$label</option>\r";
			}
		}
		$select .= $options;

		// close select tag
		$select .= "</select>";

		// return composed drop-down
		$this->return_data = $select;
	}


	// ----------------------------------------
	//  Plugin Usage
	// ----------------------------------------

	// This function describes how the plugin is used.
	//  Make sure and use output buffering
	function usage()
	{
		ob_start();
?>

The DC_countries_select plugin provides an easy means of adding a country select drop down box to the front-end of your site.
This is a very simple plugin whose primary purpose is to just save you from a bit of typing.

It is a single tag variable, but there are a range of optional parameters that are available to allow you to control things.
There are parameters for "name", "class", "id", "style" which map to attributes for the select element produced, and "selected",
which maps to an attribute for a chosen option element should you wish to highlight it.

Examples:

{exp:dc_countries_select}

{exp:dc_countries_select name="name-for-select"}

{exp:dc_countries_select name="name-for-select" id="id-for-select"}

{exp:dc_countries_select name="name-for-select" id="id-for-select" selected="United Kingdom"}

or

{exp:dc_countries_select name="name-for-select" id="id-for-select" selected="UK"}

both, the appropriate country code as well as the country name will work to make an item selected.

{exp:dc_countries_select name="name-for-select" id="id-for-select" selected="United Kingdom" use_codes="yes"}

To render the countries with the appropriate country code values as described in <a href="http://en.wikipedia.org/wiki/ISO_3166-1">ISO_3166-1</a>, specify the <code>use_codes</code> parameter.

<?php
		$buffer = ob_get_contents();

		ob_end_clean();

		return $buffer;
	}

} // END DC_countries_select Class