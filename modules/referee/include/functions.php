<?php
/**
 * Referee URL Lister with Site Thumbnails Engines
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright   	The XOOPS Project http://fonts2web.org.uk
 * @license     	General Public License version 3 (http://labs.coop/briefs/legal/general-public-licence/13,3.html)
 * @author      	Simon Roberts (wishcraft) <wishcraft@users.sourceforge.net>
 * @subpackage  	referee
 * @description 	Referee URL Lister with Site Thumbnails Engines
 * @version		    1.0.1
 * @link			http://internetfounder.wordpress.com
 */




if (!function_exists('refereeStripeReferee'))
{
    /**
     * Stipes the Referee Key
     * 
     * @param unknown $referee
     * @return mixed
     */
    function refereeStripeReferee($referee = '', $num = 3, $length = 18)
    {
        $uu     = 0;
        $strip  = floor(strlen($referee) / $num);
        $strlen = strlen($referee);
        $ret = '';
        for ($i = 0; $i < $strlen; ++$i) {
            if ($i < $length) {
                ++$uu;
                if ($uu == $strip) {
                    $ret .= substr($referee, $i, 1) . '-';
                    $uu = 0;
                } else {
                    if (substr($referee, $i, 1) != '-') {
                        $ret .= substr($referee, $i, 1);
                    } else {
                        $uu--;
                    }
                }
            }
        }
        $ret = str_replace('--', '-', $ret);
        if (substr($ret, 0, 1) == '-') {
            $ret = substr($ret, 2, strlen($ret));
        }
        if (substr($ret, strlen($ret) - 1, 1) == '-') {
            $ret = substr($ret, 0, strlen($ret) - 1);
        }
        
        return $ret;
    }
}

if (!function_exists('refereeSEF'))
{
    
    /**
     * Xoops safe encoded url elements
     *
     * @param unknown $datab
     * @param string $char
     * @return string
     */
    function refereeSEF($datab, $char ='-')
    {
        $replacement_chars = array();
        $accepted = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","m","o","p","q",
            "r","s","t","u","v","w","x","y","z","0","9","8","7","6","5","4","3","2","1");
        for($i=0;$i<256;$i++){
            if (!in_array(strtolower(chr($i)),$accepted))
                $replacement_chars[] = chr($i);
        }
        $return_data = (str_replace($replacement_chars,$char,$datab));
        while(substr($return_data, 0, 1) == $char)
            $return_data = substr($return_data, 1, strlen($return_data)-1);
        while(substr($return_data, strlen($return_data)-1, 1) == $char)
            $return_data = substr($return_data, 0, strlen($return_data)-1);
        while(strpos($return_data, $char . $char))
            $return_data = str_replace($char . $char, $char, $return_data);
        return(strtolower($return_data));
    }
}


if (!function_exists('refereeToNumeric'))
{
    
    /**
     * Xoops safe encoded url elements
     *
     * @param unknown $datab
     * @param string $char
     * @return string
     */
    function refereeToNumeric($datab)
    {
        $replacement_chars = array();
        $accepted = array("0","9","8","7","6","5","4","3","2","1");
        for($i=0;$i<256;$i++){
            if (!in_array(strtolower(chr($i)),$accepted))
                $replacement_chars[] = chr($i);
        }
        $return_data = (str_replace($replacement_chars,'',$datab));
        return(strtolower($return_data));
    }
}

if (!function_exists("refereeEnumeratorValues")) {
	/**
	 * Loads a field enumerator values
	 *
	 * @param string $filename
	 * @param string $variable
	 * @return array():
	 */
	function refereeEnumeratorValues($filename = '', $variable = '')
	{
		$variable = str_replace(array('-', ' '), "_", $variable);
		static $ret = array();
		if (!isset($ret[basename($file)]))
			if (file_exists($file = __DIR__ . DIRECTORY_SEPARATOR . 'enumerators' . DIRECTORY_SEPARATOR . "$variable__" . str_replace("php", "diz", basename($filename))))
				foreach( file($file) as $id => $value )
					if (!empty($value))
						$ret[basename($file)][$value] = $value;
						return $ret[basename($file)];
	}
}

if (!function_exists("refereeDecryptPassword")) {
	/**
	 * Decrypts a password
	 *
	 * @param string $password
	 * @param string $cryptiopass
	 * @return string:
	 */
	function refereeDecryptPassword($password = '', $cryptiopass = '')
	{
		$sql = "SELECT AES_DECRYPT(%s, %s) as `crypteec`";
		list($result) = $GLOBALS["xoopsDB"]->fetchRow($GLOBALS["xoopsDB"]->queryF(sprintf($sql, $GLOBALS["xoopsDB"]->quote($password), $GLOBALS["xoopsDB"]->quote($cryptiopass))));
		return $result;
	}
}


if (!function_exists("refereeEncryptPassword")) {
	/**
	 * Encrypts a password
	 *
	 * @param string $password
	 * @param string $cryptiopass
	 * @return string:
	 */
	function refereeEncryptPassword($password = '', $cryptiopass = '')
	{
		$sql = "SELECT AES_ENCRYPT(%s, %s) as `encrypic`";
		list($result) = $GLOBALS["xoopsDB"]->fetchRow($GLOBALS["xoopsDB"]->queryF(sprintf($sql, $GLOBALS["xoopsDB"]->quote($password), $GLOBALS["xoopsDB"]->quote($cryptiopass))));
		return $result;
	}
}


if (!function_exists("refereeCompressData")) {
	/**
	 * Compresses a textualisation
	 *
	 * @param string $data
	 * @return string:
	 */
	function refereeCompressData($data = '')
	{
		$sql = "SELECT COMPRESS('%s') as `compressed`";
		list($result) = $GLOBALS["xoopsDB"]->fetchRow($GLOBALS["xoopsDB"]->queryF(sprintf($sql, $GLOBALS["xoopsDB"]->quote($data))));
		return $result;
	}
}


if (!function_exists("refereeDecompressData")) {
	/**
	 * Compresses a textualisation
	 *
	 * @param string $data
	 * @return string:
	 */
	function refereeDecompressData($data = '')
	{
		$sql = "SELECT DECOMPRESS('%s') as `decompressed`";
		list($result) = $GLOBALS["xoopsDB"]->fetchRow($GLOBALS["xoopsDB"]->queryF(sprintf($sql, $GLOBALS["xoopsDB"]->quote($data))));
		return $result;
	}
}

?>
