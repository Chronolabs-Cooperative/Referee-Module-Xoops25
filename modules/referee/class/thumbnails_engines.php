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
 * Database Table for Thumbnails_engines in Referee URLs with Thumbnails
 *
 * For Table:-
 * <code>
 * CREATE TABLE `referee_thumbnails_engines` (
 *   `id` int(8) NOT NULL AUTO_INCREMENT,
 *   `active` enum('Yes','No') NOT NULL DEFAULT 'No',
 *   `weight` int(4) NOT NULL DEFAULT '0',
 *   `configs` int(8) NOT NULL DEFAULT '0',
 *   `folder` varchar(64) NOT NULL DEFAULT '',
 *   `title` varchar(64) NOT NULL DEFAULT '',
 *   `author` varchar(255) NOT NULL DEFAULT '',
 *   `url` varchar(128) NOT NULL DEFAULT '',
 *   `email` varchar(196) NOT NULL DEFAULT '',
 *   `perhour` int(6) NOT NULL DEFAULT '20',
 *   `usages` int(24) NOT NULL DEFAULT '0',
 *   `usage` int(13) NOT NULL DEFAULT '0',
 *   `installed` int(13) NOT NULL DEFAULT '0',
 *   PRIMARY KEY (`id`)
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * </code>
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class refereeThumbnails_engines extends refereeXoopsObject
{
    
    var $handler = 'refereeThumbnails_enginesHandler';
    
    function __construct($id = null)
    {
        
        self::initVar('id', XOBJ_DTYPE_INT, null, false);
        self::initVar('active', XOBJ_DTYPE_ENUM, 'No', false, false, false, refereeEnumeratorValues(basename(__FILE__), 'active'));
        self::initVar('weight', XOBJ_DTYPE_INT, null, false);
        self::initVar('configs', XOBJ_DTYPE_INT, null, false);
        self::initVar('folder', XOBJ_DTYPE_TXTBOX, null, false, 64);
        self::initVar('title', XOBJ_DTYPE_TXTBOX, null, false, 196);
        self::initVar('author', XOBJ_DTYPE_TXTBOX, null, false, 255);
        self::initVar('url', XOBJ_DTYPE_TXTBOX, null, false, 255);
        self::initVar('email', XOBJ_DTYPE_TXTBOX, null, false, 255);
        self::initVar('perhour', XOBJ_DTYPE_INT, null, false);
        self::initVar('usages', XOBJ_DTYPE_INT, null, false);
        self::initVar('usage', XOBJ_DTYPE_INT, null, false);
        self::initVar('installed', XOBJ_DTYPE_INT, null, false);
        
        if (!empty($id) && !is_null($id))
        {
            $handler = new $this->handler;
            self::assignVars($handler->get($id)->getValues(array_keys($this->vars)));
        }
        
    }
    
}


/**
 * Handler Class for Thumbnails_engines
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class refereeThumbnails_enginesHandler extends refereeXoopsObjectHandler
{
    
    
    /**
     * Table Name without prefix used
     *
     * @var string
     */
    var $tbl = 'referee_thumbnails_engines';
    
    /**
     * Child Object Handling Class
     *
     * @var string
     */
    var $child = 'refereeThumbnails_engines';
    
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