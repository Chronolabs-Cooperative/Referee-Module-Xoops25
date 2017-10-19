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


if (!defined('_MD_REFEREE_MODULE_DIRNAME')) {
	return false;
}

//*
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'objects.php');
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'xcp' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'xcp.class.php');

/**
 * Database Table for Hostnames in Referee URLs with Thumbnails
 *
 * For Table:-
 * <code>
 * CREATE TABLE `referee_hostnames` (
 *   `id` mediumint(16) NOT NULL AUTO_INCREMENT,
 *   `thumb_image_id` mediumint(128) NOT NULL DEFAULT '0',
 *   `icon_image_id` mediumint(128) NOT NULL DEFAULT '0',
 *   `pagetitle` varchar(255) NOT NULL DEFAULT '',
 *   `description` varchar(255) NOT NULL DEFAULT '',
 *   `keyword_ids` mediumtext,
 *   `key` varchar(44) NOT NULL DEFAULT '',
 *   `hostname` varchar(255) NOT NULL DEFAULT '',
 *   `resolved` varchar(255) NOT NULL DEFAULT '',
 *   `ip` varchar(128) NOT NULL DEFAULT '',
 *   `port` int(6) NOT NULL DEFAULT '0',
 *   `http` enum('Yes','No') NOT NULL DEFAULT 'No',
 *   `https` enum('Yes','No') NOT NULL DEFAULT 'No',
 *   `hash` varchar(12) NOT NULL DEFAULT '',
 *   `clicks` int(24) NOT NULL DEFAULT '0',
 *   `urls` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `referees` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `robots` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `browsers` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `agents` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `hitswith` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `hitswithout` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `hitsasbot` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `created` int(24) NOT NULL DEFAULT '0',
 *   `last` int(24) NOT NULL DEFAULT '0',
 *   PRIMARY KEY (`id`),
 *   KEY `SEARCH` (`hostname`,`resolved`,`ip`,`port`,`id`,`http`,`https`,`hash`,`created`,`last`,`key`) USING BTREE KEY_BLOCK_SIZE=16
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * </code>
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class refereeHostnames extends refereeXoopsObject
{

	var $handler = 'refereeHostnamesHandler';
	
    function __construct($id = null)
    {   	
    	
        self::initVar('id', XOBJ_DTYPE_INT, null, false);
        self::initVar('thumb_image_id', XOBJ_DTYPE_INT, null, false);
        self::initVar('icon_image_id', XOBJ_DTYPE_INT, null, false);
        self::initVar('pagetitle', XOBJ_DTYPE_TXTBOX, null, false, 255);
        self::initVar('description', XOBJ_DTYPE_TXTBOX, null, false, 255);
        self::initVar('keyword_ids', XOBJ_DTYPE_ARRAY, array(), false);
        self::initVar('key', XOBJ_DTYPE_TXTBOX, null, false, 44);
        self::initVar('hostname', XOBJ_DTYPE_TXTBOX, null, false, 255);
        self::initVar('resolve', XOBJ_DTYPE_TXTBOX, null, false, 255);
        self::initVar('ip', XOBJ_DTYPE_TXTBOX, null, false, 128);
        self::initVar('port', XOBJ_DTYPE_INT, null, false);
        self::initVar('http', XOBJ_DTYPE_ENUM, 'No', false, false, false, refereeEnumeratorValues(basename(__FILE__), 'http'));
        self::initVar('https', XOBJ_DTYPE_ENUM, 'No', false, false, false, refereeEnumeratorValues(basename(__FILE__), 'https'));
        self::initVar('hash', XOBJ_DTYPE_TXTBOX, null, false, 12);
        self::initVar('clicks', XOBJ_DTYPE_INT, null, false);
        self::initVar('urls', XOBJ_DTYPE_INT, null, false);
        self::initVar('referees', XOBJ_DTYPE_INT, null, false);
        self::initVar('robots', XOBJ_DTYPE_INT, null, false);
        self::initVar('browsers', XOBJ_DTYPE_INT, null, false);
        self::initVar('agents', XOBJ_DTYPE_INT, null, false);
        self::initVar('hitswith', XOBJ_DTYPE_INT, null, false);
        self::initVar('hitswithout', XOBJ_DTYPE_INT, null, false);
        self::initVar('hitsasbot', XOBJ_DTYPE_INT, null, false);
        self::initVar('created', XOBJ_DTYPE_INT, null, false);
        self::initVar('last', XOBJ_DTYPE_INT, null, false);
        
        if (!empty($id) && !is_null($id))
        {
        	$handler = new $this->handler;
        	self::assignVars($handler->get($id)->getValues(array_keys($this->vars)));
        }
        
    }

}


/**
 * Handler Class for Hostnames
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class refereeHostnamesHandler extends refereeXoopsObjectHandler
{
	

	/**
	 * Table Name without prefix used
	 * 
	 * @var string
	 */
	var $tbl = 'referee_hostnames';
	
	/**
	 * Child Object Handling Class
	 *
	 * @var string
	 */
	var $child = 'refereeHostnames';
	
	/**
	 * Child Object Identity Key
	 *
	 * @var string
	 */
	var $identity = 'id';
	
	/**
	 * Child Object Default Envaluing Costs
	 *
	 * @var string
	 */
	var $envalued = 'value';
	
    function __construct(&$db) 
    {
    	if (!is_object($db))
    		$db = $GLOBALS["xoopsDB"];
        parent::__construct($db, $this->tbl, $this->child, $this->identity, $this->envalued);
    }
}
?>