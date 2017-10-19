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
 * Database Table for Images in Referee URLs with Thumbnails
 *
 * For Table:-
 * <code>
 * CREATE TABLE `referee_images` (
 *   `id` mediumint(128) NOT NULL AUTO_INCREMENT,
 *   `type` enum('Thumbnail','Icon','Unknown') NOT NULL DEFAULT 'Unknown',
 *   `mime` enum('image/vnd.microsoft.icon', 'image/png', 'image/jpg', 'image/gif', 'Unknown') NOT NULL DEFAULT 'Unknown',
 *   `key` varchar(44) NOT NULL DEFAULT '',
 *   `hash` varchar(12) NOT NULL DEFAULT '',
 *   `hits` int(24) NOT NULL DEFAULT '0',
 *   `clicks` int(24) NOT NULL DEFAULT '0',
 *   `bytes` int(24) NOT NULL DEFAULT '0',
 *   `image` blob,
 *   `created` int(24) NOT NULL DEFAULT '0',
 *   `last` int(24) NOT NULL DEFAULT '0',
 *   PRIMARY KEY (`id`)
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * </code>
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class refereeImages extends refereeXoopsObject
{

	var $handler = 'refereeImagesHandler';
	
    function __construct($id = null)
    {   	
    	
        self::initVar('id', XOBJ_DTYPE_INT, null, false);
        self::initVar('type', XOBJ_DTYPE_ENUM, 'No', false, false, false, refereeEnumeratorValues(basename(__FILE__), 'type'));
        self::initVar('mime', XOBJ_DTYPE_ENUM, 'No', false, false, false, refereeEnumeratorValues(basename(__FILE__), 'mime'));
        self::initVar('key', XOBJ_DTYPE_TXTBOX, null, false, 44);
        self::initVar('hash', XOBJ_DTYPE_TXTBOX, null, false, 12);
        self::initVar('hits', XOBJ_DTYPE_INT, null, false);
        self::initVar('clicks', XOBJ_DTYPE_INT, null, false);
        self::initVar('bytes', XOBJ_DTYPE_INT, null, false);
        self::initVar('image', XOBJ_DTYPE_OTHER, null, false);
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
 * Handler Class for Images
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class refereeImagesHandler extends refereeXoopsObjectHandler
{
	
    /**
     *
     * @var integer
     */
    var $created = 0;
    
    /**
     *
     * @var integer
     */
    var $existing = 0;
    
	/**
	 * Table Name without prefix used
	 * 
	 * @var string
	 */
	var $tbl = 'referee_images';
	
	/**
	 * Child Object Handling Class
	 *
	 * @var string
	 */
	var $child = 'refereeImages';
	
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