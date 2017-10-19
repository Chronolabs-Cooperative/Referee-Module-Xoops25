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


if (!defined('_MI_REFEREE_MODULE_DIRNAME')) {
	return false;
}

//*
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'objects.php');

/**
 * Database Table for Referees in Referee URLs with Thumbnails
 *
 * For Table:-
 * <code>
 * CREATE TABLE `referee_referees` (
 *   `id` mediumint(64) NOT NULL AUTO_INCREMENT,
 *   `key` varchar(44) NOT NULL DEFAULT '',
 *   `hostname_id` mediumint(16) NOT NULL DEFAULT '0',
 *   `url_id` mediumint(32) NOT NULL DEFAULT '0',
 *   `referee_hostname_id` mediumint(16) NOT NULL DEFAULT '0',
 *   `referee_url_id` mediumint(32) NOT NULL DEFAULT '0',
 *   `referees` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `robots` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `browsers` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `agents` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `hitswith` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `hitswithout` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `hitsasbot` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `hash` varchar(12) NOT NULL DEFAULT '',
 *   `clicks` int(24) NOT NULL DEFAULT '0',
 *   `created` int(24) NOT NULL DEFAULT '0',
 *   `last` int(24) NOT NULL DEFAULT '0',
 *   PRIMARY KEY (`id`),
 *   KEY `SEARCH` (`key`,`hostname_id`,`referee_hostname_id`,`url_id`,`referee_url_id`,`hash`,`created`,`last`) USING BTREE KEY_BLOCK_SIZE=8
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * </code>
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class refereeReferees extends refereeXoopsObject
{

	var $handler = '';
	
    function __construct($id = null)
    {   	
    	
        self::initVar('id', XOBJ_DTYPE_INT, null, false);
        self::initVar('key', XOBJ_DTYPE_TXTBOX, null, false, 44);
        self::initVar('hostname_id', XOBJ_DTYPE_INT, null, false);
        self::initVar('url_id', XOBJ_DTYPE_INT, null, false);
        self::initVar('referee_hostname_id', XOBJ_DTYPE_INT, null, false);
        self::initVar('referee_url_id', XOBJ_DTYPE_INT, null, false);
        self::initVar('referees', XOBJ_DTYPE_INT, null, false);
        self::initVar('robots', XOBJ_DTYPE_INT, null, false);
        self::initVar('browsers', XOBJ_DTYPE_INT, null, false);
        self::initVar('agents', XOBJ_DTYPE_INT, null, false);
        self::initVar('hitswith', XOBJ_DTYPE_INT, null, false);
        self::initVar('hitswithout', XOBJ_DTYPE_INT, null, false);
        self::initVar('hitsasbot', XOBJ_DTYPE_INT, null, false);
        self::initVar('hash', XOBJ_DTYPE_TXTBOX, null, false, 12);
        self::initVar('clicks', XOBJ_DTYPE_INT, null, false);
        self::initVar('created', XOBJ_DTYPE_INT, null, false);
        self::initVar('last', XOBJ_DTYPE_INT, null, false);
       
        $this->handler = __CLASS__ . 'Handler';
        if (!empty($id) && !is_null($id))
        {
        	$handler = new $this->handler;
        	self::assignVars($handler->get($id)->getValues(array_keys($this->vars)));
        }
        
    }

}


/**
 * Handler Class for Referees in referee email systems
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class refereeRefereesHandler extends refereeXoopsObjectHandler
{
	

	/**
	 * Table Name without prefix used
	 * 
	 * @var string
	 */
	var $tbl = 'referee_referees';
	
	/**
	 * Child Object Handling Class
	 *
	 * @var string
	 */
	var $child = 'refereeReferees';
	
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
    	if (!object($db))
    		$db = $GLOBALS["xoopsDB"];
        parent::__construct($db, self::$tbl, self::$child, self::$identity, self::$envalued);
        
    }
    
    
}
?>