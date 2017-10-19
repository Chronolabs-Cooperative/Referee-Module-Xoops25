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

/**
 * Database Table for Useragents in Referee URLs with Thumbnails
 *
 * For Table:-
 * <code>
 * CREATE TABLE `referee_useragents` (
 *   `id` mediumint(16) NOT NULL AUTO_INCREMENT,
 *   `type` enum('Robot','Unknown') NOT NULL DEFAULT 'Unknown',
 *   `key` varchar(44) NOT NULL DEFAULT '',
 *   `useragent` varchar(255) NOT NULL DEFAULT '',
 *   `http` enum('Yes','No') NOT NULL DEFAULT 'No',
 *   `https` enum('Yes','No') NOT NULL DEFAULT 'No',
 *   `hash` varchar(12) NOT NULL DEFAULT '',
 *   `clicks` int(24) NOT NULL DEFAULT '0',
 *   `urls` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `referees` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `hostnames` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `hitswith` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `hitswithout` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `hitsasbot` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `created` int(24) NOT NULL DEFAULT '0',
 *   `last` int(24) NOT NULL DEFAULT '0',
 *   `last_hostname_id` mediumint(16) NOT NULL DEFAULT '0',
 *   `last_url_id` mediumint(32) NOT NULL DEFAULT '0',
 *   `last_referee_id` mediumint(64) NOT NULL DEFAULT '0',
 *   PRIMARY KEY (`id`),
 *   KEY `SEARCH` (`type`,`key`,`useragent`,`http`,`https`,`hash`,`urls`,`referees`,`hostnames`,`created`,`last`,`last_url_id`,`last_referee_id`,`last_hostname_id`) USING BTREE KEY_BLOCK_SIZE=13
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * </code>
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class refereeUseragents extends refereeXoopsObject
{

	var $handler = 'refereeUseragentsHandler';
	
    function __construct($id = null)
    {   	
    	
        self::initVar('id', XOBJ_DTYPE_INT, null, false);
        self::initVar('type', XOBJ_DTYPE_ENUM, 'Both', false, false, false, refereeEnumeratorValues(basename(__FILE__), 'type'));
        self::initVar('key', XOBJ_DTYPE_TXTBOX, null, false, 44);
        self::initVar('useragent', XOBJ_DTYPE_TXTBOX, null, false, 255);
        self::initVar('http', XOBJ_DTYPE_ENUM, 'No', false, false, false, refereeEnumeratorValues(basename(__FILE__), 'http'));
        self::initVar('https', XOBJ_DTYPE_ENUM, 'No', false, false, false, refereeEnumeratorValues(basename(__FILE__), 'https'));
        self::initVar('hash', XOBJ_DTYPE_TXTBOX, null, false, 12);
        self::initVar('clicks', XOBJ_DTYPE_INT, null, false);
        self::initVar('urls', XOBJ_DTYPE_INT, null, false);
        self::initVar('referees', XOBJ_DTYPE_INT, null, false);
        self::initVar('hostnames', XOBJ_DTYPE_INT, null, false);
        self::initVar('hitswith', XOBJ_DTYPE_INT, null, false);
        self::initVar('hitswithout', XOBJ_DTYPE_INT, null, false);
        self::initVar('hitsasbot', XOBJ_DTYPE_INT, null, false);
        self::initVar('created', XOBJ_DTYPE_INT, null, false);
        self::initVar('last', XOBJ_DTYPE_INT, null, false);
        self::initVar('last_hostname_id', XOBJ_DTYPE_INT, null, false);
        self::initVar('last_url_id', XOBJ_DTYPE_INT, null, false);
        self::initVar('last_referee_id', XOBJ_DTYPE_INT, null, false);
        
        if (!empty($id) && !is_null($id))
        {
        	$handler = new $this->handler;
        	self::assignVars($handler->get($id)->getValues(array_keys($this->vars)));
        }
        
    }

}


/**
 * Handler Class for Useragents
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class refereeUseragentsHandler extends refereeXoopsObjectHandler
{
	

	/**
	 * Table Name without prefix used
	 * 
	 * @var string
	 */
	var $tbl = 'referee_useragents';
	
	/**
	 * Child Object Handling Class
	 *
	 * @var string
	 */
	var $child = 'refereeUseragents';
	
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
    		$db = $GLOBAL["xoopsDB"];
        parent::__construct($db, $this->tbl, $this->child, $this->identity, $this->envalued);
    }
}
?>