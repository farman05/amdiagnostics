<?php

function pr(&$a)
{
    echo '<pre>';
    print_r($a);
    echo '</pre>';
}

function vd(&$a)
{
    echo '<pre>';
    var_dump($a);
    echo '</pre>';
}

function converToTz($time="",$toTz='',$fromTz='')
{  
   if(is_string($toTz)){
       $toTz = new DateTimeZone($toTz);
   }
   // timezone by php friendly values
   $date = new DateTime($time, $fromTz);
   $date->setTimezone($toTz);
   $time= $date->format('Y-m-d H:i:s');
   return $time;
}


function random_password( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}

function generateItemUrl($id, $itemTitle)
{
    $url = base_url()."item/listing_view?item_id=".$id;

    $itemId = $id;
    $idLen = strlen($itemId);
    
//    $CI =& get_instance();
//    $CI->load->model('Item_model');
//    $itemTitle = $CI->Item_model->getItemTitle($itemId);
    
    $generatedItemTitle = url_title($itemTitle);

    $patterns = array();
    $patterns[0] = '/listing_view\?/';
    $patterns[1] = '/item_id=/';
    $replacements = array();
    $replacements[1] = $itemId.'/';
    $replacements[0] = $generatedItemTitle;

    $newUrl = preg_replace($patterns, $replacements, $url);
    $len = strlen($newUrl);
    $endPoint = $len-$idLen;
    $generatedUrl = substr($newUrl,0,$endPoint);

    return $generatedUrl;
}

function makeClickableLinks($text)
{
    $text = html_entity_decode($text);
    $text = " ".$text;
    $text = preg_replace('/(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)/',
            '<a href="\\1" target=_blank>\\1</a>', $text);
    $text = preg_replace('/(((f|ht){1}tps://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)/',
            '<a href="\\1" target=_blank>\\1</a>', $text);
    $text = preg_replace('/([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)/',
    '\\1<a href="http://\\2" target=_blank>\\2</a>', $text);
    $text = preg_replace('/([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})/',
    '<a href="mailto:\\1" target=_blank>\\1</a>', $text);
    return $text;
}

function is_ajax()
{
    return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest");
}


function is_valid_url($url)
{
    return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}

function convertMonthToNumber($monthName) {
      return date('m', strtotime($monthName));
 }
 
 

function load_img($filename, $params = array(), $tag = true)
{
    if($tag == true)
    {
        $params_str = "";
        foreach($params as $key=>$param)
        {
            $params_str .= $key.'="'.$param.'" ';
        }
        return '<img src="'.base_url()."resources/images/".$filename.'" '.$params_str.'>';
    }
    else
        return base_url()."resources/images/".$filename;
}

////function to load he external js files not pertaining to controllers and action
//file name would be relative to js folder
function load_js($js_file=NULL,$tag=true)
{
	if($js_file!=NULL){
        if(file_exists("./resources/js/".$js_file))
            return '<script type="text/javascript" src="'.base_url()."resources/js/".$js_file.'"></script>';
	}
}

function load_css($css_file=NULL)
{
	if($css_file!=NULL){
        if(file_exists("./resources/css/".$css_file))
            return '<link  type="text/css" rel="stylesheet" href="'.base_url()."resources/css/".$css_file.'" />';
	}
}

function getIndex(&$arrayName,$index)
{
	if(isset($arrayName[$index]))
		return $arrayName[$index];
	else
		return FALSE;
}

function formatDate($dt)
{
	$tstamp = strtotime($dt);
	return date("D jS M, Y ",$tstamp);
}

function formatTime($tstamp)
{
	return date("g:i a",$tstamp);
}

function ago($time)
{    
    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths = array("60","60","24","7","4.35","12","10");

    $now = time();

    $difference     = $now - $time;
    $tense         = "ago";

    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    if($difference != 1) {
        $periods[$j].= "s";
    }

    return "$difference $periods[$j]";
}

function formatDateTime($tstamp)
{    
	return date("D jS M, Y (g:i a)",$tstamp);
}

function get_listing_count($userid)
{
    $CI =& get_instance();
    
    $CI->load->model('Item_model');
    
    $data = $CI->Item_model->get_listing_count($userid);
    return $data;
}

function lq()
{
	// helper to show last query
	$CI =& get_instance();
	echo "<pre class='smalltext'>".htmlentities($CI->db->last_query())."</pre>";
}

function getCountryList($index=null)
{
	$countries = array(
		'AF'=>'Afghanistan',
		'AL'=>'Albania',
		'DZ'=>'Algeria',
		'AS'=>'American Samoa',
		'AD'=>'Andorra',
		'AO'=>'Angola',
		'AI'=>'Anguilla',
		'AQ'=>'Antarctica',
		'AG'=>'Antigua and Barbuda',
		'AR'=>'Argentina',
		'AM'=>'Armenia',
		'AW'=>'Aruba',
		'AU'=>'Australia',
		'AT'=>'Austria',
		'AZ'=>'Azerbaijan',
		'BS'=>'Bahamas',
		'BH'=>'Bahrain',
		'BD'=>'Bangladesh',
		'BB'=>'Barbados',
		'BY'=>'Belarus',
		'BE'=>'Belgium',
		'BZ'=>'Belize',
		'BJ'=>'Benin',
		'BM'=>'Bermuda',
		'BT'=>'Bhutan',
		'BO'=>'Bolivia',
		'BA'=>'Bosnia and Herzegovina',
		'BW'=>'Botswana',
		'BV'=>'Bouvet Island',
		'BR'=>'Brazil',
		'IO'=>'British Indian Ocean Territory',
		'BN'=>'Brunei Darussalam',
		'BG'=>'Bulgaria',
		'BF'=>'Burkina Faso',
		'BI'=>'Burundi',
		'KH'=>'Cambodia',
		'CM'=>'Cameroon',
		'CA'=>'Canada',
		'CV'=>'Cape Verde',
		'KY'=>'Cayman Islands',
		'CF'=>'Central African Republic',
		'TD'=>'Chad',
		'CL'=>'Chile',
		'CN'=>'China',
		'CX'=>'Christmas Island',
		'CC'=>'Cocos (Keeling) Islands',
		'CO'=>'Colombia',
		'KM'=>'Comoros',
		'CG'=>'Congo',
		'CD'=>'Congo, the Democratic Republic of the',
		'CK'=>'Cook Islands',
		'CR'=>'Costa Rica',
		'CI'=>'Cote D\'Ivoire',
		'HR'=>'Croatia',
		'CU'=>'Cuba',
		'CY'=>'Cyprus',
		'CZ'=>'Czech Republic',
		'DK'=>'Denmark',
		'DJ'=>'Djibouti',
		'DM'=>'Dominica',
		'DO'=>'Dominican Republic',
		'EC'=>'Ecuador',
		'EG'=>'Egypt',
		'SV'=>'El Salvador',
		'GQ'=>'Equatorial Guinea',
		'ER'=>'Eritrea',
		'EE'=>'Estonia',
		'ET'=>'Ethiopia',
		'FK'=>'Falkland Islands (Malvinas)',
		'FO'=>'Faroe Islands',
		'FJ'=>'Fiji',
		'FI'=>'Finland',
		'FR'=>'France',
		'GF'=>'French Guiana',
		'PF'=>'French Polynesia',
		'TF'=>'French Southern Territories',
		'GA'=>'Gabon',
		'GM'=>'Gambia',
		'GE'=>'Georgia',
		'DE'=>'Germany',
		'GH'=>'Ghana',
		'GI'=>'Gibraltar',
		'GR'=>'Greece',
		'GL'=>'Greenland',
		'GD'=>'Grenada',
		'GP'=>'Guadeloupe',
		'GU'=>'Guam',
		'GT'=>'Guatemala',
		'GN'=>'Guinea',
		'GW'=>'Guinea-Bissau',
		'GY'=>'Guyana',
		'HT'=>'Haiti',
		'HM'=>'Heard Island and Mcdonald Islands',
		'VA'=>'Holy See (Vatican City State)',
		'HN'=>'Honduras',
		'HK'=>'Hong Kong',
		'HU'=>'Hungary',
		'IS'=>'Iceland',
		'IN'=>'India',
		'ID'=>'Indonesia',
		'IR'=>'Iran, Islamic Republic of',
		'IQ'=>'Iraq',
		'IE'=>'Ireland',
		'IL'=>'Israel',
		'IT'=>'Italy',
		'JM'=>'Jamaica',
		'JP'=>'Japan',
		'JO'=>'Jordan',
		'KZ'=>'Kazakhstan',
		'KE'=>'Kenya',
		'KI'=>'Kiribati',
		'KP'=>'Korea, Democratic People\'s Republic of',
		'KR'=>'Korea, Republic of',
		'KW'=>'Kuwait',
		'KG'=>'Kyrgyzstan',
		'LA'=>'Lao People\'s Democratic Republic',
		'LV'=>'Latvia',
		'LB'=>'Lebanon',
		'LS'=>'Lesotho',
		'LR'=>'Liberia',
		'LY'=>'Libyan Arab Jamahiriya',
		'LI'=>'Liechtenstein',
		'LT'=>'Lithuania',
		'LU'=>'Luxembourg',
		'MO'=>'Macao',
		'MK'=>'Macedonia, the Former Yugoslav Republic of',
		'MG'=>'Madagascar',
		'MW'=>'Malawi',
		'MY'=>'Malaysia',
		'MV'=>'Maldives',
		'ML'=>'Mali',
		'MT'=>'Malta',
		'MH'=>'Marshall Islands',
		'MQ'=>'Martinique',
		'MR'=>'Mauritania',
		'MU'=>'Mauritius',
		'YT'=>'Mayotte',
		'MX'=>'Mexico',
		'FM'=>'Micronesia, Federated States of',
		'MD'=>'Moldova, Republic of',
		'MC'=>'Monaco',
		'MN'=>'Mongolia',
		'MS'=>'Montserrat',
		'MA'=>'Morocco',
		'MZ'=>'Mozambique',
		'MM'=>'Myanmar',
		'NA'=>'Namibia',
		'NR'=>'Nauru',
		'NP'=>'Nepal',
		'AN'=>'Netherlands Antilles',
		'NL'=>'Netherlands',
		'NC'=>'New Caledonia',
		'NZ'=>'New Zealand',
		'NI'=>'Nicaragua',
		'NE'=>'Niger',
		'NG'=>'Nigeria',
		'NU'=>'Niue',
		'NF'=>'Norfolk Island',
		'MP'=>'Northern Mariana Islands',
		'NO'=>'Norway',
		'OM'=>'Oman',
		'PK'=>'Pakistan',
		'PW'=>'Palau',
		'PS'=>'Palestinian Territory, Occupied',
		'PA'=>'Panama',
		'PG'=>'Papua New Guinea',
		'PY'=>'Paraguay',
		'PE'=>'Peru',
		'PH'=>'Philippines',
		'PN'=>'Pitcairn',
		'PL'=>'Poland',
		'PT'=>'Portugal',
		'PR'=>'Puerto Rico',
		'QA'=>'Qatar',
		'RE'=>'Reunion',
		'RO'=>'Romania',
		'RU'=>'Russian Federation',
		'RW'=>'Rwanda',
		'SH'=>'Saint Helena',
		'LC'=>'Saint Lucia',
		'PM'=>'Saint Pierre and Miquelon',
		'KN'=>'Saint Kitts and Nevis',
		'VC'=>'Saint Vincent and the Grenadines',
		'WS'=>'Samoa',
		'SM'=>'San Marino',
		'ST'=>'Sao Tome and Principe',
		'SA'=>'Saudi Arabia',
		'SN'=>'Senegal',
		'CS'=>'Serbia and Montenegro',
		'SC'=>'Seychelles',
		'SL'=>'Sierra Leone',
		'SG'=>'Singapore',
		'SK'=>'Slovakia',
		'SI'=>'Slovenia',
		'SB'=>'Solomon Islands',
		'SO'=>'Somalia',
		'ZA'=>'South Africa',
		'GS'=>'South Georgia and the South Sandwich Islands',
		'ES'=>'Spain',
		'LK'=>'Sri Lanka',
		'SD'=>'Sudan',
		'SR'=>'Suriname',
		'SJ'=>'Svalbard and Jan Mayen',
		'SZ'=>'Swaziland',
		'SE'=>'Sweden',
		'CH'=>'Switzerland',
		'SY'=>'Syrian Arab Republic',
		'TW'=>'Taiwan, Province of China',
		'TJ'=>'Tajikistan',
		'TZ'=>'Tanzania, United Republic of',
		'TH'=>'Thailand',
		'TL'=>'Timor-Leste',
		'TG'=>'Togo',
		'TK'=>'Tokelau',
		'TO'=>'Tonga',
		'TT'=>'Trinidad and Tobago',
		'TN'=>'Tunisia',
		'TR'=>'Turkey',
		'TM'=>'Turkmenistan',
		'TC'=>'Turks and Caicos Islands',
		'TV'=>'Tuvalu',
		'UG'=>'Uganda',
		'UA'=>'Ukraine',
		'GB'=>'United Kingdom',
		'US'=>'United States',
		'AE'=>'United Arab Emirates',
		'UM'=>'United States Minor Outlying Islands',
		'UY'=>'Uruguay',
		'UZ'=>'Uzbekistan',
		'VU'=>'Vanuatu',
		'VE'=>'Venezuela',
		'VN'=>'Viet Nam',
		'VG'=>'Virgin Islands, British',
		'VI'=>'Virgin Islands, U.s.',
		'WF'=>'Wallis and Futuna',
		'EH'=>'Western Sahara',
		'YE'=>'Yemen',
		'ZM'=>'Zambia',
		'ZW'=>'Zimbabwe'
	);

	if(is_null($index))
		return $countries;
	else
	{
		if(strlen($index)>2)
		{
			$key = array_search($index,$countries);
			return $key;
		}
		else
		{
			if(isset($countries[$index]))
				return $countries[$index];
			else
				return "";
		}

	}
}

function getCurrentDateTime()
{
	return date("Y-m-d G:i:s");
}

function trim_text($string, $limit = 10, $dots = TRUE)
{    
    //echo $dots;
    $stringlen = strlen($string);
    

    if($stringlen > $limit)
    {
        if($dots)
        {
            $temp_string = substr($string, 0, ($limit - 3));
            $new_string = $temp_string."...";
            echo $new_string;
        }
        else
        {
            $temp_string = substr($string, 0, $limit);
            $new_string = $temp_string;
            echo $new_string;
        }
    }
    else
    {
        echo $string;
    }

}

function recursive_remove_directory($directory, $empty=FALSE)
{
	// if the path has a slash at the end we remove it here
	if(substr($directory,-1) == '/')
	{
		$directory = substr($directory,0,-1);
	}

	// if the path is not valid or is not a directory ...
	if(!file_exists($directory) || !is_dir($directory))
	{
		// ... we return false and exit the function
		return FALSE;

	// ... if the path is not readable
	}elseif(!is_readable($directory))
	{
		// ... we return false and exit the function
		return FALSE;

	// ... else if the path is readable
	}else{

		// we open the directory
		$handle = opendir($directory);

		// and scan through the items inside
		while (FALSE !== ($item = readdir($handle)))
		{
			// if the filepointer is not the current directory
			// or the parent directory
			if($item != '.' && $item != '..')
			{
				// we build the new path to delete
				$path = $directory.'/'.$item;

				// if the new path is a directory
				if(is_dir($path)) 
				{
					// we call this function with the new path
					recursive_remove_directory($path);

				// if the new path is a file
				}else{
					// we remove the file
					unlink($path);
				}
			}
		}
		// close the directory
		closedir($handle);

		// if the option to empty is not set to true
		if($empty == FALSE)
		{
			// try to delete the now empty directory
			if(!rmdir($directory))
			{
				// return false if not possible
				return FALSE;
			}
		}
		// return success
		return TRUE;
	}
}

function getOriginal($url_title) {
    
    $title_parts =  explode("-",$url_title);
    return implode(" ",$title_parts);
}

function normalize_str($str)
{
$invalid = array('á'=>'a', 'Á'=>'a', 'č'=>'c', 'Č'=>'c', 'ď'=>'d', 'Ď'=>'d',
			'é'=>'e','ě'=>'e','É'=>'e','Ě'=>'e','í'=>"i",'Í'=>'i','ň'=>'n','Ň'=>'n',
			'ó'=>'o','Ó'=>'o','ř'=>'r','Ř'=>'r','š'=>'s','Š'=>'s','ť'=>'t','Ť'=>'t','ú'=>'u',
			'Ú'=>'u','ů'=>'u','Ů'=>'u','ž'=>'z','Ž'=>'z'
			);

 
$str = str_replace(array_keys($invalid), array_values($invalid), $str);
 
return $str;
}
function is_allowed()
{
	return TRUE;
}


function email($to, $from, $mail_details)
{
	$CI =& get_instance();
	$CI->load->library('email');
    
	$config['mailtype'] = 'html';

	$config['protocol'] = "smtp";
	$config['smtp_host'] = SMTP_HOST;
	$config['smtp_port'] = SMTP_PORT;
	$config['smtp_user'] = SMTP_USER; 
	$config['smtp_pass'] = SMTP_PASSWORD;
	$config['charset'] = "utf-8";
	$config['mailtype'] = "html";
	

	$config['newline'] = "\r\n";

	$CI->email->initialize($config);
	$CI->email->set_newline("\r\n");
	$CI->email->set_crlf( "\r\n" );

    $CI->email->from(EMAIL_FROM);
    $CI->email->to($to); 
    
    $CI->email->subject($mail_details['subject']);
    $CI->email->message($mail_details['message']); 
    return $CI->email->send();
    
}


function addhttp($url,$secure='') {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http{$secure}://" . $url;
    }
    return $url;
}

function array_count_values_of($value, $array) {
	$counts = array_count_values($array);
	if(isset($counts[$value]))
		return $counts[$value];
	else
		return 0;
}


function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function recurse_copy($src,$dst) { 
    if(file_exists($src))
	{
		$dir = opendir($src); 
		@mkdir($dst); 
		while(false !== ( $file = readdir($dir)) ) { 
			if (( $file != '.' ) && ( $file != '..' )) { 
				if ( is_dir($src . '/' . $file) ) { 
					recurse_copy($src . '/' . $file,$dst . '/' . $file); 
				} 
				else { 
					copy($src . '/' . $file,$dst . '/' . $file); 
				} 
			} 
		} 
		closedir($dir); 
	}
} 

function parse_read_template($content){
  return preg_replace_callback('/\<\?php echo \$([a-zA-Z\d_]+)\; ?\?\>/', function ($matches){
	if(count($matches) >= 2 ){
      return '{' . $matches[1] . '}';
    }
  }, $content);
 }
 
 function _ToCamelCase($string, $capitalizeFirstCharacter = false) 
{

    $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));

    if (!$capitalizeFirstCharacter) {
        $str[0] = strtolower($str[0]);
    }

    return $str;
}

function fsmodify($obj) {
   $chunks = explode('/', $obj);
   chmod($obj, is_dir($obj) ? 0755 : 0644);
   chown($obj, $chunks[2]);
   chgrp($obj, $chunks[2]);
}


function fsmodifyr($dir) 
{
   if($objs = glob($dir."/*")) {        
	   foreach($objs as $obj) {
		   fsmodify($obj);
		   if(is_dir($obj)) fsmodifyr($obj);
	   }
   }

   return fsmodify($dir);
}

function getIconsList(){
	return array(
			'clip-settings' => 'clip-settings',
			'clip-camera' => 'clip-camera',
			'clip-tag' => 'clip-tag',
			'clip-bulb' => 'clip-bulb',
			'clip-paperplane' => 'clip-paperplane',
			'clip-bubble' => 'clip-bubble',
			'clip-banknote' => 'clip-banknote',
			'clip-music' => 'clip-music',
			'clip-date' => 'clip-date',
			'clip-shirt' => 'clip-shirt',
			'clip-clip' => 'clip-clip',
			'clip-calendar' => 'clip-calendar',
			'clip-vynil' => 'clip-vynil',
			'clip-truck' => 'clip-truck',
			'clip-note' => 'clip-note',
			'clip-world' => 'clip-world',
			'clip-key' => 'clip-key',
			'clip-pencil' => 'clip-pencil',
			'clip-images' => 'clip-images',
			'clip-list' => 'clip-list',
			'clip-earth' => 'clip-earth',
			'clip-pictures' => 'clip-pictures',
			'clip-cog' => 'clip-cog',
			'clip-home' => 'clip-home',
			'clip-home-2' => 'clip-home-2',
			'clip-pencil-3' => 'clip-pencil-3',
			'clip-images-3' => 'clip-images-3',
			'clip-eyedropper' => 'clip-eyedropper',
			'clip-droplet' => 'clip-droplet',
			'clip-droplet-2' => 'clip-droplet-2',
			'clip-image' => 'clip-image',
			'clip-music-2' => 'clip-music-2',
			'clip-camera-2' => 'clip-camera-2',
			'clip-camera-3' => 'clip-camera-3',
			'clip-headphones' => 'clip-headphones',
			'clip-headphones-2' => 'clip-headphones-2',
			'clip-gamepad' => 'clip-gamepad',
			'clip-connection' => 'clip-connection',
			'clip-headphones-2' => 'clip-headphones-2',
			'clip-new' => 'clip-new',
			'clip-book' => 'clip-book',
			'clip-file' => 'clip-file',
			'clip-file-2' => 'clip-file-2',
			'clip-file-plus' => 'clip-file-plus',
			'clip-file-minus' => 'clip-file-minus',
			'clip-file-check' => 'clip-file-check',
			'clip-file-remove' => 'clip-file-remove',
			'clip-file-3' => 'clip-file-3'
		);
}

function parse_write_template($content, $data){
	return preg_replace_callback('/{([a-zA-Z\d_]+)}/', function ($matches) use ($data){
    if(count($matches) >= 2 ){
    	$str = $data[$matches[1]];
    	return $str;
    }
    }, $content);
}


function jvzipnVerification() {
    $secretKey = JVZOO_SECRET;
    $pop = "";
    $ipnFields = array();
    foreach ($_POST AS $key => $value) {
        if ($key == "cverify") {
            continue;
        }
        $ipnFields[] = $key;
    }
    sort($ipnFields);
    foreach ($ipnFields as $field) {
        // if Magic Quotes are enabled $_POST[$field] will need to be
        // un-escaped before being appended to $pop
        $pop = $pop . $_POST[$field] . "|";
    }
    $pop = $pop . $secretKey;
    $calcedVerify = sha1(mb_convert_encoding($pop, "UTF-8"));
    $calcedVerify = strtoupper(substr($calcedVerify,0,8));
    return $calcedVerify == $_POST["cverify"];
}



function subscribeEmail($type='',$name='',$email='',$url='',$form_details=array()){
	$postData = '';
	switch ($type) {
	    case "iContact":
	    	$serializedArray = unserialize($form_details);
	    	$serializedArray['fields_email'] = $email;
	    	$serializedArray['fields_fname'] = $name;
	    	$serializedArray['fields_lname'] = '';
			foreach($serializedArray as $k => $v) 
			{ 
				$postData .= $k . '='.urlencode($v).'&'; 
			}
			rtrim($postData, '&');
			$ch = curl_init();  
		 	
		    curl_setopt($ch, CURLOPT_URL,$url);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		    curl_setopt($ch, CURLOPT_HEADER, false); 
		    curl_setopt($ch, CURLOPT_POST, count($postData));
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    
		 
		    $output=curl_exec($ch);
		    curl_close($ch);
	        break;
	    case "Mail Chimp":
	    	$serializedArray = unserialize($form_details);
	    	$serializedArray['EMAIL'] = $email;
	    	$serializedArray['FNAME'] = $name;
	    	$serializedArray['LNAME'] = '';
			foreach($serializedArray as $k => $v) 
			{ 
				$postData .= $k . '='.urlencode($v).'&'; 
			}
			rtrim($postData, '&');
			$ch = curl_init();  
		 	
		    curl_setopt($ch, CURLOPT_URL,$url);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		    curl_setopt($ch, CURLOPT_HEADER, false); 
		    curl_setopt($ch, CURLOPT_POST, count($postData));
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    
		 
		    $output=curl_exec($ch);
		    curl_close($ch);
	        break;
	    case "Constant Contacts":
	    	$serializedArray = unserialize($form_details);
	    	$serializedArray['email'] = $email;
	    	$serializedArray['first_name'] = $name;
			foreach($serializedArray as $k => $v) 
			{ 
				$postData .= $k . '='.urlencode($v).'&'; 
			}
			rtrim($postData, '&');
			$ch = curl_init();  
		 	
		    curl_setopt($ch, CURLOPT_URL,$url);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		    curl_setopt($ch, CURLOPT_HEADER, false); 
		    curl_setopt($ch, CURLOPT_POST, count($postData));
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    
		 
		    $output=curl_exec($ch);
		    curl_close($ch);
	        break;
	    case "Get Response":
	    	$serializedArray = unserialize($form_details);
	    	$serializedArray['email'] = $email;
	    	$serializedArray['name'] = $name;
			foreach($serializedArray as $k => $v) 
			{ 
				$postData .= $k . '='.urlencode($v).'&'; 
			}
			rtrim($postData, '&');
			$ch = curl_init();  
		 	
		    curl_setopt($ch, CURLOPT_URL,$url);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		    curl_setopt($ch, CURLOPT_HEADER, false); 
		    curl_setopt($ch, CURLOPT_POST, count($postData));
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    
		 
		    $output=curl_exec($ch);
		    curl_close($ch);
	        break;
	    case "Get Response":
	    	$serializedArray = unserialize($form_details);
	    	$serializedArray['email'] = $email;
	    	$serializedArray['name'] = $name;
			foreach($serializedArray as $k => $v) 
			{ 
				$postData .= $k . '='.urlencode($v).'&'; 
			}
			rtrim($postData, '&');
			$ch = curl_init();  
		 	
		    curl_setopt($ch, CURLOPT_URL,$url);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		    curl_setopt($ch, CURLOPT_HEADER, false); 
		    curl_setopt($ch, CURLOPT_POST, count($postData));
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    
		 
		    $output=curl_exec($ch);
		    curl_close($ch);
	        break;
	    case "Aweber":
	    	$serializedArray = unserialize($form_details);
	    	$account = $aweber->getAccount($serializedArray['accessToken'],$serializedArray['accessSecret']);
			$listURL = "/accounts/".$account['data']['id']."/lists/".ltrim('awlist',$serializedArray['listname']);
			$list = $account->loadFromUrl($listURL);
			$params = array(
				'email' => $email,
				'ip_address' => '127.0.0.1',
				'ad_tracking' => '',
				'misc_notes' => '',
				'name' => $name
			);
			$subscribers = $list->subscribers;
			$new_subscriber = $subscribers->create($params);
	        break;
	    default:
	        echo "Wrong method";
	}
}


function getFirstImage($tableName = '',$conditions=array(),$orderBy='desc'){
	$CI =& get_instance();
	return $CI->db->get_where($tableName,$conditions)->row_array();
}
function time_ago($time)  
    {  
      $time_ago = strtotime($time); 
      $current=date('Y-m-d g:h:i');
      $current_time =strtotime($current); 
      $time_difference = $current_time - $time_ago;  
      $seconds = $time_difference;  
      $minutes      = round($seconds / 60 );           // value 60 is seconds  
      $hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
      $days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
      $weeks          = round($seconds / 604800);          // 7*24*60*60;  
      $months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
      $years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
      if($seconds <= 60)  
      {  
     return "Just Now";  
   }  
      else if($minutes <=60)  
      {  
     if($minutes==1)  
           {  
       return "one minute ago";  
     }  
     else  
           {  
       return "$minutes minutes ago";  
     }  
   }  
      else if($hours <=24)  
      {  
     if($hours==1)  
           {  
       return "an hour ago";  
     }  
           else  
           {  
       return "$hours hrs ago";  
     }  
   }  
      else if($days <= 7)  
      {  
     if($days==1)  
           {  
       return "yesterday";  
     }  
           else  
           {  
       return "$days days ago";  
     }  
   }  
      else if($weeks <= 4.3) //4.3 == 52/12  
      {  
     if($weeks==1)  
           {  
       return "a week ago";  
     }  
           else  
           {  
       return "$weeks weeks ago";  
     }  
   }  
       else if($months <=12)  
      {  
     if($months==1)  
           {  
       return "a month ago";  
     }  
           else  
           {  
       return "$months months ago";  
     }  
   }  
      else  
      {  
     if($years==1)  
           {  
       return "one year ago";  
     }  
           else  
           {  
       return "$years years ago";  
     }  
   }  
 }  

 function ar_time_ago($time)  
    {  
      $time_ago = strtotime($time); 
      $current=date('Y-m-d g:h:i');
      $current_time =strtotime($current); 
      $time_difference = $current_time - $time_ago;  
      $seconds = $time_difference;  
      $minutes      = round($seconds / 60 );           // value 60 is seconds  
      $hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
      $days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
      $weeks          = round($seconds / 604800);          // 7*24*60*60;  
      $months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
      $years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
      if($seconds <= 60)  
      {  
     return "فقط";  
   }  
      else if($minutes <=60)  
      {  
     if($minutes==1)  
           {  
       return "منذ دقيقة واحدة";  
     }  
     else  
           {  
       return  num_arabic($minutes)." دقائق مضت";  
     }  
   }  
      else if($hours <=24)  
      {  
     if($hours==1)  
           {  
       return "قبل ساعة";  
     }  
           else  
           {  
       return num_arabic($hours)." منذ ساعة";  
     }  
   }  
      else if($days <= 7)  
      {  
     if($days==1)  
           {  
       return "اليوم السابق";  
     }  
           else  
           {  
       return num_arabic($hours)." أيام مضت";  
     }  
   }  
      else if($weeks <= 4.3) //4.3 == 52/12  
      {  
     if($weeks==1)  
           {  
       return "منذ أسبوع";  
     }  
           else  
           {  
       return num_arabic($weeks)." منذ أسابيع";  
     }  
   }  
       else if($months <=12)  
      {  
     if($months==1)  
           {  
       return "قبل شهر";  
     }  
           else  
           {  
       return num_arabic($months)." منذ اشهر";  
     }  
   }  
      else  
      {  
     if($years==1)  
           {  
       return "قبل عام واحد";  
     }  
           else  
           {  
       return num_arabic($years)." سنين مضت";  
     }  
   }  
 }  


 function fetching_address($city,$lang){
 	
         
 	    $file_contents = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.urlencode($city).'&sensor=true&language='.$lang);
        // $geolocation = $lat.','.$long;
        // $request = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.$geolocation.'&sensor=false'; 
        // $file_contents = file_get_contents($request);
        $json_decode = json_decode($file_contents,true);
       // pr($json_decode['results'][0]['address_components']);exit;
        foreach ($json_decode['results'][0]['address_components'] as $component) {
       switch ($component['types']) {
      case in_array('street_number', $component['types']):
        $location['street_number'] = $component['long_name'];
        break;
      case in_array('route', $component['types']):
        $location['street'] = $component['long_name'];
        break;
      case in_array('sublocality', $component['types']):
        $location['sublocality'] = $component['long_name'];
        break;
      case in_array('locality', $component['types']):
        $location['locality'] = $component['short_name'];
        break;
      case in_array('administrative_area_level_2', $component['types']):
        $location['admin_2'] = $component['long_name'];
        break;
      case in_array('administrative_area_level_1', $component['types']):
        $location['admin_1'] = $component['long_name'];
        break;
      case in_array('postal_code', $component['types']):
        $location['postal_code'] = $component['long_name'];
        break;
      case in_array('country', $component['types']):
        $location['country'] = $component['long_name'];
        break;
    }
  
    }

        if(!empty($location['locality'])){   
         $name=$location['locality'].','.$location['country'];
     }else if(!empty($location['admin_1'])){
     	$name=$location['admin_1'].','.$location['country'];
     }else{
     	$name=$location['country'];
     }
        return $name;

        // if(isset($json_decode->results[0])) {
        //     $response = array();
        //     foreach($json_decode->results[0]->address_components as $addressComponet) {
        //         if(in_array('political', $addressComponet->types)) {
        //                 $response[] = $addressComponet->long_name; 
        //         }
        //     }

        //     if(isset($response[0])){ $first  =  $response[0];  } else { $first  = 'null'; }
        //     if(isset($response[1])){ $second =  $response[1];  } else { $second = 'null'; } 
        //     if(isset($response[2])){ $third  =  $response[2];  } else { $third  = 'null'; }
        //     if(isset($response[3])){ $fourth =  $response[3];  } else { $fourth = 'null'; }
        //     if(isset($response[4])){ $fifth  =  $response[4];  } else { $fifth  = 'null'; }
             
        //      if(!empty($first&&$second&&$third)){
        //      return $first.','.$second.','.$third;
        //      }else if(!empty($first&&$second)){
        //      	return $first.','.$second;
        //      }
        //     // if( $first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth != 'null' ) {
        //     //     $return=$first.','.$second.','.$third.','.$fourth.','.$fifth;
        //     //     echo $return;
        //     //     // $return['city']=$second;
        //     //     // $return['state']=$fourth;
        //     //     // $return['Country']=$first;
        //     //     // echo "<br/>Address:: ".$first;
        //     //     // echo "<br/>City:: ".$second;
        //     //     // echo "<br/>State:: ".$fourth;
        //     //     // echo "<br/>Country:: ".$fifth;
        //     // }
        //     // else if ( $first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth == 'null'  ) {
        //     //     // echo "<br/>Address:: ".$first;
        //     //     // echo "<br/>City:: ".$second;
        //     //     // echo "<br/>State:: ".$third;
        //     //     // echo "<br/>Country:: ".$fourth;
        //     //      $return=$first.','.$second.','.$third.','.$fourth;
        //     //     echo $return;
        //     // }
        //     // else if ( $first != 'null' && $second != 'null' && $third != 'null' && $fourth == 'null' && $fifth == 'null' ) {
        //     //     // echo "<br/>City:: ".$first;
        //     //     // echo "<br/>State:: ".$second;
        //     //     // echo "<br/>Country:: ".$third;
        //     //      $return=$first.','.$second.','.$third;
        //     //     echo $return;
        //     // }
        //     // else if ( $first != 'null' && $second != 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null'  ) {
        //     //     // echo "<br/>State:: ".$first;
        //     //     // echo "<br/>Country:: ".$second;
        //     //      $return=$first.','.$second;
        //     //     echo $return;
        //     // }
        //     // else if ( $first != 'null' && $second == 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null'  ) {
        //     //     // echo "<br/>Country:: ".$first;
        //     //      $return=$first;
        //     //     echo $return;
        //     // }
        //   }
    }


function num_arabic($str) {
	$arabic_eastern = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
	$arabic_western = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
	return str_replace($arabic_western, $arabic_eastern, $str);
}

function condition_arabic($str) {
	$arabic_eastern = array('مستعمل','كقطع','مفتوح','مجدّد','جديد','اخرى');
	$arabic_western = array('used','for_parts','open box','reconditioned','new','other');
	return str_replace($arabic_western, $arabic_eastern, $str);
}

function gettingUrlId(){
	$request_url =  $_SERVER['REQUEST_URI'];
	$root = str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

	$cid_url = str_replace($root, "", $request_url);
	preg_match("/^[0-9]+/", $cid_url, $p);
	if(is_array($p) && isset($p[0])){
		$cid = $p[0] ;
	} else {
		$cid = '';
	}
	return $cid;
}

function date_convert($dates){
	$date=strtotime($dates);
    $correctDateFormat=date('Y-m-d',$date);
    return $correctDateFormat;
}

function getData($tableName,$columnName,$parameter){
	 $CI =& get_instance();
	 return $CI->db->get_where($tableName,array($columnName => $parameter))->row_array();
}

function insertData($tableName,$columnName,$parameter){
	$CI =& get_instance();
	$CI->db->insert($tableName,array($columnName=>$parameter));
	// echo $CI->db->last_query();
	$id =$CI->db->insert_id();
	return $id;
}

function generateRandomStrings($length = 10,$eventName) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $randomString = $eventName.'_'.$randomString;
    pr($randomString);
    return $randomString;
}

function convert_smart_quotes($string){
		$search = array(chr(145),
		chr(146),
		chr(147),
		chr(148),
		chr(151));
		 
		$replace = array("'",
		"'",
		'"',
		'"',
		'-');
		 
		return str_replace($search, $replace, $string);
	}


function formValidation($array){
	if(!empty($array)){
		$CI = &   get_instance();
		foreach ($array as $key => $value) {
			$CI->form_validation->set_rules($key,$value,'required|trim');
			
		}
	}
}
	
function setFlashMsg($data,$name = ''){
	$CI = & get_instance();
	if(!empty($data['success'])){
		$CI->session->set_flashdata('success', $name.' '.$data['msg']);
	}else{
		$CI->session->set_flashdata('error', $name.' '.$data['msg']);
	}

}

function getDataHelper($tableName,$columnName= array(),$select = "*",$type = "row",$orderBy = ""){
	$CI = & get_instance();
	$result = "";
	$CI->db->select($select);
	if(!empty($columnName)){
		foreach ($columnName as $key => $value) {
			$CI->db->where($key,$value);
		}
	}

	if(!empty($orderBy)){
		$CI->db->order_by('id','desc');
	}

	if($type == "row"){
		$result = $CI->db->get($tableName)->row_array();
	}else{
		$result = $CI->db->get($tableName)->result_array();

	}
	return $result;

}

function insertHelper($tableName,$data,$chkExit=false,$exitColumn = array()){
		 $exit = false;
		 $CI = & get_instance();
		 $chkData = '';
		if(!empty($chkExit)){
		  $chkData = getDataHelper($tableName,$exitColumn,'id');
		  if(!empty($chkData)){
			  $exit = true;
		  }		
		}
		if(!empty($chkData)){
			return $chkData['id'];
		}else{
			$result = $CI->db->insert($tableName,$data);
			return $CI->db->insert_id();
		}

}

function updateHelper($tableName,$data,$where){
	$CI = & get_instance();

	return $CI->db->update($tableName,$data,$where);
}


function updateVisitUniqueId(){

	$CI =& get_instance();
	$center_code = 10;

	// 2. two digit year code
	$visit_year = date("y");

	// 3. three digit day of the year 
	$day_of_year = str_pad(date("z"),3,'0',STR_PAD_LEFT);

	// 4. four digit daily reset id
	$daily_reset_id = getDataHelper('daily_reset_id',array('added_on'=>date('Y-m-d')),'*','row','order');
	if(!empty($daily_reset_id)){
		$daily_reset_id = $daily_reset_id['unique_id'] + 1;
		$daily_reset_id = str_pad($daily_reset_id, 4, '0', STR_PAD_LEFT);
		$dailyResetData = array(
			'unique_id'=>$daily_reset_id,
			'added_on'=>date('Y-m-d')
		);
		insertHelper('daily_reset_id',$dailyResetData);
	}else{
		$daily_reset_id = str_pad(1, 4,'0',STR_PAD_LEFT);
		$dailyResetData = array(
							'unique_id'=>$daily_reset_id,
							'added_on'=>date('Y-m-d')
		);
		insertHelper('daily_reset_id',$dailyResetData);
	}
	// Concat the unique visit_id
	$unique_visit_id = $center_code.$visit_year.$day_of_year.$daily_reset_id;
	return $unique_visit_id;
 //    $Visit_Table['visit_unique_id'] = $unique_visit_id;
	
 //    $this->db->insert('visit', $Visit_Table); 
 //    $result = $CI->Visit_model->get_daily_reset_id();
 // pr($result);
}



function errorHtml($data){
	$html = '';
	if(!empty($data)){
		foreach ($data as $key => $value) {
			$html .= $value.' <br>';
		}
	}

	return $html;

}


function generatePdf($html,$name,$paper = "portrait",$footer=""){
    $CI =& get_instance();
     $CI->load->library('pdf'); // load library 
    $dompdf = new DOMPDF();
    $dompdf->set_paper("A4", $paper);
    $dompdf->load_html($html);
    $dompdf->render();
   // $dompdf->stream("patient_report.pdf");

    $canvas = $dompdf->get_canvas();
    $font = Font_Metrics::get_font("helvetica", "bold");
    if(empty($footer)){
        // $ canvas->page_text(250, 810, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0.5,0.5,0.5));
    }
    $dompdf->stream($name.'.pdf',array('Attachment'=>0));

 }

 function highLow($result,$parameterHigh,$parameterLow,$isBold = 0){

		if(!empty($isBold)){
			return '<b>'.$result.'</b>';
		}


		if(is_numeric($result)){
				if(!empty($parameterHigh) ||  !empty($parameterLow)){
					if($result > $parameterHigh){
						return '<b> '.$result.' H</b>';
					}else if($result < $parameterLow){
						return '<b> '.$result.' L</b>';
					}

				}
		}

		return $result;

 }


 function getClass($count){
		$fontSize = "12px";
	   if($count <= 5){
		   $fontSize = "14px";
	   }
	   return $fontSize;
 }

 function returnData($view,$activeTab=""){
	$data['header'] = TRUE;
    $data['_view'] = $view;
    $data['sidebar'] = TRUE;
    $data['footer'] = TRUE;
    $data['active_tab'] = $activeTab;	
    return $data;
 }

 function loadFrontView($view){

	$CI = & get_instance();
	return $CI->load->view('front_end/'.$view,'',true);
 }

 function getPackages($length = 100){
	 $array = array(
		 			array(
					 'name'=>'Diabetes',
					 'price'=>400,
					 'discount_price'=>200,
					 'test'=>array(
						 	'cbc','esr','widal'
					 ),
					 'type'=>'Urine & Blood'
					),
					array(
						'name'=>'Test 2',
						'price'=>400,
						'discount_price'=>200,
						'test'=>array(
								'cbc','esr','widal'
						),
						'type'=>'Urine & Blood'
					   ),
					array(
						'name'=>'Test 3',
						'price'=>400,
						'discount_price'=>200,
						'test'=>array(
								'cbc','esr','widal'
						),
						'type'=>'Urine & Blood'
					),
					array(
						'name'=>'Test 4',
						'price'=>400,
						'discount_price'=>200,
						'test'=>array(
								'cbc','esr','widal'
						),
						'type'=>'Urine & Blood'
					),
				);

	   return  array_slice($array, 0, $length);

 }

 