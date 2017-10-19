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
 * Database Table for Thumbnails_configs in Referee URLs with Thumbnails
 *
 * For Table:-
 * <code>
 * CREATE TABLE `referee_thumbnails_configss` (
 *   `id` int(32) NOT NULL AUTO_INCREMENT,
 *   `engine_id` int(8) NOT NULL DEFAULT '0',
 *   `weight` int(4) NOT NULL DEFAULT '0',
 *   `define` varchar(128) NOT NULL DEFAULT '',
 *   `title` varchar(196) NOT NULL DEFAULT '',
 *   `default` varchar(255) NOT NULL DEFAULT '',
 *   `options` mediumtext,
 *   `value` varchar(255) NOT NULL DEFAULT '',
 *   PRIMARY KEY (`id`)
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * </code>
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class refereeThumbnails_configs extends refereeXoopsObject
{

	var $handler = 'refereeThumbnails_configsHandler';
	
    function __construct($id = null)
    {   	
    	
        self::initVar('id', XOBJ_DTYPE_INT, null, false);
        self::initVar('engine_id', XOBJ_DTYPE_INT, null, false);
        self::initVar('weight', XOBJ_DTYPE_INT, null, false);
        self::initVar('define', XOBJ_DTYPE_TXTBOX, null, false, 128);
        self::initVar('title', XOBJ_DTYPE_TXTBOX, null, false, 196);
        self::initVar('default', XOBJ_DTYPE_TXTBOX, null, false, 255);
        self::initVar('options', XOBJ_DTYPE_ARRAY, array(), false);
        self::initVar('value', XOBJ_DTYPE_TXTBOX, null, false, 255);
        
        if (!empty($id) && !is_null($id))
        {
        	$handler = new $this->handler;
        	self::assignVars($handler->get($id)->getValues(array_keys($this->vars)));
        }
        
    }

}


/**
 * Handler Class for Thumbnails_configs
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class refereeThumbnails_configsHandler extends refereeXoopsObjectHandler
{
	

	/**
	 * Table Name without prefix used
	 * 
	 * @var string
	 */
	var $tbl = 'referee_thumbnails_configs';
	
	/**
	 * Child Object Handling Class
	 *
	 * @var string
	 */
	var $child = 'refereeThumbnails_configs';
	
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