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
 * Database Table for Urls in Legal Consent Module
 *
 * For Table:-
 * <code>
 * CREATE TABLE `referee_urls` (
 *   `id` mediumint(32) NOT NULL AUTO_INCREMENT,
 *   `thumb_image_id` mediumint(128) NOT NULL DEFAULT '0',
 *   `icon_image_id` mediumint(128) NOT NULL DEFAULT '0',
 *   `hostname_id` mediumint(16) NOT NULL DEFAULT '0',
 *   `uri` tinytext NOT NULL,
 *   `key` varchar(44) NOT NULL DEFAULT '',
 *   `pagetitle` varchar(255) NOT NULL DEFAULT '',
 *   `description` varchar(255) NOT NULL DEFAULT '',
 *   `keyword_ids` mediumtext,
 *   `referees` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `bots` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `hitswith` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `hitswithout` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `hitsasbot` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
 *   `hash` varchar(12) NOT NULL DEFAULT '',
 *   `clicks` int(24) NOT NULL DEFAULT '0',
 *   `tags` varchar(255) NOT NULL DEFAULT '',
 *   `created` int(13) NOT NULL DEFAULT '0',
 *   `lasthits` int(13) NOT NULL DEFAULT '0',
 *   `fetching` int(13) NOT NULL DEFAULT '0',
 *   `fetched` int(13) NOT NULL DEFAULT '0',
 *   PRIMARY KEY (`id`),
 *   KEY `SEARCH` (`key`,`key_uri`,`id`,`created`,`lasthits`,`hash`,`bots`,`referees`,`hitswith`,`hitswithout`,`hitsasbot`) USING BTREE,
 *   KEY `TIMING` (`hash`,`created`,`lasthits`,`fetching`,`fetched`,`key_uri`,`key`)
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * </code>
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class refereeUrls extends refereeXoopsObject
{

	var $handler = 'refereeUrlsHandler';
	
    function __construct($id = null)
    {   	
    	
        self::initVar('id', XOBJ_DTYPE_INT, null, false);
        self::initVar('thumb_image_id', XOBJ_DTYPE_INT, null, false);
        self::initVar('icon_image_id', XOBJ_DTYPE_INT, null, false);
        self::initVar('hostname_id', XOBJ_DTYPE_INT, null, false);
        self::initVar('uri', XOBJ_DTYPE_OTHER, null, false);
        self::initVar('key', XOBJ_DTYPE_TXTBOX, null, false, 44);
        self::initVar('pagetitle', XOBJ_DTYPE_TXTBOX, null, false, 255);
        self::initVar('description', XOBJ_DTYPE_TXTBOX, null, false, 255);
        self::initVar('keyword_ids', XOBJ_DTYPE_ARRAY, array(), false);
        self::initVar('referees', XOBJ_DTYPE_INT, null, false);
        self::initVar('bots', XOBJ_DTYPE_INT, null, false);
        self::initVar('hitswith', XOBJ_DTYPE_INT, null, false);
        self::initVar('hitswithout', XOBJ_DTYPE_INT, null, false);
        self::initVar('hitsasbot', XOBJ_DTYPE_INT, null, false);
        self::initVar('hash', XOBJ_DTYPE_TXTBOX, null, false, 12);
        self::initVar('clicks', XOBJ_DTYPE_INT, null, false);
        self::initVar('tags', XOBJ_DTYPE_TXTBOX, null, false, 255);
        self::initVar('created', XOBJ_DTYPE_INT, null, false);
        self::initVar('lasthits', XOBJ_DTYPE_INT, null, false);
        self::initVar('fetching', XOBJ_DTYPE_INT, null, false);
        self::initVar('fetched', XOBJ_DTYPE_INT, null, false);
        
        if (!empty($id) && !is_null($id))
        {
        	$handler = new $this->handler;
        	self::assignVars($handler->get($id)->getValues(array_keys($this->vars)));
        }
        
    }

}


/**
 * Handler Class for Urls
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class refereeUrlsHandler extends refereeXoopsObjectHandler
{
	

	/**
	 * Table Name without prefix used
	 * 
	 * @var string
	 */
	var $tbl = 'referee_urls';
	
	/**
	 * Child Object Handling Class
	 *
	 * @var string
	 */
	var $child = 'refereeUrls';
	
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