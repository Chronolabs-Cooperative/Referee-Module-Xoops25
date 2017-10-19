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
 * Database Table for Keywords in Referee URLs with Thumbnails
 *
 * For Table:-
 * <code>
 * CREATE TABLE `referee_keywords` (
 *   `id` mediumint(160) NOT NULL AUTO_INCREMENT,
 *   `key` varchar(44) NOT NULL DEFAULT '',
 *   `keyword` varchar(128) NOT NULL DEFAULT '',
 *   `hash` varchar(12) NOT NULL DEFAULT '',
 *   `urls` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `referees` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `hitswith` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `hitswithout` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `browsers` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `robots` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   PRIMARY KEY (`id`),
 *   KEY `SEARCH` (`key`,`keyword`,`hash`)
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * </code>
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class refereeKeywords extends refereeXoopsObject
{

	var $handler = 'refereeKeywordsHandler';
	
    function __construct($id = null)
    {   	
    	
        self::initVar('id', XOBJ_DTYPE_INT, null, false);
        self::initVar('key', XOBJ_DTYPE_TXTBOX, null, false, 44);
        self::initVar('keyword', XOBJ_DTYPE_TXTBOX, null, false, 128);
        self::initVar('hash', XOBJ_DTYPE_TXTBOX, null, false, 12);
        self::initVar('urls', XOBJ_DTYPE_INT, null, false);
        self::initVar('referees', XOBJ_DTYPE_INT, null, false);
        self::initVar('hitswith', XOBJ_DTYPE_INT, null, false);
        self::initVar('hitswithout', XOBJ_DTYPE_INT, null, false);
        self::initVar('browsers', XOBJ_DTYPE_INT, null, false);
        self::initVar('robots', XOBJ_DTYPE_INT, null, false);
        
        if (!empty($id) && !is_null($id))
        {
        	$handler = new $this->handler;
        	self::assignVars($handler->get($id)->getValues(array_keys($this->vars)));
        }
        
    }

}


/**
 * Handler Class for Keywords
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class refereeKeywordsHandler extends refereeXoopsObjectHandler
{
	

	/**
	 * Table Name without prefix used
	 * 
	 * @var string
	 */
	var $tbl = 'referee_keywords';
	
	/**
	 * Child Object Handling Class
	 *
	 * @var string
	 */
	var $child = 'refereeKeywords';
	
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